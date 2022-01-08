<x-layout>
    <x-settings heading="Manage Posts">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <main class="max-w-6xl mt-6  space-y-6">

                @if($followers->count())
                    @foreach($followers as $follower)
                        <div class="flex items-center text-sm">
                            <img src="{{asset('storage/'.$follower->thumbnail)}}" class="rounded-full" width="50"
                                 height="50" alt="Lary avatar">
                            <div class="ml-3">
                                <h5 class="font-bold"><a
                                        href="/profile/{{$follower->username}}">{{$follower->name}}</a>
                                </h5>
                            </div>
                            <div class="inline-grid lg:block ml-96 flex-shrink-0 ">
                                <x-a-connections :following="$following" :currentPerson="$follower"/>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>You have no Followers.</p>
                @endif

            </main>
        </div>

    </x-settings>

</x-layout>
