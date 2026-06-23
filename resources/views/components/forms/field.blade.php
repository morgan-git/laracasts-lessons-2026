@props(['fname', 'ftype', 'label' => false, 'value' => null])

@if ($label)
    <label class="label" for="{{ $fname }}">{{$label}}</label>
@endif

<input
    value="{{ $value ?? old($fname)  }}"
    type="{{ $ftype }}"
    name="{{ $fname }}"
    {{ $attributes->merge(['class' => 'input w-full']) }}
/>

<x-forms.error name="{{ $fname }}" />
