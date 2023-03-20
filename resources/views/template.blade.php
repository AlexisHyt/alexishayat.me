<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Alexis Hayat - Portfolio</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js" defer></script>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Loader Manager -->
    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #333333;

            z-index: 9999999;
        }

        .loader-wrapper {
            --loader-color: #fff;

            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .loader-wrapper p {
            margin-top: 2em;

            font-family: Lato, sans-serif;
            color: var(--loader-color);
            font-size: 1.5em;
        }
        .loader-wrapper .loader {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 5px;

            transform: rotate(45deg);
        }
        .loader-wrapper .loader span {
            background: var(--loader-color);
            height: 40px;
            width: 40px;

            transform: scale(0);
        }

        /*=======================
            Loader 3 - Switch Out
        ========================*/
        .loader-wrapper.loader--switch-out .loader span:nth-child(1) {
            animation: loader-animation--1 1s cubic-bezier(.67,.12,.23,.93) 0.4s forwards infinite;
        }
        .loader-wrapper.loader--switch-out .loader span:nth-child(2) {
            animation: loader-animation--2 1s cubic-bezier(.67,.12,.23,.93) 0.2s forwards infinite;
        }
        .loader-wrapper.loader--switch-out .loader span:nth-child(3) {
            animation: loader-animation--3 1s cubic-bezier(.67,.12,.23,.93) 0.2s forwards infinite;
        }
        .loader-wrapper.loader--switch-out .loader span:nth-child(4) {
            animation: loader-animation--4 1s cubic-bezier(.67,.12,.23,.93) 0.4s forwards infinite;
        }

        @keyframes loader-animation--1 {
            0% {
                transform: scale(0);
            }

            10% {
                transform: scale(0);
                transform-origin: bottom right;
            }
            40% {
                transform: scale(1);
                transform-origin: bottom right;
            }

            60% {
                transform: scale(1);
                transform-origin: top left;
            }
            90% {
                transform: scale(0);
                transform-origin: top left;
            }

            100% {
                transform: scale(0);
            }
        }
        @keyframes loader-animation--2 {
            0% {
                transform: scale(0);
            }

            10% {
                transform: scale(0);
                transform-origin: bottom left;
            }
            40% {
                transform: scale(1);
                transform-origin: bottom left;
            }

            60% {
                transform: scale(1);
                transform-origin: top right;
            }
            90% {
                transform: scale(0);
                transform-origin: top right;
            }

            100% {
                transform: scale(0);
            }
        }
        @keyframes loader-animation--3 {
            0% {
                transform: scale(0);
            }

            10% {
                transform: scale(0);
                transform-origin: top right;
            }
            40% {
                transform: scale(1);
                transform-origin: top right;
            }

            60% {
                transform: scale(1);
                transform-origin: bottom left;
            }
            90% {
                transform: scale(0);
                transform-origin: bottom left;
            }

            100% {
                transform: scale(0);
            }
        }
        @keyframes loader-animation--4 {
            0% {
                transform: scale(0);
            }

            10% {
                transform: scale(0);
                transform-origin: top left;
            }
            40% {
                transform: scale(1);
                transform-origin: top left;
            }

            60% {
                transform: scale(1);
                transform-origin: bottom right;
            }
            90% {
                transform: scale(0);
                transform-origin: bottom right;
            }

            100% {
                transform: scale(0);
            }
        }
    </style>

    <!-- Hotjar Tracking Code for my site -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3384880,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
</head>

<body>
    <div id="loader">
        <div class="loader-wrapper loader--switch-out">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <p>Portfolio is Loading....</p>
        </div>
    </div>

    <div id="bg_video">
        <video src="{{ rand(0, 5) === 0 ? asset('assets/coruscant.mp4') : asset('assets/bg.mp4') }}" autoplay loop muted preload="none"></video>
    </div>

    @yield('content')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#loader').fadeOut();
        });
    </script>
</body>

</html>
