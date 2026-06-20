@props(['fname', 'ftype', 'label', 'value' => null])

<label class="label" for="{{ $fname }}">{{$label}}</label>
<input value="{{ $value }}" type="{{ $ftype }}" name="{{ $fname }}" {{ $attributes->merge(['class' => 'input w-full']) }} />
<x-forms.error name="{{ $fname }}" />
