
<a {{  $attributes->merge(['class' =>"card bg-neutral text-neutral-content w-96"])}}>
    <div class="border-2 border-neutral-content/10 rounded-lg p-4">
         @if($idea->image_path)
        <div class="mb-4 overflow-hidden -mx-4 -mt-4">
            <img src="{{ asset('storage/' . $idea->image_path) }}" alt="" class="rounded-lg  w-full h-auto object-cover">
        </div>
        @endif
        <h3 class="card-title text-foreground text-xl">{{ filled($idea->title) ? $idea->title : 'Title' }}</h3>
        <div class="mt-1">
           <x-ideas.status  :status="$idea->state">{{ $idea->state->label() }}</x-ideas.status>

        </div>
        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
        <div class="text-muted-foreground text-sm mt-4">{{ $idea->created_at->diffForHumans() }}</div>

    </div>
</a>
