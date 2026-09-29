<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Characters - Edit</title>
</head>
<body class="bg-gray-800 flex justify-center content-center h-screen p-40">
<div class="bg-gray-700 text-white h-72 w-80 p-4">
    <a class="hover:text-gray-400" href="{{route('index')}}">← Back</a> <br>
    <h1 class="text-center text-2xl font-bold">Editing: {{$character->name}}</h1>

    <form class="flex flex-col" action="{{route('characters.update', $character->id)}}" method="POST">
        @csrf
        @method('PUT')
        <p>Character:</p>
        <input class="text-black" name="name" type="text" placeholder="Enter character name" value="{{$character->name}}">
        <p>Game:</p>
        <input class="text-black" name="game" type="text" placeholder="Enter character game" value="{{$character->game}}">
        <p>Release Date:</p>
        <input class="text-black" name="released" type="date" placeholder="Enter character's release date"
               value="{{$character->released->format('Y-m-d')}}"><br>
        <button class="block text-center bg-blue-900 h-8 text-xl text-white rounded-2xl hover:bg-blue-950" type="submit">Edit</button>
    </form>
</div>

</body>
</html>
