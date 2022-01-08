<x-layout>
    <x-settings :heading="'Edit PostInterface: '.$post->title">
        <form method="POST" action="/posts/myposts/{{$post->id}}/update" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="old('title',$post->title)"/>
            <x-form.input name="slug" :value="old('slug',$post->slug)"/>
            <div class="flex mt-6">
                <div class="flex-1">
                <x-form.input name="thumbnail" type="file" :value="old('thumbnail',$post->thumbnail)"/>
                </div>
                <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-form.textarea name="excerpt">{{old('excerpt',$post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body',$post->body)}}</x-form.textarea>

            <div class="mb-6">
                <x-submit-button>Update</x-submit-button>
            </div>
        </form>

    </x-settings>
</x-layout>
