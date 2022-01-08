@props(['post','training'])
<article
    {{$attributes->merge(['class'=>"transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"])}}>
    <div class="py-6 px-5">
        @if($post->thumbnail)
            <div>

                <img src="{{asset('storage/'.$post->thumbnail)}}" alt="Blog Post illustration"
                     class="rounded-xl mx-auto ">
            </div>
        @endif
        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <a href="/trainings/{{$training->slug}}/posts"
                       class="px-3 py-1 border border-blue-500 rounded-full text-blue-500 text-xs uppercase font-semibold"
                       style="font-size: 10px">{{$training->name}}</a>
                </div>

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

            <div class="text-sm mt-4 space-y-4">
                {!!  $post->excerpt!!}

            </div>

            <footer class=" inline-table flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    @if($post->author->thumbnail)
                        <img src="{{asset('storage/'.$post->author->thumbnail)}}" width="50" height="50"
                             class="rounded-full" alt="Lary avatar">
                    @endif
                    <div class="ml-3">
                        <h5 class="font-bold"><a href="/?author={{$post->author->username}}">{{$post->author->name}}</a>
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
