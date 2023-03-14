@extends('template')

@section('content')

    <main class="main_wrapper flex justify-between">
        <!--Description-->
        <section id="description" class="flex_1">
            <div>
                <h1 title="Alexis Hayat" class="ml16" style="opacity: 0;">Alexis Hayat</h1>
                <div class="description_content" style="opacity: 0;">
                    <p>Location: Angers, France</p>
                    <p>Age: <?= DateTime::createFromFormat('d/m/Y', '22/08/1998', new DateTimeZone('Europe/Paris'))
                            ->diff(new DateTime('now', new DateTimeZone('Europe/Paris')))
                            ->y; ?></p>
                </div>
            </div>

            <div>
                <h2 class="ml12" style="opacity: 0; margin-top: 2vh;">My Skills</h2>
                @include('technologies')
            </div>

            <div>
                @include('social')
            </div>
        </section>

        <!--Projects-->
        <section>
            @include('projects')
        </section>
    </main>

@endsection
