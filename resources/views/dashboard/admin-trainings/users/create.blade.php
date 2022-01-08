<x-layout>
    <x-training-settings heading="Members join training" :training="$training">
        <form method="POST" action="/trainings/{{$training->slug}}/members" enctype="multipart/form-data">
            @csrf
            <h4 class="my-5">You want to join {{$training->name}} ?</h4>
            <input type="text" name="user_id" hidden value="{{auth()->id()}}">

            <div class="mb-6">
                <x-submit-button>Yes</x-submit-button>
                <a href="/"
                   class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Nah</a>
            </div>
            <x-form.error name="user_id"/>
        </form>
    </x-training-settings>

</x-layout>
