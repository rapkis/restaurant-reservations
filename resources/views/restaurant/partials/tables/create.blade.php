<div>
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
        Capacity<span class="text-red-500">*</span>
    </label>
    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
           name="tables[][capacity]"
           type="number"
           min="1"
           placeholder="4"
           value="{{ $capacity ?? '' }}"
           required
    >
</div>
