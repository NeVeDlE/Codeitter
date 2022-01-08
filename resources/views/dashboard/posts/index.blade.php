<x-layout>
    <x-settings heading="Manage Posts">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
                @if($posts->count())
                    @foreach($posts as $post)
                        <x-post-dashboard :post="$post"/>
                    @endforeach
                    {{$posts->links()}}
                @else
                    <p>No posts yet ..</p>
                @endif
            </main>
        </div>

    </x-settings>

</x-layout>
