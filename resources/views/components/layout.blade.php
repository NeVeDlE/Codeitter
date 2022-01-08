<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Codeitter</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<body style="font-family: Open Sans, sans-serif">
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <h1 class="text-4xl">
                    <span class="text-blue-500">Codeitter</span>
                </h1>
            </a>
        </div>
        @auth
            <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">

                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                    <form method="GET" action="/search">
                        <input type="text" name="search" placeholder="Find something"
                               class="bg-transparent placeholder-black font-semibold text-sm"
                               value="{{request('search')}}">
                        <x-submit-button>Search</x-submit-button>
                    </form>
                </div>
            </div>
        @endauth

        <div class="mt-8 md:mt-0 flex items-center">
            @auth
                <a class="mr-5" href="/messages"><span
                        class="text-xs font-bold uppercase">Messages {{\App\Models\Message::unreadMessagesCount()}}</span></a>
                <x-dropdown class="mr-5">
                    <x-slot name="trigger">
                        <span class="text-xs font-bold uppercase">Discover</span>
                    </x-slot>

                    <x-dropdown-item href="/discover/users"
                                     :active="request()->routeIs('discover-users')">Users
                    </x-dropdown-item>
                    <x-dropdown-item href="/discover/trainings"
                                     :active="request()->routeIs('discover-trainings')">Trainings
                    </x-dropdown-item>
                    <x-dropdown-item href="/discover/posts" :active="request()->routeIs('discover-posts')">Posts
                    </x-dropdown-item>
                </x-dropdown>

                <x-dropdown>
                    <x-slot name="trigger">
                        <span class="text-xs font-bold uppercase">Welcome, {{auth()->user()->name }}!</span>
                    </x-slot>

                    <x-dropdown-item href="/posts/{{Auth::user()->username}}/myposts"
                                     :active="request()->routeIs('myPosts')">Dashboard
                    </x-dropdown-item>
                    <x-dropdown-item href="/settings"
                                     :active="request()->routeIs('settings')">Settings
                    </x-dropdown-item>
                    <x-dropdown-item href="#" x-data="{}"
                                     @click.prevent="document.querySelector('#logout-form').submit()">Log Out
                    </x-dropdown-item>
                </x-dropdown>
                <form id="logout-form" action="/logout" method="POST"
                      class="text-xs font-semibold text-blue-500 ml-6 hidden">
                    @csrf
                </form>
            @else
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class=" ml-6 text-xs font-bold uppercase">Log In</a>
            @endauth


        </div>
    </nav>

    {{$slot}}


    <footer id="newsletter"
            class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <h5 class="text-3xl">This is a Social Media Simulator i <a
                href="https://www.linkedin.com/in/mostafa-shaher-4433a0223/"
                class="text-blue-500 no-underline hover:underline ... hover:text-blue-700" target="_blank">Mostafa
                Shaher</a> did to practice on.</h5>
        <p class="text-sm mt-3">the front belongs to Laracasts, Laravel from scratch series but i did add some front
            because i made new features xD</p>


    </footer>
</section>
<x-flash/>
</body>
