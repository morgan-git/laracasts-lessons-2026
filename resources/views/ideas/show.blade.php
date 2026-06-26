<x-layout>
     <div class="py-8 max-w-4xl mx-auto w-full">

        <div class="flex justify-between items-center">
            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium"><x-icons.arrow-back class="w-5 h-5"/>Back to Ideas</a>
            <div class="gap-x-3 flex items-center">
                <a href="/ideas/{{ $idea->id }}/edit" class="btn"><x-icons.external class="w-5 h-5"/>Edit Idea</a>

                <form method="POST" action="{{ route('idea.destroy' , $idea) }}" data-confirm="Are you sure you want to delete this idea?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outlined text-red-500">Delete</button>
                </form>
            </div>

        </div>

        @if($idea->image_path)
        <div class="overflow-hidden p-6">
            <img src="{{ asset('storage/' . $idea->image_path) }}" alt="" class="rounded-lg  w-full h-auto object-cover">
        </div>
        @endif
        <h1 class="font-bold text-4xl">{{ filled($idea->title) ? $idea->title : 'Title' }}</h1>

        <div class="mt-2 flex gap-x-3 items-center">
                <div class="mt-2 flex gap-x-3 items-center">
                    <x-ideas.status  :status="$idea->state">{{ $idea->state->label() }}</x-ideas.status>
                    <div class="text-muted-foreground text-sm ">{{ $idea->created_at->diffForHumans() }}</div>
                </div>


        </div>

        <div class="border-2 border-neutral-content/10 rounded-lg p-4 mt-6 line-clamp-3">
            <div class="text-foreground max-w-none">{{ $idea->description }}</div>
        </div>
        @if ($idea->steps->count())
                 <div class="mt-3 space-y-2">
                    <h3 class="font-bold text-xl mt-6">Steps</h3>
                    <div>
                        @foreach($idea->steps as $step)
                            <div class="border-2 border-neutral-content/10 rounded-lg p-4 mt-5 line-clamp-3 ">
                                <form method="POST" action="{{  route('step.update' , $step) }}">
                                    @csrf
                                    @method('PATCH')

                                <div class="flex items-center gap-x-3">
                                    <button type="submit" role="checkbox"
                                    class="size-5 flex items-center justify-center rounded-lg text-primary-foreground
                                    {{  $step->complete ? 'bg-primary' : 'border border-primary'  }}">&check;</button>
                                    <span class="{{ $step->complete ? 'line-through text-muted-foreground' : '' }}">{{ $step->description }}</span>
                                </div>
                                </form>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            @if ($idea->links->count())
                 <div class="mt-3 space-y-2">
                    <h3 class="font-bold text-xl mt-6">Links</h3>
                    <div>
                        @foreach($idea->links as $link)
                                <div class="border-2 border-neutral-content/10 rounded-lg p-4 mt-5 line-clamp-3">

                                <a href="{{ $link }}" class="text-primary font-medium flex gap-x-3 items-center"><x-icons.external class="w-5"></x-icons.external>{{ $link }}</a>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif

        </div>
    </div>

</x-layout>
