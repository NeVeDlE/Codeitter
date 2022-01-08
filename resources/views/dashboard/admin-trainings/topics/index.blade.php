<x-layout>
    <x-training-settings heading="{{$training->name}} Topics" :training="$training">
        <div class="flex flex-col">
            <main class="max-w-6xl mt-6  space-y-6">

                @if($topics->count())
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($topics as $topic)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            <p>
                                                                {{$topic->name}}
                                                            </p>

                                                        </div>
                                                    </div>
                                                </td>
                                                @can('trainingOwner',$training)

                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="/trainings/{{$training->slug}}/topics/edit/{{$topic->name}}"
                                                           class="transition-colors duration-300 text-xs font-semibold bg-green-200 hover:bg-green-300 rounded-full py-2 px-8"
                                                        >Edit</a>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <form
                                                            action="/trainings/{{$training->slug}}/topics/delete/{{$topic->name}}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="transition-colors duration-300 text-xs font-semibold bg-red-200 hover:bg-red-300 rounded-full py-2 px-8">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @endforeach

                                        <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p>No topics for this training yet.</p>

                @endif
            </main>
        </div>

    </x-training-settings>
</x-layout>
