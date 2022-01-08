<x-layout>
    <a href="/messages"
       class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
            <g fill="none" fill-rule="evenodd">
                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                </path>
                <path class="fill-current"
                      d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                </path>
            </g>
        </svg>

        Back to Messages
    </a>
    <x-panel class="my-5">

        <div class="overflow-y-auto h-96 ">

            @foreach($messages->reverse() as $message)
                @if($message->sender==$sender->id)
                    <div class="text-left break-all">
                        <a href="/profile/{{$sender->username}}" class="font-bold">{{$sender->name}} :
                        </a>
                        <p>
                            {{$message->body}}
                        </p>
                        <hr>
                    </div>
                @else
                    <div class="text-right break-all">
                        <a href="/profile/{{Auth::User()->username}}" class="font-bold">{{Auth::User()->name}} :
                        </a>
                        <p>
                            {{$message->body}}
                        </p>
                        <hr>
                    </div>
                @endif
            @endforeach
            {{$messages->links()}}

        </div>


    </x-panel>
    <form action="/messages/{{$sender->username}}" method="POST" class="">
        @csrf
        <div class="items-center mx-auto w-96  my-auto break-all">
            <div class="mt-6">
                            <textarea name="body" id="" class="w-full text-sm focus:outline-none focus:ring"
                                      rows="5" placeholder="Send a message!" required></textarea>
                @error('body')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                <x-submit-button>Send</x-submit-button>
            </div>
        </div>
    </form>
</x-layout>
