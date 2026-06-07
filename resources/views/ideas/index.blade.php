<x-layout>


    <div class="mt-6">
    <h2 class="font-bold">Your Ideas</h2>
        <ul class="mt-6">

            @if (isset($ideas) && $ideas->count())

                @foreach($ideas AS $idea)
                   <a href="/ideas/{{$idea->id}}/edit" alt="edit"><li class="text-sm">{{ $idea->description }}</li></a>
                @endforeach

            @elseif (isset($idea) && $idea->count())
                <li class="text-sm">{{ $idea->description }}</li>
            @else  <li class="text-sm">No ideas</li>
            @endif

            <li class="text-sm mt-6"> <a href="/ideas/create">Create new idea</a></li>
        </ul>
   </div>
</x-layout>
