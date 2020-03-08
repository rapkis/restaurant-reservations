<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRestaurantRequest;
use App\Restaurant;
use App\Services\RestaurantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    private $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    /**
     * Display the listing of restaurants
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $restaurants = Restaurant::with(['tables', 'reservations'])->get();

        return view('restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new restaurant.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created restaurant in storage.
     *
     * @param  StoreRestaurantRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        $this->restaurantService->save($request->validated());

        return redirect()->route('restaurants.index')->with('status', 'Restaurant Created');
    }

    /**
     * Show the form for editing the restaurant.
     *
     * @param  Restaurant  $restaurant
     * @return \Illuminate\View\View
     */
    public function edit(Restaurant $restaurant): View
    {
        $restaurant->load('tables');

        return view('restaurant.edit', compact('restaurant'));
    }

    /**
     * Update the specified restaurant in storage.
     *
     * @param  StoreRestaurantRequest  $request
     * @param  Restaurant $restaurant
     * @return RedirectResponse
     */
    public function update(StoreRestaurantRequest $request, Restaurant $restaurant): RedirectResponse
    {
        $this->restaurantService->update($restaurant, $request->validated());

        return redirect()->route('restaurants.index')->with('status', 'Restaurant Updated');
    }

    /**
     * Remove the specified restaurant from storage.
     *
     * @param  Restaurant $restaurant
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('status', 'Restaurant Deleted');
    }
}
