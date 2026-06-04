<x-layout title="Home">

   {{ $greeting }} {{ $person }}
<div>
   @if (count($tasks))
        @foreach($tasks AS $task)
       <li>{{  $task }}</li>
        @endforeach
    @else Yikers
   @endif
   </div>
</x-layout>
