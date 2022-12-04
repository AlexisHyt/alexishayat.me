<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alexis Hayat - Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Zen+Dots&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app2.js') }}" defer></script>

    <style>
        body {
            margin: 0;
            padding: 0;

            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

            background: #1e293b;
            height: 100vh;

            color: #e2e8f0;
        }

        #particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        img {
            height: 30vh;
        }

        h1 {
            font-family: 'Zen Dots', cursive;
        }

        .separator {
            height: 1px;
            width: 20%;

            background: #64748b;
        }

        p {
            font-family: 'Zen Dots', cursive;
        }
        p.quote {
            text-align: center;
            margin: 2vh 0 0 0;
            font-size: 1.2rem;
        }
        p.author {
            text-transform: uppercase;
            padding-left: 10vw;
            margin: 1vh 0 0 0;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div id="particles"></div>

    <img src="{{ asset('assets/images/red.jpg') }}" alt="403" class="tilted">

    <h1>ERROR 403 - FORBIDDEN</h1>

    <div class="separator"></div>

    <p class="quote">
        “Strike me down, and I will become <br>
        more powerful than you could possibly imagine.”
    </p>
    <p class="author">
        Obi-Wan Kenobi
    </p>
</body>

</html>
