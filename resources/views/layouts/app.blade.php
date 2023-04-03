
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        @livewireStyles
        @livewireScripts
        <script src="{{asset('js/app.js')}}"></script>
        <!-- Fonts -->
        

    </head>
    <body class="felx flex-wrap justify-center">
        <div class="flex w-full justify-left px-4 bg-purple-900 text-white">
            <a class="mx-3 py-4" href="/">Home</a>
            <a class="mx-3 py-4" href="/login">Login</a>
        </div>
        <div class="my-10 flex-justify-center">
            {{ $slot }}
        </div>
    </body>
</html>



