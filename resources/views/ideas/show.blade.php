<x-layout>
     <div class="card bg-neutral p-6">
        <h2 class="font-bold">Your Idea</h2>
        <ul class="mt-6">
            <li class="text-sm">

                @if (isset($idea->description))
                {{ $idea->title }}
                    {{ $idea->description }} - {{ $idea->state->label() }}

                @else
                    No Idea found

                @endif
            </li>
            <li class="text-sm mt-6">
                <a href="/ideas/{{ $idea->id }}/edit" class="btn">Edit</a>
            </li>

        </ul>
    </div>

</x-layout>
