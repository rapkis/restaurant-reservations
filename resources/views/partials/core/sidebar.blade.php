<nav id="generic-navigation" class="px-2 pt-2 pb-4 hidden md:block md:w-1/6">
    <a href="{{ route('restaurants.index') }}" class="block px-2 py-1 text-gray-800 font-semibold rounded hover:bg-gray-200 {{ request()->is('restaurants*') ? 'bg-gray-200' : '' }}">Restaurants</a>
</nav>
