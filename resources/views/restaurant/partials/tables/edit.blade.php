<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 w-full max-w-lg mx-auto" for="name">
    Capacity<span class="text-red-500">*</span>
</label>
<div class="flex w-full max-w-lg mx-auto items-center">
    <form action="{{ route('tables.update', ['table' => $table->id]) }}" class="w-full" method="POST">
        @csrf
        @method('PUT')
        <div class="flex justify-between">
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                   name="capacity"
                   type="number"
                   min="1"
                   placeholder="4"
                   value="{{ $table->capacity }}"
                   required
            >
            <button type="submit">
                <i class="material-icons text-blue-500">save</i>
            </button>
        </div>
    </form>
    <form action="{{ route('tables.destroy', ['table' => $table->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Are you sure you want to delete this?')" class="focus:outline-none">
            <i class="material-icons text-red-500">delete</i>
        </button>
    </form>
</div>
