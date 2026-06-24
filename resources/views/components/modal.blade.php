 @props(['name', 'title'])
 <div
            x-data="{ show: false, name: @js($name) }"
            x-show="show"
            x-init="@if($errors->any()) show = true @endif"
            @open-modal.window="if($event.detail === name) show = true"
            @close-modal="show = false"
            @keydown.escape.window="show = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-xs "
            style="display:none"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4 -translate-x-4"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transiion:leave-end="opacity-0 -translate-x-4 -translate-y-4"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-{{ $name }}-title"
            :aria-hidden="!show"
            tabindex="=1"
            >
                <div
                    class="border-2 border-neutral-content/10 rounded-lg p-4 shadow-xl max-w-2xl w-full max-h-[80dvh] overflow-auto"
                    @click.away="show = false"
                >
                    <div class="flex items-center justify-between">
                        <h2 id="modal-{{ $name }}-title" class="text-xl font-bold">{{ $title }}</h2>
                        <button aria-label="close modal" @click="show = false">
                            <x-icons.close class="w-4 cursor-pointer hover:text-primary"  />
                    </div>
                    <div class="mt-4">
                    {{ $slot }}
                    </div>
            </div>
        </div>
