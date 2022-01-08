<x-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <x-panel class="mt-5">
        @if($posts->count()||$users->count())
            <h5 class="mb-4">Showing results for "{{request('search')}}"</h5>
            @include('search._search-index-users')
            @include('search._search-index-posts')
            @include('search._search-index-trainings')
        @else
            <p>No results found.</p>
        @endif
    </x-panel>
</x-layout>
