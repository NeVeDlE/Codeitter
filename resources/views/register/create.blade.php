<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 rounded-xl p-6">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form action="/register" method="POST" class="mt-10" enctype="multipart/form-data">
                @csrf
                <x-form.input name="name" required/>
                <x-form.input name="username" required/>
                <x-form.input name="handle" required/>
                <x-form.input name="email" type="email" required/>
                <x-form.input name="password" type="password" required/>
                <x-form.input name="thumbnail" type="file"/>
                <div class="mb-6">
                    <x-submit-button>Submit</x-submit-button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
