@if($users->count())
    <tr>

        <div class="flex flex-col mt-3">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <h5 class="m-4">Users</h5>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                @if($user->id==auth()->id())
                                    @continue
                                @endif
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900 flex items-center">
                                                @if($user->thumbnail)
                                                    <img src="{{asset('storage/'.$user->thumbnail)}}"
                                                         class="rounded-full mr-3"
                                                         width="50"
                                                         height="50" alt="Lary avatar">
                                                @endif
                                                <div>
                                                    <h5 class="font-bold"><a
                                                            href="/profile/{{$user->username}}">{{$user->name}}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <p
                                            class="px-3 py-1 rounded-full text-blue-800 text-xs uppercase font-semibold"
                                            style="font-size: 10px">Followers : {{$user->followers->count()}}</p>
                                    </td>
                                    @if(auth()->id()!=$user->id)
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="space-x-2">

                                                <x-a-connections :following="Auth::User()->following"
                                                                 :currentPerson="$user"/>
                                            </div>

                                        </td>
                                    @endif
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>


    </tr>
@endif
