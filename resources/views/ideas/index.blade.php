<x-layout>


    <div class="mt-6 ">
    <h2 class="font-bold">Your Ideas</h2>
        <ul class="mt-6 grid grid-cols-2 gap-x-20 gap-y-4">

            @if (isset($ideas) && $ideas->count())

                @foreach($ideas AS $idea)
                <x-idea-card href="/ideas/{{ $idea->id }}">{{ $idea->description }}</x-idea-card>


                @endforeach

            @elseif (isset($idea) && $idea->count())
                <li class="text-sm">{{ $idea->description }}</li>
            @else  <li class="text-sm">No ideas</li>
            @endif

            <li class="text-sm mt-6"> <a href="/ideas/create">Create new idea</a></li>
        </ul>
   </div>
</x-layout>
