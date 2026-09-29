<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Characters</title>
</head>
<body class="bg-gray-800">

<header class="grid grid-rows-2 justify-items-center">
    <h1 class="text-2xl text-center text-white mb-2">Characters List</h1>
    <a class="block bg-green-600 text-white w-44 h-8 text-center rounded-xl hover:bg-green-800" href="{{route('create')}}">+ Add new Character</a>
</header>


    <div class="flex flex-wrap gap-5 justify-center">
    @foreach($characters as $character)
        <div class="flex flex-col gap-1 border-2 border-black p-10 my-5 w-56 bg-gray-700">
        <a class="text-xl text-center text-white hover:text-gray-400 m-5" href="characters/{{$character->id}}">{{$character->name}}</a>
        <a class="block text-center bg-blue-900 text-white rounded-xl hover:bg-blue-950 mb-1.5" href="characters/edit/{{$character->id}}">Edit</a>
        <form action="{{route('destroy', $character->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="w-full bg-red-600 text-white rounded-xl hover:bg-red-800" name="destroy" type="submit">Delete</button>
        </form>
        </div>
    @endforeach
    </div>
</body>
</html>
