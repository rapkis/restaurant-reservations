@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between pb-4">
        <h1 class="text-3xl text-gray-800">Edit restaurant</h1>
    </div>
    <form class="w-full max-w-lg mx-auto"
          method="POST"
          action="{{ route('restaurants.update', ['restaurant' => $restaurant->id]) }}"
    >
        @method('PUT')
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Name<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="name"
                       name="name"
                       type="text"
                       placeholder="Charlie Pizza"
                       value="{{ old('name') ?? $restaurant->name }}"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="open_time">
                    Open time<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="open_time"
                       name="open_time"
                       type="time"
                       value="{{ old('open_time') ?? $restaurant->open_time }}"
                       required>
                @error('open_time')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="close_time">
                    Close time<span class="text-red-500">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                       id="close_time"
                       name="close_time"
                       type="time"
                       value="{{ old('close_time') ?? $restaurant->close_time }}"
                       required>
                @error('close_time')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="flex">
                <h3>Tables</h3>
                <button class="bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold p-1 rounded"
                        onclick="addTableField()"
                >
                    Add new
                </button>
            </div>
            <div class="w-full px-3 mb-6 md:mb-0" id="tables_fields">
                @foreach($restaurant->tables as $table)
                    @include('restaurant.partials.tables.edit', ['capacity' => $table->capacity])
                @endforeach
                <template id="table_template">
                    @include('restaurant.partials.tables.create')
                </template>
                @error('name')
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
@section('script')
    <script>
        function addTableField() {
            event.preventDefault();
            let holder = document.getElementById('tables_fields');
            let template = document.getElementById('table_template');
            let content = template.content.querySelector("div");
            let node = document.importNode(content, true);

            holder.appendChild(node);
        }
    </script>
@endsection
