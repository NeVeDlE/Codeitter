<x-layout>
    <x-training-settings heading="{{$training->name}} Posts" :training="$training">

     @include('dashboard.admin-trainings.posts._posts-table')
    </x-training-settings>
</x-layout>
