<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\FeedProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RedditService implements FeedProvider
{
    protected Client $client;

    public const string CACHE_PREFIX = 'reddit_rss_';

    public const array ALLOWED_SUBREDDITS = ['foodporn', 'foodcrime', 'meme', 'dankmemes', 'funnymemes', 'wholesomememes', 'pizzacrimes'];
//this should probably validate against active feed sources in the database instead of a hardcoded list, but for now this is fine
    private const array IGNORED_TITLE_PATTERNS = [
        '/^\[MOD/i',
        '/^\[META/i',
        '/^\[ANNOUNCEMENT/i',
        '/^NEWS/i',
    ];

    private const array IGNORED_CONTENT_PATTERNS = [
        '/submission rules/i',
        '/please read/i',
        '/about\/sidebar/i',
        '/mod team/i',
    ];

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',
                'Accept' => 'application/atom+xml',
            ],
        ]);
    }

    public function fetch(string $handle): Collection
    {
        try {
                $response = $this->client->get("https://old.reddit.com/r/{$handle}/.rss?sort=new");

                if ($response->getStatusCode() !== 200) {
                    return collect();
            }

            $xml = simplexml_load_string((string) $response->getBody());

            return $this->parseFeed($xml);

        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 429) {
                return collect(['throttled' => true]);
            }
            return collect();
        } catch (ServerException $e) {
            return collect();
        }
    }
    protected function parseFeed(\SimpleXMLElement $xml): Collection
    {
        // Safe check in case the XML parsing failed completely
        if (! $xml || (! property_exists($xml, 'entry') || $xml->entry === null)) {
            return collect();
        }

        $entries = iterator_to_array($xml->entry, false);

        return collect($entries)
            ->reject(fn (\SimpleXMLElement $entry) => $this->shouldSkip($entry))
            ->map(fn ($entry) => [
                'id' => (string) $entry->id,
                'title' => (string) $entry->title,
                'url' => (string) $entry->link->attributes()['href'],
                'author' => (string) $entry->author->name,
                'updated' => (string) $entry->updated,
                'content' => (string) $entry->content,
                'image' => $this->extractImage((string) $entry->content),
            ]);
    }

    protected function shouldSkip(\SimpleXMLElement $entry): bool
    {
        $title = (string) $entry->title;
        $content = html_entity_decode((string) $entry->content);

        foreach (self::IGNORED_TITLE_PATTERNS as $pattern) {
            if (preg_match($pattern, $title)) {
                return true;
            }
        }

        return array_any(self::IGNORED_CONTENT_PATTERNS, fn ($pattern) => preg_match($pattern, $content));
    }

    protected function extractImage(string $html): ?string
    {
        if ($html === '' || $html === '0') {
            return null;
        }

        preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $html, $matches);

        return isset($matches[1]) ? html_entity_decode($matches[1], ENT_QUOTES) : null;
    }
}
