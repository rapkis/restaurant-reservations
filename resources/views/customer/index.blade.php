@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between pb-4">
        <h1 class="text-3xl text-gray-800">Customers</h1>
    </div>
    <div class="overflow-scroll">
        <table class="table-auto w-full text-gray-800">
            <thead>
            <tr>
                <th class="border px-4 py-2">First Name</th>
                <th class="border px-4 py-2">Last Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Total reservations</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td class="border px-4 py-2">{{ $customer->first_name }}</td>
                    <td class="border px-4 py-2">{{ $customer->last_name }}</td>
                    <td class="border px-4 py-2">{{ $customer->email }}</td>
                    <td class="border px-4 py-2">{{ $customer->phone }}</td>
                    <td class="border px-4 py-2">{{ $customer->reservations->count() }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex">
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                <button onclick="return confirm('Are you sure you want to delete this customer?')" class="focus:outline-none">
                                    <span class="bg-red-500 text-white text-xs p-1 rounded">Delete</span>
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
