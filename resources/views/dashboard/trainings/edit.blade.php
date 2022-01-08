<x-layout>
    <x-settings :heading="'Edit Training: '.$training->name">
        <form method="POST" action="/trainings/{{$training->slug}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name',$training->name)"/>
            <x-form.input name="tag" :value="old('tag',$training->tag)"/>
            <x-form.input name="start" type="date" :value="old('start',$training->start)"/>
            <x-form.input name="end" type="date" :value="old('end',$training->end)"/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail',$training->thumbnail)"/>
                </div>
                <img src="{{asset('storage/'.$training->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-form.textarea name="description">{{old('description',$training->description)}}</x-form.textarea>

            <div class="mb-6">
                <x-submit-button>Update</x-submit-button>
            </div>
        </form>

    </x-settings>
</x-layout>
