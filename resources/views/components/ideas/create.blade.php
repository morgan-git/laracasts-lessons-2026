

   <form x-data="{state: 'pending' }" method="POST" action="{{ route('idea.store') }}">
     @csrf

      <div class="col-span-full mt-6">
           <div class="space-y-6">
                <x-forms.field fname="title" ftype="text" placeholder="Enter a title for your idea" autofocus required></x-forms.field>

            <div>
                 <label for="state" class="label">State</label>
                 <div class="flex gap-x-3">
                    @foreach (App\Enums\IdeaState::cases() as $state)
                        <button
                        @click="state = @js($state->value)"
                        type="button"
                        class="btn flex-1 h-10"
                        :class="state === @js($state->value) ? 'btn-secondary' : ''">
                            {{ $state->label() }}
                        </button>
                    @endforeach
                    <input type="hidden" name="state" id="state" :value="state">
                 </div>
            </div>
            <textarea
             placeholder="Describe Your Idea"
            id="description" name="description" rows="3"
            class="textarea w-full @error('description')textarea-error @enderror">{{ old('description') }}</textarea>
            <x-forms.error name="description" />
        </div>
          <p class="mt-3 text-sm/6 text-gray-400">Have an idea, Mustache?</p>
        </div>
        <div class="flex justify-end gap-x-5">
            <button type="button" class="btn" @click="$dispatch('close-modal')">Forget</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

   </form>

