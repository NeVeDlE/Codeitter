<x-layout>
    <x-settings heading="Manage Posts">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <main class="max-w-6xl mt-6  space-y-6">

                @if($following->count())
                    @foreach($following as $follow)
                        <div class="flex items-center text-sm">
                            <img src="{{asset('storage/'.$follow->thumbnail)}}" class="rounded-full" width="50"
                                 height="50" alt="Lary avatar">
                            <div class="ml-3">
                                <h5 class="font-bold"><a
                                        href="/profile/{{$follow->username}}">{{$follow->name}}</a>
                                </h5>
                            </div>
                            <div class="inline:grid lg:block flex ml-96 flex-shrink-0 ">
                                <x-followed-button :follow="$follow"/>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>You dont follow anyone.</p>
                @endif

            </main>
        </div>

    </x-settings>

</x-layout>
