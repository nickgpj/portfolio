<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Characters - Create</title>
</head>
<body class="bg-gray-800 flex justify-center content-center h-screen p-40">
<div class="bg-gray-700 text-white h-72 w-80 p-4">
    <a class="hover:text-gray-400" href="{{route('index')}}">← Back</a><br><br>
    <h1 class="text-center text-2xl font-bold">Add Character</h1>
    <form class="flex flex-col" action="{{route('store')}}" method="POST">
        @csrf
        <p>Character:</p>
        <input class="text-black" name="name" id="name" placeholder="Name of the Character">
        <p>Game:</p>
        <input class="text-black" name="game" id="game" placeholder="Character's Game">
        <p>Release Date:</p>
        <input class="text-black" name="released" id="released" type="date">
        <button class="block bg-green-600 text-white h-8 text-center rounded-xl mt-3 hover:bg-green-800" type="submit" name="submit">Add</button>
    </form>
</div>

</body>
</html>
