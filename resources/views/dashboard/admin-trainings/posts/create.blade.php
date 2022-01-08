<x-layout>
    <x-training-settings heading="{{$training->name}} Posts" :training="$training">
        <form method="POST" action="/trainings/{{$training->slug}}/posts/store" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title" :value="old('title')"/>
            <x-form.input name="thumbnail" type="file" :value="old('thumbnail')"/>
            <x-form.textarea name="excerpt">{{old('excerpt')}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body')}}</x-form.textarea>

            <div class="mb-6">
                <x-submit-button>Publish</x-submit-button>
            </div>
        </form>
    </x-training-settings>
</x-layout>
