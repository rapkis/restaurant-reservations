@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between pb-4">
        <h1 class="text-3xl text-gray-800">Reservations</h1>
        <a href="{{ route('reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create new
        </a>
    </div>
    <div class="overflow-scroll">
        <table class="table-auto w-full text-gray-800">
            <thead>
            <tr>
                <th class="border px-4 py-2">Restaurant</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Party Size</th>
                <th class="border px-4 py-2">Reserved from</th>
                <th class="border px-4 py-2">Reserved until</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td class="border px-4 py-2">{{ $reservation->restaurant->name }}</td>
                    <td class="border px-4 py-2">{{ $reservation->customer->email }}</td>
                    <td class="border px-4 py-2">{{ $reservation->customer->phone }}</td>
                    <td class="border px-4 py-2">{{ $reservation->party_size }}</td>
                    <td class="border px-4 py-2">{{ $reservation->reservation_start }}</td>
                    <td class="border px-4 py-2">{{ $reservation->reservation_end->toTimeString() }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex">
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                <button onclick="return confirm('Are you sure you want to cancel this reservation?')" class="focus:outline-none">
                                    <span class="bg-red-500 text-white text-xs p-1 rounded">Cancel</span>
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
