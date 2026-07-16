<?php

use App\Services\RedditService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    Cache::flush();
});

function makeService(string $fixtureFile): RedditService
{
    $xml = file_get_contents(base_path("tests/fixtures/{$fixtureFile}"));

    $mock = new MockHandler([
        new Response(200, [], $xml),
    ]);

    $client = new Client(['handler' => HandlerStack::create($mock)]);

    return new RedditService($client);
}

it('returns a collection of posts from a subreddit', function () {
    $service = makeService('foodporn.xml');
    $posts = $service->fetch('foodporn');

    expect($posts)
        ->toBeInstanceOf(Collection::class)
        ->and($posts->count())->toBeGreaterThan(0);
});

it('returns posts with the correct keys', function () {
    $service = makeService('foodporn.xml');
    $posts = $service->fetch('foodporn');

    expect($posts->first())->toHaveKeys(['id', 'title', 'url', 'author', 'updated', 'content', 'image']);
});

it('returns empty collection when api returns non 200', function () {
    $mock = new MockHandler([new Response(503, [], '')]);
    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $service = new RedditService($client);

    expect($service->fetch('foodporn'))->toBeInstanceOf(Collection::class)
        ->and($service->fetch('foodporn')->isEmpty())->toBeTrue();
});

it('handles 429 throttle response gracefully', function () {
    $mock = new MockHandler([
        new ClientException(
            '429 Too Many Requests',
            new Request('GET', 'test'),
            new Response(429, [], '')
        ),
    ]);
    $client = new Client(['handler' => HandlerStack::create($mock)]);
    $service = new RedditService($client);

    $posts = $service->fetch('foodporn');

    expect($posts->get('throttled'))->toBeTrue();
});

it('caches results on second call', function () {
    $service = makeService('foodporn.xml');

    $first = $service->fetch('foodporn');
    $second = $service->fetch('foodporn');

    expect($first->toArray())->toEqual($second->toArray());
});
