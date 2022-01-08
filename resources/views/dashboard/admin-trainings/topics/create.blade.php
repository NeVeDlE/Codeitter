<x-layout>
    <x-training-settings heading="{{$training->name}} Topics" :training="$training">
        <form method="POST" action="/trainings/{{$training->slug}}/topics/">
            @csrf
            <x-form.input name="name" type="text" required/>
            <div class="mb-6">
                <x-submit-button>Publish</x-submit-button>
            </div>
        </form>
    </x-training-settings>
</x-layout>
