<article id="technos">

    <svg id="techno_wrapper" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        @foreach(json_decode($technos)->logos as $id => $t)
            @if ($id === 'html')
                <path
                    fill="{{ $t->logo->color }}"
                    id="{{ $id }}"
                    d="{{ $t->logo->path }}"
                />
            @else
                <path
                    fill="{{ $t->logo->color }}"
                    id="{{ $id }}"
                    class="techno_icons"
                    d="{{ $t->logo->path }}"
                />
            @endif
        @endforeach
    </svg>

    <svg id="techno_text_wrapper" viewBox="0 -10 275.7 100" xmlns="http://www.w3.org/2000/svg">
        @foreach(json_decode($technos)->logos as $id => $t)
            @if ($id === 'html')
                <path
                    id="{{ $id }}_text"
                    d="{{ $t->text->path }}"
                />
            @else
                <path
                    id="{{ $id }}_text"
                    class="techno_icons"
                    d="{{ $t->text->path }}"
                />
            @endif
        @endforeach
    </svg>

    <script src="{{ mix('js/gsap.js') }}"></script>
    <script src="{{ mix('js/morph.js') }}"></script>
    <script>
        const html = document.querySelector("#html");
        const html_text = document.querySelector("#html_text");

        const tl = gsap.timeline({repeat: -1});
        tl
        @foreach(json_decode($technos)->logos as $id => $t)
            .to(html, {morphSVG:"#{{ $id }}", fill: '{{ $t->logo->color }}'}, "+=2")
            @endforeach
            .play();

        const tl_text = gsap.timeline({repeat: -1});
        tl_text
        @foreach(json_decode($technos)->logos as $id => $t)
            .to(html_text, {morphSVG:"#{{ $id }}_text"}, "+=2")
            @endforeach
            .play();
    </script>

</article>
