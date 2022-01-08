@props(['users'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{Auth::User()->username}}'s Messages
    </h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0 items-center">

            <ul class="mb-5">

                @foreach($users as $user)

                    @if($user->id!=auth()->id())
                        <li class="my-5"><a class="font-bold"
                                            href="/messages/{{$user->username}}">{{$user->username}}
                            </a></li>
                    @endif
                @endforeach
                {{$users->links()}}


            </ul>

        </aside>

        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
