<x-layout>

     <div class="mt-6">
        <h2 class="font-bold">Your Stupid Idea</h2>
        <ul class="mt-6">
            <li class="text-sm">

                @if (isset($idea->description))
                    {{ $idea->description }}
                @else
                    No Idea found create one <a href="/ideas">here</a>

                @endif
            </li>
            <li class="text-sm mt-6">

                <a href="/ideas/{{ $idea->id }}/edit"
                 class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Edit
                </a>

            </li>
            <li class="text-sm mt-6">
                <form method="POST" action="/ideas/{{$idea->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Delete
                        </button>
                </form>
            </li>
    </ul>
    </div>

</x-layout>
