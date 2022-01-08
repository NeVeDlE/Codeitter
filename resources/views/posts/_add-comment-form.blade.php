@auth
    <x-panel>
        <form action="/posts/{{$post->slug}}/comments" method="POST">
            @csrf
            <header class="flex items-center">

                <img src="{{asset('storage/'.Auth::User()->thumbnail)}}" class="rounded-full" width="40"
                     height="40" alt="">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-6">
                            <textarea name="body" id="" class="w-full text-sm focus:outline-none focus:ring"
                                      rows="5" placeholder="Quick, Think of something to say!" required></textarea>
                @error('body')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                <x-submit-button>Post</x-submit-button>
            </div>

        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> Or <a href="/login" class="hover:underline">Log in</a>
        to comment here.
    </p>
@endauth
