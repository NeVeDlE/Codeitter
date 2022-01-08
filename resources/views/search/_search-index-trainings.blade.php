@if($trainings->count())
    <div class="flex flex-col mt-5">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <h5 class="m-4">Trainings</h5>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($trainings as $training)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            <p>
                                                {{$training->name}}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <p
                                        class="px-3 py-1 rounded-full text-blue-800 text-xs uppercase font-semibold"
                                        style="font-size: 10px">Members : {{$training->members->count()}}</p>
                                </td>
                                @cannot('trainingMember',$training)
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/trainings/{{$training->slug}}/members"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" name="user_id" hidden value="{{auth()->id()}}">
                                            <x-submit-button>Join</x-submit-button>
                                            <x-form.error name="user_id"/>
                                        </form>
                                    </td>
                                @else
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <h6 class=" uppercase font-semibold text-xs py-2 px-10 rounded-2xl">
                                            Already a Member</h6>
                                    </td>
                                @endcannot
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    {{$trainings->links()}}
                </div>
            </div>
        </div>
    </div>
@endif
