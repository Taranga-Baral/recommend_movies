<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Recommender</title>
    <style>
        :root {
            --surface-color: #fff;
            --curve: 40;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans JP', sans-serif;
            background-color: #fef8f8;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 4rem 5vw;
            padding: 0;
            list-style-type: none;
        }

        .card {
            position: relative;
            display: block;
            height: 100%;
            border-radius: calc(var(--curve) * 1px);
            overflow: hidden;
            text-decoration: none;
        }

        .card__image {
            width: 100%;
            height: 35vh;
        }

        .card__overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1;
            border-radius: calc(var(--curve) * 1px);
            background-color: var(--surface-color);
            transform: translateY(100%);
            transition: .2s ease-in-out;
        }

        .card:hover .card__overlay {
            transform: translateY(0);
        }

        .card__header {
            position: relative;
            display: flex;
            align-items: center;
            gap: 2em;
            padding: 2em;
            border-radius: calc(var(--curve) * 1px) 0 0 0;
            background-color: var(--surface-color);
            transform: translateY(-100%);
            transition: .2s ease-in-out;
        }

        .card__arc {
            width: 80px;
            height: 80px;
            position: absolute;
            bottom: 100%;
            right: 0;
            z-index: 1;
        }

        .card__arc path {
            fill: var(--surface-color);
            d: path("M 40 80 c 22 0 40 -22 40 -40 v 40 Z");
        }

        .card:hover .card__header {
            transform: translateY(0);
        }

        .card__thumb {
            flex-shrink: 0;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .card__title {
            font-size: 1em;
            margin: 0 0 .3em;
            color: #6A515E;
        }

        .card__tagline {
            display: block;
            margin: 1em 0;
            font-family: "MockFlowFont";
            font-size: .8em;
            color: #D7BDCA;
        }

        .card__status {
            font-size: .8em;
            color: #D7BDCA;
        }

        .card__description {
            padding: 0 2em 2em;
            margin: 0;
            color: #D7BDCA;
            font-family: "MockFlowFont";
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 5;
            overflow: hidden;
        }



        /* Form Styling Starts */

        .form-container {
            max-width: 100vw;
            margin: auto;
            padding: 20px;
            background-color: #2f97d3;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="checkbox"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select[multiple] {
            height: 120px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ff006a;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #df102c;
        }

        /* Form Styling Ends  */



    </style>
</head>

<body>

    <x-navbar-component></x-navbar-component>



    <h2>Your Movie recommendations</h2>
    <h4>As per your Movies Selected, here are your Recommendations</h4>
    <ul class="cards">
        @foreach ($recommendedMovies as $recommendedMovie)

            <li>
                <a class="card">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $recommendedMovie['poster_path'] }}"
                        alt="{{ $recommendedMovie['title'] }}" class="card__image">
                    <div class="card__overlay">
                        <div class="card__header">
                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                <path />
                            </svg>
                            <img src="{{ 'https://image.tmdb.org/t/p/original/' . $recommendedMovie['backdrop_path'] }}"
                                alt="{{ Str::limit($recommendedMovie['title'], 3, '...') }}" class="card__thumb">
                            <div class="card__header-text">
                                <h3 class="card__title">{{ $recommendedMovie['title'] }}</h3>
                                <span class="card__status">P : {{ $recommendedMovie['popularity'] }}, RD:
                                    {{ $recommendedMovie['release_date'] }}</span>
                            </div>
                        </div>
                        <p class="card__description">{{ $recommendedMovie['overview'] }}</p>
                    </div>


                </a>




            </li>
        @endforeach
    </ul>



</body>

</html>
