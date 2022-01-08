<x-layout>
    <x-training-settings heading="Members role change" :training="$training">
        <form method="POST" action="/trainings/{{$training->slug}}/members/{{$member->id}}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="name" readonly value="{{$member->member->name}}"/>
            <x-form.input name="handle" readonly value="{{$member->member->handle}}"/>
            <div class="mb-6">
                <label for="role"
                       class="block mb-2 uppercase font-bold text-xs text-gray-700">Role</label>
                <select name="role" id="role">
                    <option value="owner"
                        {{old('role',$member->role)=='owner' ?'selected':''}}
                    >Owner
                    </option>
                    <option value="instructor"
                        {{old('role',$member->role)=='instructor' ?'selected':''}}
                    >Instructor
                    </option>
                    <option value="member"
                        {{old('role',$member->role)=='member' ?'selected':''}}
                    >Member
                    </option>

                </select>
                @error('role')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-submit-button>Update</x-submit-button>
            </div>
            @error('owner')
            <span class="text-xs text-red-500">{{$message}}</span>
            @enderror
        </form>
    </x-training-settings>
</x-layout>
