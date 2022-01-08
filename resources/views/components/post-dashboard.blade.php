@props(['post'])
<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5 lg:flex">
        <div class="flex-1 lg:mr-8">
            <img src="{{asset('storage/'.$post->thumbnail)}}" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                {{--                <div class="space-x-2">--}}
                {{--                    <x-category-button :category="$post->category"/>--}}

                {{--                </div>--}}

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{$post->slug}}">
                            {{$post->title}}
                        </a>
                    </h1>
                    <span class="mt-2 block text-gray-400 text-xs">
                                        Published <time>{{$post->created_at->diffForHumans()}}</time>
                                    </span>
                </div>
            </header>

            <div class="text-sm mt-2 space-y-4">
                {!!  $post->excerpt!!}
            </div>
            <footer class="inline-table flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="{{asset('storage/'.$post->author->thumbnail)}}" class="rounded-full" width="50"
                         height="50" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold"><a href="/profile/{{$post->author->username}}">{{$post->author->name}}</a>
                        </h5>
                    </div>
                </div>
                <div class="inline-table lg:block flex mt-2 ">
                    <a href="/posts/{{$post->slug}}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                    @can('postOwner',$post)
                        <a href="/posts/myposts/{{$post->id}}/edit"
                           class="transition-colors duration-300 text-xs font-semibold bg-green-200 hover:bg-green-300 rounded-full py-2 px-8"
                        >Edit</a>
                        <form action="/posts/myposts/{{$post->id}}/delete" method="POST" class="mt-5">
                            @csrf
                            @method('DELETE')
                            <button
                                class="transition-colors duration-300 text-xs font-semibold bg-red-200 hover:bg-red-300 rounded-full py-2 px-8">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>

            </footer>
        </div>
    </div>
</article>
