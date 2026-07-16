<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RedditService
{
    protected Client $client;

    private const string CACHE_PREFIX = 'reddit_rss_';
    public const array ALLOWED_SUBREDDITS = ['foodporn', 'foodcrime', 'meme', 'dankmemes', 'funnymemes', 'wholesomememes', 'pizzacrime'];

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',
                'Accept' => 'application/atom+xml',
            ],
        ]);
    }

    public function subreddit(string $subreddit): Collection
    {
        $cacheKey = self::CACHE_PREFIX.strtolower($subreddit);

        $data = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($subreddit) {
            try {
                $response = $this->client->get("https://old.reddit.com/r/{$subreddit}/.rss?sort=new");

                if ($response->getStatusCode() !== 200) {
                    return [];
                }

                $xml = simplexml_load_string((string) $response->getBody());

                return $this->parseFeed($xml)->toArray();

            } catch (ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 429) {
                    return ['throttled' => true];
                }

                return [];
            } catch (ServerException) {
                return [];
            }
        });

        return collect($data);
    }

    protected function parseFeed(\SimpleXMLElement $xml): Collection
    {
        // Safe check in case the XML parsing failed completely
        if (! $xml || (! property_exists($xml, 'entry') || $xml->entry === null)) {
            return collect();
        }

        $entries = iterator_to_array($xml->entry, false);

        return collect($entries)
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

    protected function extractImage(string $html): ?string
    {
        if ($html === '' || $html === '0') {
            return null;
        }

        preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $html, $matches);

        return isset($matches[1]) ? html_entity_decode($matches[1], ENT_QUOTES) : null;
    }
}
