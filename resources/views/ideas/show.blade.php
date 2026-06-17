<x-layout>
     <div class="card bg-neutral p-6">
        <h2 class="font-bold">Your Idea</h2>
        <ul class="mt-6">
            <li class="text-sm">

                @if (isset($idea->description))
                    {{ $idea->description }} - {{ $idea->state->label() }}

                @else
                    No Idea found

                @endif
            </li>
            <li class="text-sm mt-6">
                <a href="/ideas/{{ $idea->id }}/edit" class="btn">Edit</a>
            </li>
            <li class="text-sm mt-20">
                <form method="POST" action="/ideas/{{$idea->id}}" data-confirm="Are you sure you want to delete this idea?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary"> Delete </button>
                </form>
            </li>
            <li class="text-sm mt-20">
              <a href="/ideas/create" class="btn-primary p-2">Create Idea</a>
            </li>
        </ul>
    </div>

</x-layout>
