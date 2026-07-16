<?php

namespace Database\Factories;

use App\Models\FeedPost;
use App\Models\FeedSource;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedPostFactory extends Factory
{
    protected $model = FeedPost::class;

    public function definition(): array
    {
        return [
            'feed_source_id' => FeedSource::factory(),
            'external_id' => 't3_'.$this->faker->unique()->regexify('[a-z0-9]{6}'),
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'author' => '/u/'.$this->faker->userName(),
            'image_url' => $this->faker->imageUrl(),
            'content' => $this->faker->paragraphs(2, true),
            'posted_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
