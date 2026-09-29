<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Characters - Show</title>
</head>
<body class="bg-gray-800 flex justify-center content-center h-screen p-40">

<div class="text-white bg-gray-700 h-60 w-80 shadow-2xl flex flex-col gap-3 p-4">
    <a class="hover:text-gray-400" href="{{route('index')}}">← Back</a>

    <h1 class="text-2xl text-center font-bold">{{$character->name}}</h1>
    <p>Game: {{$character->game}}</p>
    <p>Released: {{$character->released->format('d-m-Y')}}</p>
</div>

</body>
</html>
