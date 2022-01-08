@props(['heading','username'=>\App\Models\User::where('id',auth()->id())->first()])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0">

            <h4 class="font-semibold mb-2">Posts</h4>
            <ul>

                <li>
                    <a href="/posts/{{$username->username}}/myposts/create"
                       class="{{request()->routeIs('createPosts')? 'text-blue-500':'' }}">New Post</a>
                </li>
                <li>
                    <a href="/posts/{{$username->username}}/myposts"
                       class="{{request()->routeIs('myPosts')? 'text-blue-500':'' }}">All Post</a>
                </li>
            </ul>
            <h4 class="font-semibold mb-2 mt-4">Connections</h4>
            <ul>
                <li><a href="/connections/followers" class="{{request()->routeIs('followers')? 'text-blue-500':'' }}">
                        Followers</a></li>
                <li><a href="/connections/following" class="{{request()->routeIs('following')? 'text-blue-500':'' }}">
                        Following</a></li>
            </ul>
            <h4 class="font-semibold mb-2 mt-4">Trainings</h4>
            <ul>
                <li><a href="/trainings/create" class="{{request()->routeIs('training-create')? 'text-blue-500':'' }}">New
                        Training</a></li>
                <li><a href="/trainings" class="{{request()->routeIs('trainings')? 'text-blue-500':'' }}">All
                        Trainings</a></li>
            </ul>

        </aside>

        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
