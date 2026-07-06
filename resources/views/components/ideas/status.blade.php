@props(['status'])
@php
    $classes = 'text-xs inline-block rounded-full border px-2 py-1 font-medium';

    switch ($status) {
        case \App\Enums\IdeaState::PENDING:
            $classes .= ' text-yellow-500 bg-yellow-500/20';
            break;

        case \App\Enums\IdeaState::IN_PROGRESS:
            $classes .= ' text-blue-500 bg-blue-500/20';
            break;

        case \App\Enums\IdeaState::COMPLETE:
            $classes .= ' text-green-500 bg-green-500/20';
            break;
    }
@endphp

 <span {{  $attributes(['class' => $classes]) }}>
                {{ $slot }}
</span>
