<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\StoreReservationRequest;
use App\Reservation;
use App\Restaurant;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * Display a listing of reservations.
     *
     * @return View
     */
    public function index(): View
    {
        $reservations = Reservation::with(['customer', 'restaurant'])->get();

        return view('reservation.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return View
     */
    public function create(): View
    {
        $restaurants = Restaurant::all();

        return view('reservation.create', compact('restaurants'));
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  StoreReservationRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $customer = Customer::updateOrCreate(
            ['email' => $request->email],
            ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'phone' => $request->phone]
        );

        $this->reservationService->createReservationForCustomer($customer, $request->validated());

        return redirect()->route('reservations.index')->with('status', 'Reservation Created');
    }

    /**
     * Remove the specified reservation from storage.
     *
     * @param  Reservation $reservation
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('status', 'Reservation Canceled');
    }
}
