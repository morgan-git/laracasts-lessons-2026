<x-layout>

   <form action="{{ url('/ideas') }}" method="GET" id="filterForm">
        <label for="stateFilter" class="sr-only">Filter by State:</label>

        <select class="select select-primary" name="state" id="stateFilter" onchange="this.form.submit();">
            <!-- 1. Explicitly set value="" so it submits an empty parameter -->
            <option value="" @selected(!request('state'))>All States</option>

            @foreach ($states as $stateOption)
                <option value="{{ $stateOption->value }}" @selected(request('state') === $stateOption->value)>
                    {{ $stateOption->label() }}
                </option>
            @endforeach
        </select>
    </form>
    <div class="mt-6 ">

    <h2 class="font-bold">Your @if ( isset($state)) {{ $state->label() }} @endif Ideas</h2>
        <ul class="mt-6 grid grid-cols-2 gap-x-20 gap-y-4">

            @if (isset($ideas) && $ideas->count())

                @foreach($ideas AS $idea)
                <x-idea-card href="/ideas/{{ $idea->id }}">{{ $idea->description }}</x-idea-card>
                @endforeach

            @elseif (isset($idea) && $idea->count())
                <li class="text-sm">{{ $idea->description }}</li>
            @else  <li class="text-sm">No ideas</li>
            @endif
        </ul>
        <div class="text-sm mt-6">
             <a class="btn-primary p-2" href="/ideas/create">Create Idea</a>
        </div>
   </div>
</x-layout>
