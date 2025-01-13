{{-- the movie listing page (displaying the list of all possible movies available via query) --}}
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

    select, input[type="checkbox"] {
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


    <h2>Trending Tops</h2>
    <h4>Select your All Time Best Movies From Here</h4>
    <ul class="cards">
        @foreach ($movies as $movie)
        <li>
            <form action="{{ route('movie-page.store') }}" method="post">
                @csrf

                <input type="hidden" name="title" value="{{ $movie['title'] }}">
                <input type="hidden" name="db_movie_id" value="{{ $movie['id'] }}">
                <input type="hidden" name="original_title" value="{{ $movie['original_title'] }}">
                <input type="hidden" name="overview" value="{{ $movie['overview'] }}">
                <input type="hidden" name="popularity" value="{{ $movie['popularity'] }}">
                <input type="hidden" name="poster_path" value="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}">
                <input type="hidden" name="release_date" value="{{ $movie['release_date'] }}">
                <input type="hidden" name="original_language" value="{{ $movie['original_language'] }}">
                <input type="hidden" name="adult" value="{{ $movie['adult'] }}">
                <input type="hidden" name="type" value="all_time_best_movies">
                <input type="hidden" name="backdrop_path" value="{{ 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'] }}">

                <a class="card">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="card__image">
                    <div class="card__overlay">
                      <div class="card__header">
                        <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>
                        <img src="{{ 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'] }}" alt="{{ Str::limit($movie['title'], 3, '...') }}" class="card__thumb">
                        <div class="card__header-text">
                          <h3 class="card__title">{{ $movie['title'] }}</h3>
                          <span class="card__status">P : {{ $movie['popularity'] }}, RD: {{ $movie['release_date'] }}</span>
                        </div>
                      </div>
                      <p class="card__description">{{ $movie['overview'] }}</p>
                    </div>


                  </a>

                  <button type="submit">This is my Best Movie Ever - Select this</button>
            </form>

          </li>
        @endforeach
      </ul>

      {{-- Form  --}}
      <form action="{{ route('movie-page.index') }}" method="GET" class="form-container">
        <div class="form-group">
            <label for="include_adult">Include Adult:</label>
            <input type="checkbox" id="include_adult" name="include_adult" {{ $includeAdult ? 'checked' : '' }} value="true">
        </div>

        <div class="form-group">
            <label for="language">Language:</label>
            <select id="language" name="language">
                <option value="en-US" {{ $language === 'en-US' ? 'selected' : '' }}>English</option>
                <option value="es-ES" {{ $language === 'es-ES' ? 'selected' : '' }}>Spanish</option>
                <option value="fr-FR" {{ $language === 'fr-FR' ? 'selected' : '' }}>French</option>
                <option value="de-DE" {{ $language === 'de-DE' ? 'selected' : '' }}>German</option>
                <option value="it-IT" {{ $language === 'it-IT' ? 'selected' : '' }}>Italian</option>
                <option value="ja-JP" {{ $language === 'ja-JP' ? 'selected' : '' }}>Japanese</option>
                <option value="ko-KR" {{ $language === 'ko-KR' ? 'selected' : '' }}>Korean</option>
                <option value="ru-RU" {{ $language === 'ru-RU' ? 'selected' : '' }}>Russian</option>
                <option value="zh-CN" {{ $language === 'zh-CN' ? 'selected' : '' }}>Chinese (Simplified)</option>
                <option value="pt-BR" {{ $language === 'pt-BR' ? 'selected' : '' }}>Portuguese (Brazil)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sort_by">Sort By:</label>
            <select id="sort_by" name="sort_by">
                <option value="popularity.desc" {{ $sortBy === 'popularity.desc' ? 'selected' : '' }}>Popularity Descending</option>
                <option value="popularity.asc" {{ $sortBy === 'popularity.asc' ? 'selected' : '' }}>Popularity Ascending</option>
                <option value="release_date.desc" {{ $sortBy === 'release_date.desc' ? 'selected' : '' }}>Release Date Descending</option>
                <option value="release_date.asc" {{ $sortBy === 'release_date.asc' ? 'selected' : '' }}>Release Date Ascending</option>
                <option value="vote_count.desc" {{ $sortBy === 'vote_count.desc' ? 'selected' : '' }}>Vote Count Descending</option>
                <option value="vote_count.asc" {{ $sortBy === 'vote_count.asc' ? 'selected' : '' }}>Vote Count Ascending</option>
                <option value="vote_average.desc" {{ $sortBy === 'vote_average.desc' ? 'selected' : '' }}>Vote Average Descending</option>
                <option value="vote_average.asc" {{ $sortBy === 'vote_average.asc' ? 'selected' : '' }}>Vote Average Ascending</option>
                <option value="revenue.desc" {{ $sortBy === 'revenue.desc' ? 'selected' : '' }}>Revenue Descending</option>
                <option value="revenue.asc" {{ $sortBy === 'revenue.asc' ? 'selected' : '' }}>Revenue Ascending</option>
            </select>
        </div>

        <div class="form-group">
            <label for="genre">Genre:</label>
            <select id="genre" name="genre[]" multiple class="form-select">
                <option value="28">Action</option>
                <option value="12">Adventure</option>
                <option value="16">Animation</option>
                <option value="35">Comedy</option>
                <option value="80">Crime</option>
                <option value="99">Documentary</option>
                <option value="18">Drama</option>
                <option value="10751">Family</option>
                <option value="14">Fantasy</option>
                <option value="36">History</option>
                <option value="27">Horror</option>
                <option value="10402">Music</option>
                <option value="9648">Mystery</option>
                <option value="10749">Romance</option>
                <option value="878">Science Fiction</option>
                <option value="10770">TV Movie</option>
                <option value="53">Thriller</option>
                <option value="10752">War</option>
                <option value="37">Western</option>
            </select>
        </div>



        <label for="query">Search Movie:</label>
        <input type="text" id="query" name="query" value="{{ $query }}">
        <br><br>




        <button type="submit" class="btn btn-primary">Fetch Movies</button>
    </form>


</body>
</html>
