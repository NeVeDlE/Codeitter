<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Log In!</h1>
                <form action="/sessions" method="POST" class="mt-10">
                    @csrf
                    <x-form.input name="email" type="email" autocomplete="username"/>
                    <x-form.input name="password" type="password" autocomplete="password"/>

                    <x-submit-button>LogIn</x-submit-button>
                    @if($errors->any())
                        <uil>
                            @foreach($errors->all() as $error)
                                <li class="text-red-500 text-xs">{{$error}}</li>
                            @endforeach

                        </uil>
                    @endif
                </form>
            </x-panel>
        </main>

    </section>
</x-layout>
