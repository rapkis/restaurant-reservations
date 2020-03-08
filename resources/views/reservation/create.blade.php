@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between pb-4">
        <h1 class="text-3xl text-gray-800">Create a reservation</h1>
    </div>
    <form class="w-full max-w-lg mx-auto" method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="restaurant_id">
                    Restaurant<span class="text-red-500">*</span>
                </label>
                <select id="restaurant_id" name="restaurant_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3">
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                    @endforeach
                </select>
                @error('restaurant_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="reservation_start">
                    Date and time<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="reservation_start"
                       name="reservation_start"
                       type="datetime-local"
                       value="{{ old('reservation_start') ?? '' }}"
                       required>
                @error('reservation_start')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="reservation_end">
                    Reservation Duration (hours)<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="reservation_end"
                       name="reservation_end"
                       type="time"
                       value="{{ old('reservation_end') ?? '' }}"
                       required>
                @error('reservation_end')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="party_size">
                    Party Size<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="party_size"
                       name="party_size"
                       type="number"
                       step="1"
                       min="1"
                       placeholder="4"
                       value="{{ old('party_size') ?? '' }}"
                       required>
                @error('party_size')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first_name">
                    First Name<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="first_name"
                       name="first_name"
                       type="text"
                       placeholder="Harry"
                       value="{{ old('first_name') ?? '' }}"
                       required>
                @error('first_name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last_name">
                    Last Name<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="last_name"
                       name="last_name"
                       type="text"
                       placeholder="Potter"
                       value="{{ old('last_name') ?? '' }}"
                       required>
                @error('last_name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Email<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="email"
                       name="email"
                       type="email"
                       placeholder="harrypotter@hogwarts.co.uk"
                       value="{{ old('email') ?? '' }}"
                       required>
                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                    Phone<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="phone"
                       name="phone"
                       type="tel"
                       placeholder="+37064867382"
                       value="{{ old('phone') ?? '' }}"
                       required>
                @error('phone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col md:flex-row w-full justify-around leading-none text-center">
            <a href="{{ route('restaurants.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-2">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
                Save
            </button>
        </div>
    </form>
@endsection
