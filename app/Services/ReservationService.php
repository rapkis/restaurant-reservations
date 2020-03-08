<?php declare(strict_types = 1);

namespace App\Services;

use App\Customer;
use App\Exceptions\RestaurantUnavailableException;
use App\Exceptions\TablesUnavailableException;
use App\Reservation;
use App\Restaurant;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Collection;

class ReservationService
{
    private $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    public function createReservationForCustomer(Customer $customer, array $data): Reservation
    {
        $restaurant = Restaurant::find($data['restaurant_id']);

        $startTime = Carbon::parse($data['reservation_start']);
        $duration = CarbonInterval::createFromFormat('H:i', $data['reservation_end']);
        $endTime = Carbon::parse($data['reservation_start'])->add($duration);
        $partySize = (int)$data['party_size'];
        $data['reservation_start'] = $startTime;
        $data['reservation_end'] = $endTime;

        $availableTables = $this->restaurantAvailability($restaurant, $startTime, $endTime);
        $tablesForParty = $this->getAvailableTablesForParty($partySize, $availableTables);

        return $this->makeReservation($restaurant, $customer, $tablesForParty, $data);
    }

    private function makeReservation(Restaurant $restaurant, Customer $customer, Collection $tables, array $data): Reservation
    {
        $reservation = Reservation::make($data);
        $reservation->customer()->associate($customer);
        $reservation->restaurant()->associate($restaurant);
        $reservation->save();

        $reservation->tables()->attach($tables->pluck('id'));

        return $reservation;
    }

    private function restaurantAvailability(Restaurant $restaurant, Carbon $startTime, Carbon $endTime)
    {
        if(!$restaurant->isAvailableBetween($startTime, $endTime)) {
            throw new RestaurantUnavailableException('The restaurant only accepts reservations within working hours');
        }

        return $restaurant->tables()->availableBetween($startTime, $endTime)->orderBy('capacity')->get();
    }

    private function getAvailableTablesForParty(int $partySize, Collection $tables): Collection
    {
        if(empty($tables) || $tables->sum('capacity') < $partySize) {
            throw new TablesUnavailableException('There are currently no available tables for your party');
        }

        if($table = $tables->firstWhere('capacity') === $partySize) {
            return collect($table);
        }

        return $this->getTablesWithClosestCapacity($partySize, $tables);
    }

    private function getTablesWithClosestCapacity(int $partySize, Collection $tables): Collection
    {
        $closest = null;
        $closestTable = null;
        foreach ($tables as $table) {
            if ($closest === null || abs($partySize - $closest) > abs($table->capacity - $partySize)) {
                $closest = $table->capacity;
                $closestTable = $table;
            }
        }

        $availableTables[] = $closestTable;

        if($partySize > $closestTable->capacity) {
            $left = $partySize - $closestTable->capacity;
            $remainingTables = $tables->filter(function ($value, $key) use($closestTable){
                return $value['id'] != $closestTable->id;
            });
            $availableTables[] = $this->getAvailableTablesForParty($left, $remainingTables);
        }

        return collect($availableTables)->flatten();
    }
}
