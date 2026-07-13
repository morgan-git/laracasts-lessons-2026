<x-layout>
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">/r/{{ $subreddit }}</h1>

    <div class="flex flex-col gap-4">
        @foreach($posts as $post)
            <div class="card bg-base-200 shadow-sm">
                <div class="card-body py-4">
                    @if($post['image'])
    <img src="{{ $post['image'] }}" class="rounded-lg w-full object-cover max-h-64" alt="{{ $post['title'] }}">
@endif
                    <a href="{{ $post['url'] }}" target="_blank" class="card-title text-base hover:text-primary">
                        {{ $post['title'] }}
                    </a>
                    <div class="text-xs text-base-content/60">
                        {{ $post['author'] }} · {{ \Carbon\Carbon::parse($post['updated'])->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</x-layout>
