<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$user->username}}'s Profile

    </h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0 items-center text-center">

            <ul class="mb-5">

                @if(isset($user->thumbnail))
                    <img src="{{asset('storage/'.$user->thumbnail)}}" width="50" height="50"
                         class="rounded-full" alt="Lary avatar">
                @endif
                <li><h5 class="font-bold">{{$user->name}}
                    </h5></li>

            </ul>

            <h4 class="font-semibold mb-2">Connections</h4>
            <ul class="mb-5">

                <li><p>Followers : {{$user->followers->count()}}</p></li>
                <li><p class="mt-1">Following : {{$user->following->count()}}</p></li>
            </ul>
            @if(auth()->id()!=$user->id)
                <x-a-connections :following="Auth::User()->following" :currentPerson="$user"/>
                <div class="mt-5">
                    <a href="/messages/{{$user->username}}"
                       class="btransition-colors duration-300 text-xs font-semibold mt-5 bg-yellow-200 hover:bg-yellow-300 rounded-full py-2 px-8">Send
                        Message</a>
                </div>
            @endif


        </aside>

        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
