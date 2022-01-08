@props(['heading','training'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {!!$heading!!}
    </h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0">

            <h4 class="font-semibold mb-2">Posts</h4>
            <ul>

                <li>
                    <a href="/trainings/{{$training->slug}}/posts/create"
                       class="{{request()->routeIs('trainingCreatePosts')? 'text-blue-500':'' }}">New
                        Post</a>
                </li>
                <li>
                    <a href="/trainings/{{$training->slug}}/posts"
                       class="{{request()->routeIs('training-posts')? 'text-blue-500':'' }}">All Post</a>
                </li>
            </ul>
            <h4 class="font-semibold mb-2 mt-4">Training Members</h4>
            <ul>
                <li><a href="/trainings/{{$training->slug}}/members/showOwner" class="{{request()->routeIs('training-owner')? 'text-blue-500':'' }}">
                        Owner and Instructors</a></li>
                <li><a href="/trainings/{{$training->slug}}/members" class="{{request()->routeIs('training-members')? 'text-blue-500':'' }}">
                        Members</a></li>
            </ul>
            <h4 class="font-semibold mb-2 mt-4">Topics</h4>
            <ul>
                @can('trainingOwner',$training)
                    <li><a href="/trainings/{{$training->slug}}/topics/create"
                           class="{{request()->routeIs('topics-create')? 'text-blue-500':'' }}">
                            Add Topic</a></li>
                @endcan
                <li><a href="/trainings/{{$training->slug}}/topics"
                       class="{{request()->routeIs('topics')? 'text-blue-500':'' }}">
                        Topics List</a></li>

            </ul>
            <h4 class="font-semibold mb-2 mt-4">Problems</h4>
            <ul>
                <li><a href="#" class="{{request()->routeIs('trainings-create')? 'text-blue-500':'' }}">
                        Problems List</a></li>
            </ul>

        </aside>

        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
