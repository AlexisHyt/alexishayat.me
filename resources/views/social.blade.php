<article id="social">

    <div class="social_item social_open_handler">
        <a target="_blank" class="social_open_link">
            <x-icon name="bxs-contact" style="--hover: #fff"/>
        </a>
    </div>

    <div class="social_items_wrapper">
        <?php
        $socials = [
            'Github' => [
                'url' => 'https://github.com/AzenoX',
                'icon' => 'github',
                'color' => '#565252'
            ],
            'Linkedin' => [
                'url' => 'https://www.linkedin.com/in/alexis-hayat-b826a7162/',
                'icon' => 'linkedin',
                'color' => '#0A66C2'
            ],
            'Codepen' => [
                'url' => 'https://codepen.io/AzenoX',
                'icon' => 'codepen',
                'color' => '#000000'
            ],
            'Instagram' => [
                'url' => 'https://www.instagram.com/azenox_/',
                'icon' => 'instagram',
                'color' => '#E4405F'
            ],
            'Twitter' => [
                'url' => 'https://twitter.com/AzenoX_',
                'icon' => 'twitter',
                'color' => '#0A66C2'
            ],
            'Youtube' => [
                'url' => 'https://www.youtube.com/user/Azen0xGaming',
                'icon' => 'youtube',
                'color' => '#FF0000'
            ],
            'Spotify' => [
                'url' => 'https://open.spotify.com/artist/7hCwcXSWMVS9axmIa0mEhy',
                'icon' => 'spotify',
                'color' => '#1DB954'
            ],
            'Twitch' => [
                'url' => 'https://www.twitch.tv/azenox_',
                'icon' => 'twitch',
                'color' => '#9146FF'
            ],
        ];
        ?>

        @foreach($socials as $name => $social)
            <div class="social_item">
                <a href="{{ $social['url'] }}" target="_blank">
                    <x-icon name="{{ $social['icon'] }}" style="--hover: {{ $social['color'] }}"/>
                </a>
            </div>
        @endforeach
    </div>

</article>
