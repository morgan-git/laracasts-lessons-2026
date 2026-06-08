<x-layout>

    <form method="POST" action="/ideas/{{ $idea->id }}">
     @csrf
     @method('PATCH')

      <div class="col-span-full">
          <label for="about" class="block text-sm/6 font-medium text-white">Edit your idea</label>
          <div class="mt-2">
            <textarea id="description" name="description" rows="3" class="textarea w-full">{{ $idea->description }}</textarea>
            <x-forms.error name="description" />
        </div>
        </div>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="btn btn-secondary">Update</button>
        </div>
   </form>
     <div class="col-span-full mt-6">
        <form method="POST" action="/ideas/{{$idea->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error">Delete</button>
        </form>
    </div>

</x-layout>
