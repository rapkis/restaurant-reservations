@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between pb-4">
        <h1 class="text-3xl text-gray-800">Restaurants</h1>
        <a href="{{ route('restaurants.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create new
        </a>
    </div>
    <div class="overflow-scroll">
        <table class="table-auto w-full text-gray-800">
            <thead>
            <tr>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Tables</th>
                <th class="border px-4 py-2">Reservations</th>
                <th class="border px-4 py-2">Open Time</th>
                <th class="border px-4 py-2">Close Time</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <td class="border px-4 py-2">{{ $restaurant->name }}</td>
                    <td class="border px-4 py-2">{{ $restaurant->tables->count() }}</td>
                    <td class="border px-4 py-2">{{ $restaurant->reservations->count() }}</td>
                    <td class="border px-4 py-2">{{ $restaurant->open_time }}</td>
                    <td class="border px-4 py-2">{{ $restaurant->close_time }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex">
                            <a href="{{ route('restaurants.edit', $restaurant->id) }}">
                                <i class="material-icons text-yellow-500">edit</i>
                            </a>
                            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="post">
                                <button onclick="return confirm('Are you sure you want to delete this?')" class="focus:outline-none">
                                    <i class="material-icons text-red-500">delete</i>
                                </button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
