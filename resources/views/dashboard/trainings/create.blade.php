<x-layout>
    <x-settings heading="Publish New Training">
        <form method="POST" action="/trainings" enctype="multipart/form-data">
            @csrf
            <x-form.input name="name" type="text" required/>
            <x-form.input name="tag" type="tag" required/>
            <x-form.textarea name="description"></x-form.textarea>
            <x-form.input name="start" type="date" required/>
            <x-form.input name="end" type="date" required/>
            <x-form.input name="thumbnail" type="file" required/>
            <div class="mb-6">
                <x-submit-button>Publish</x-submit-button>
            </div>
        </form>
    </x-settings>

</x-layout>
