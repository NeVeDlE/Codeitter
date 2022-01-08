<x-layout>
    <x-training-settings heading="{{$training->name}} Topics" :training="$training">
        <form method="POST" action="/trainings/{{$training->slug}}/topics/update/{{$topic->name}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="name" :value="old('name',$topic->name)"/>
            <div class="mb-6">
                <x-submit-button>Update</x-submit-button>
            </div>
        </form>

    </x-training-settings>
</x-layout>
