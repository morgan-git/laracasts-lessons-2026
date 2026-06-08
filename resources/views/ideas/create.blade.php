<x-layout title="Form">

   <form method="POST" action="/ideas">
     @csrf

      <div class="col-span-full mt-6">
          <label for="about" class="block text-sm/6 font-medium text-white">Create new idea</label>
        <div class="mt-2">
            <textarea id="description" name="description" rows="3" class="textarea w-full @error('description')textarea-error @enderror"></textarea>

            <x-forms.error name="description" />
        </div>
          <p class="mt-3 text-sm/6 text-gray-400">Have an idea, Mustache?</p>
        </div>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="btn">Save</button>
        </div>

   </form>

</x-layout>
