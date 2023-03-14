<article id="technos">

    <div class="top">
        <div class="left">
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
                            class="techno_icons_text"
                            d="{{ $t->text->path }}"
                        />
                    @endif
                @endforeach
            </svg>
        </div>
        <div class="right">
            <p>Experience</p>
            <div class="progress_bar">
                <span class="progress_bar_show"></span>
            </div>
            <p class="progress_bar_indicator">Work with since 8 years</p>
        </div>
    </div>

    <div class="bottom">
        @foreach(json_decode($technos)->logos as $id => $t)
            @if ($id === 'html')
                <svg class="technos_showcase" id="{{ $id }}_showcase" style="opacity: 1" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill="{{ $t->logo->color }}"
                        d="{{ $t->logo->path }}"
                    />
                </svg>
            @else
                <svg class="technos_showcase" id="{{ $id }}_showcase" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill="{{ $t->logo->color }}"
                        d="{{ $t->logo->path }}"
                    />
                </svg>
            @endif
        @endforeach
    </div>

    <script src="{{ mix('js/gsap.js') }}"></script>
    <script src="{{ mix('js/morph.js') }}"></script>
    <script>
        const html = document.querySelector("#html");
        const html_text = document.querySelector("#html_text");
        const html_progress = document.querySelector(".progress_bar_show");
        const html_progress_indicator = document.querySelector(".progress_bar_indicator");
        const technos_showcase = document.querySelectorAll(".technos_showcase");


        /*==========================
            Logo
         ==========================*/
        const tl = gsap.timeline({repeat: -1});
        tl
        @foreach(json_decode($technos)->logos as $id => $t)
            .to(html, {morphSVG:"#{{ $id }}", fill: '{{ $t->logo->color }}'}, "+=2")
            @endforeach
            .play();

        /*==========================
            Text
         ==========================*/
        const tl_text = gsap.timeline({repeat: -1});
        tl_text
        @foreach(json_decode($technos)->logos as $id => $t)
            .to(html_text, {morphSVG:"#{{ $id }}_text"}, "+=2")
            @endforeach
            .play();


        /*==========================
            Progress Bar
         ==========================*/
        const tl_progress = gsap.timeline({repeat: -1});
        tl_progress
        @foreach(json_decode($technos)->logos as $id => $t)
            .to(html_progress, {backgroundColor: '{{ $t->logo->color }}'}, "+=2")
            @endforeach
            .play();


        /*==========================
            Progress Bar Indicator
         ==========================*/
        const tl_progress_indicator = gsap.timeline({repeat: -1});
        tl_progress_indicator
        @foreach(json_decode($technos)->logos as $id => $t)
            .call(updateProgressionIndicator, ["{{ ((new DateTime('now', new DateTimeZone('Europe/Paris')))->setTimestamp($t->exp))
                            ->diff(new DateTime('now', new DateTimeZone('Europe/Paris')))
                            ->y }}"], "+=2.5")
            @endforeach
            .play();

        function updateProgressionIndicator(value) {
            value = parseInt(value);

            if (value <= 0) {
                html_progress_indicator.textContent = 'Work with since less than 1 year';
            } else if (value === 1) {
                html_progress_indicator.textContent = 'Work with since ' + value + ' year';
            } else {
                html_progress_indicator.textContent = 'Work with since ' + value + ' years';
            }
        }


        /*==========================
            Techno showcase
         ==========================*/
        const tl_showcase = gsap.timeline({repeat: -1});
        tl_showcase
        @foreach(json_decode($technos)->logos as $id => $t)
            .call(updateShowcase, ["{{ $id }}_showcase"], "+=2.5")
            @endforeach
            .play();

        function updateShowcase(techno) {
            technos_showcase.forEach((el) => el.style.opacity = '0.4');
            document.querySelector('#' + techno).style.opacity = '1';
        }
    </script>

</article>
