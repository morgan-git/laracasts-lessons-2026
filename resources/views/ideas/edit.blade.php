<x-layout>

    <form method="POST" action="/ideas/{{ $idea->id }}">
     @csrf
     @method('PATCH')

      <div class="col-span-full">
          <label for="about" class="block text-sm/6 font-medium text-white">Edit your idea</label>
          <div class="mt-2">
                <label for="stateFilter" class="sr-only">Filter by State: {</label>

                <select class="select select-primary" name="state" id="stateFilter" >

                    @foreach ($states as $stateOption)
                        <option value="{{ $stateOption->value }}" @selected($idea->state->value == $stateOption->value)>
                            {{ ucfirst(str_replace('-', ' ', $stateOption->value)) }}
                        </option>
                    @endforeach
                </select>
            <x-forms.error name="state" />
            </div>
        <div class="mt-2">

            <label for="idea" class="sr-only">Idea:</label>

            <textarea id="description" name="description" rows="3" class="textarea w-full">{{ $idea->description }}</textarea>
            <x-forms.error name="description" />
        </div>
    </div>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="btn btn-secondary">Update</button>
        </div>
   </form>
     <div class="col-span-full mt-20">
        <form method="POST" action="/ideas/{{$idea->id}}" data-confirm="Are you sure you want to delete this idea?">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>
        </form>
    </div>

</x-layout>
