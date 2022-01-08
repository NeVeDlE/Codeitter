@auth
    <div class="inline-table lg:block flex mt-2">
        @if(!$liked)
            <form action="/posts/{{$post->slug}}/like" method="POST">
                @csrf
                <button type="submit"
                        class=" bg-gray-300 text-white font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-red-500">
                    Like
                </button>
            </form>
            @if($likes_count)
                <div class="ml-1 mt-1">
                    <p>Liked by {{$likes_count}}</p>
                </div>
            @else
                <div class="ml-1 mt-1">
                    <p>No likes yet ...</p>
                </div>
            @endif
        @else
            <form action="/posts/{{$post->slug}}/like" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 text-white font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-300">
                    Like
                </button>
            </form>
            @if($likes_count)
                <div class="ml-1 mt-1">
                    <p>Liked by {{$likes_count}}</p>
                </div>
            @else
                <div class="ml-1 mt-1">
                    <p>No likes yet ...</p>
                </div>
            @endif
        @endif
    </div>
@endauth
