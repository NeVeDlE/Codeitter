@props(['following','bool'=>false,'currentPerson'])
@foreach($following as $follow)
    @if($follow->id==$currentPerson['id'])
        <x-followed-button :follow="$follow"/>
        @php
            $bool=true;
        @endphp
        @break
    @endif
@endforeach
@if(!$bool)
    <x-not-followed-button :follow="$currentPerson"/>
@endif
