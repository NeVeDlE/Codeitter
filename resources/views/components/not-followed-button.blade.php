@props(['follow'])
<form action="/connections/follow/{{$follow->username}}" method="POST">
    @csrf
<button type="submit"
        class="transition-colors duration-300 text-xs font-semibold bg-red-200 hover:bg-green-300 rounded-full py-2 px-8"
>Not Followed
</button>
    <x-form.error name="follow"/>
</form>
