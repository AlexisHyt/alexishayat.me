<article class="projects_wrapper" style="opacity: 0;">

    @forelse(json_decode($projects) as $index => $project)
        <div class="project_wrapper flex justify-end align-center">
            <div class="left">
                @php
                    if (trim($project->type) === 'website') {
                        $borderClass = 'type-website';
                    } else if (trim($project->type) === 'lib') {
                        $borderClass = 'type-lib';
                    } else {
                        $borderClass = 'type-other';
                    }
                @endphp
                <div
                    class="project {{ $borderClass }} {{ $project->type }}"
                    style="@if($project->image) background-image: url({{ $project->image }}); background-position: center; background-size: cover; @endif"
                >
                    <h4>{{ $project->name }}</h4>
                    <p class="description">{{ $project->description }}</p>
                    <div>
                        <a class="btn" href="{{ $project->url }}" target="_blank"><p>Check on Github</p><span class="btn-bg"></span></a>
                        @if($project->homepage)
                            <a class="btn btn--green homepage-link" href="{{ $project->homepage }}" target="_blank"><p>View</p><span class="btn-bg"></span></a>
                        @endif
                    </div>
                    <div>
                        @foreach($project->langs as $lang)
                            @if($lang->title !== '__')
                                <x-icon name="{{ $lang->title }}" style="color: {{ $lang->color }}"/>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="right">
                <p>Started {{ $project->months }} month ago</p>
            </div>
        </div>
    @empty
        <p>...</p>
    @endforelse

</article>
