<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap"
          rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Pixel position</title>
</head>
<body class="bg-black text-white font-hanken-grotesk">
<div class="px-10">
    <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <a href="/">
            <div>
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt=""/>
            </div>
        </a>
        <div class="space-x-6 font-bold">
            <a href="#">Jobs</a>
            <a href="#">Career</a>
            <a href="#">Salaries</a>
            <a href="#">Companies</a>
        </div>

        @guest
            <div class="space-x-6 font-bold">
                <a href="/register">Sign Up</a>
                <a href="/login">Sign In</a>
            </div>
        @endguest
        @auth
            <div class="space-x-6 font-bold flex">
                <a href="{{route('jobs.create')}}">Post to a Job</a>

                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button>Log Out</button>
                </form>
            </div>
        @endauth
    </nav>

    <main class="mt-10 max-w-[986px] mx-auto">
        {{$slot}}
    </main>
</div>
</body>
</html>
