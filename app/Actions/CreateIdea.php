<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Notifications\IdeaPublished;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function __construct(#[CurrentUser()] protected User $user) {}

    public function handle(array $attributes, bool $notify = true): void
    {
        $data = collect($attributes)->only([
            'title', 'description', 'state', 'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $notify) {
            $idea = $this->user->ideas()->create($data);

            $idea->steps()->createMany(
                collect($attributes['steps'] ?? [])->map(fn ($step) => ['description' => $step])
            );

            if ($notify) {
                $this->user->notify(new IdeaPublished($idea));
            }
        });

    }
}
