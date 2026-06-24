<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold tracking-tight">Ideas</h1>
            <p class="text-sm text-muted-foreground mt-2">Make a plan</p>
           <button
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                data-test="create-idea-button"
                class="border-2 border-neutral-content/10 rounded-lg p-4 mt-10 space-y-3 cursor-pointer h-32 w-full text-left" >
                <p class="">What's the idea?
                </p>
            </button>
        </header>
        <div>
            <a href="/ideas" class="btn {{ !request('state')  ? 'btn-secondary' : 'btn-ghost'}}">All  <span class="text-xs pl-1">({{ $statusCounts['all'] ?? 0 }})</span></a>

            @foreach (App\Enums\IdeaState::cases() as $status)
            <a href="/ideas?state={{$status->value}}"
                class="btn {{ request('state') === $status->value  ? 'btn-secondary' : 'btn-ghost'}}">{{ $status->label() }}
            <span class="text-xs pl-1">({{ $statusCounts->get($status->value) ?? 0 }})</span>
            </a>
            @endforeach
        </div>
        <div class="mt-10 text-muted-foreground">
            <div class=" grid md:grid-cols-2 gap-x-20 gap-y-4">

                @forelse($ideas AS $idea)
                    <x-ideas.idea-card href="{{ route('idea.show', $idea) }}" :idea="$idea"> </x-ideas.idea-card>

                    @empty
                        <p>No ideas</p>
                    @endforelse

            </div>
        </div>

        <!-- modal -->
        <x-modal name='create-idea' title="New Idea" >
          <x-ideas.create/>
        </x-modal>
    </div>
</x-layout>
