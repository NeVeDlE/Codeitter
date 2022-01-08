<x-layout>
    <x-panel class="mt-4 mx-auto w-96">
        <form action="/settings" class="items-center" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="username" type="text" required :value="old('username',Auth::User()->username)"/>
            <x-form.input name="email" type="email" required :value="old('email',Auth::User()->email)"/>
            <x-form.input name="handle" type="text" :value="old('handle',Auth::User()->handle)"/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail',Auth::User()->thumbnail)"/>
                </div>
                <img src="{{asset('storage/'.Auth::User()->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-submit-button>Update</x-submit-button>
        </form>
    </x-panel>
</x-layout>
