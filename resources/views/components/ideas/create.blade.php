

   <form
   x-data="{
        state: 'pending',
        newLink: '',
        links: []
   }"
   method="POST"
   action="{{ route('idea.store') }}"
   >
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
                        data-test="idea-status-btn-{{ $state->value }}"
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
            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>

                    <template x-for="(link, index) in links" :key="link">
                        <div class="flex gap-x-2 items-center">
                            <input type="text" name="links[]" x-model="link" class="input">
                            <button
                            type="button"
                            @click="links.splice(index,1)"
                            aria-label="remove link button"
                            class="form-muted-icon"
                        >
                            <x-icons.close class="w-5" />
                        </button>
                        </div>
                    </template>
                <div class="flex gap-x-2 items-center">
                    <input
                        x-model="newLink"
                        type="url"
                        id="new-link"
                        data-test="new-link"
                        placeholder="http://example.com"
                        autocomplete="url"
                        class="input flex-1"
                        spellcheck="false"
                    >
                    <button
                        type="button"
                        @click="links.push(newLink.trim()); newLink=''"
                        :disabled="newLink.trim().length === 0"
                        aria-label="Add link button"
                        class="form-muted-icon"
                        data-test="submit-new-link-button"
                    >
                        <x-icons.append class="w-5" />
                    </button>
                </div>
               {{-- - <pre x-text="JSON.stringify(links)"></pre> --}}
                </fieldset>
            </div>

        <div class="flex justify-end gap-x-5">
            <button type="button" class="btn" @click="$dispatch('close-modal')">Forget</button>
            <button type="submit" class="btn btn-primary" data-test="save-idea-button">Save</button>
        </div>
  </div>
   </form>

