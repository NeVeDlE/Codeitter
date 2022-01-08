@props(['follow'])

<form action="/connections/unfollow/{{$follow->username}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="transition-colors duration-300 text-xs font-semibold bg-green-200 hover:bg-red-300 rounded-full py-2 px-8">
        Followed
    </button>
   <x-form.error name="follow"/>

</form>
