 @props(['name', 'title'])
 <div
            x-data="{ show: false, name: @js($name) }"
            x-show="show"
            @open-modal.window="if($event.detail === name) show = true"
            @keydown.escape.window="show = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs "
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
                    class="border-2 border-neutral-content/10 rounded-lg p-4"
                    @click.away="show = false"
                >
                    <div>
                        <h2 id="modal-{{ $name }}-title" class="text-xl font-bold">{{ $title }}</h2>
                    </div>
                    <div>
                    {{ $slot }}
                    </div>
            </div>
        </div>
