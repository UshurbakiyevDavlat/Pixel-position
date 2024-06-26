@props(['job'])

<x-panel class="flex gap-x-6">
    <div>
       <x-employer-logo />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm">{{$job->employer->name}}</a>

        <a href="{{$job->url}}">
            <h3 class="font-bold text-xl mt-3 group-hover:text-blue-600 transition-colors duration-300">{{$job->title}}</h3>
        </a>
        <p class="text-sm text-gray-400 mt-auto">{{$job->schedule}} - from {{$job->salary}}</p>
    </div>

    <div>
        @foreach($job->tags as $tag)
            <x-tag :$tag/>
        @endforeach
    </div>
</x-panel>
