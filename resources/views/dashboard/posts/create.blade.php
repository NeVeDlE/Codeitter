@php
    $username=\App\Models\User::where('id',auth()->id())->first();
@endphp
<x-layout>
    <x-settings heading="Publish New Post">
        <form method="POST" action="/posts/{{$username->username}}/myposts" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title" :value="old('title')"/>
            <x-form.input name="slug" :value="old('slug')"/>
            <x-form.input name="thumbnail" type="file" :value="old('thumbnail')"/>
            <x-form.textarea name="excerpt">{{old('excerpt')}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body')}}</x-form.textarea>

            <div class="mb-6">
                <x-submit-button>Publish</x-submit-button>
            </div>
        </form>
    </x-settings>

</x-layout>
