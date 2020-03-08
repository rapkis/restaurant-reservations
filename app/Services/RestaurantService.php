<?php declare(strict_types = 1);

namespace App\Services;

use App\Restaurant;

class RestaurantService
{
    public function save(array $data): Restaurant
    {
        $restaurant = Restaurant::create($data);

        if (!empty($data['tables'])) {
            $restaurant->tables()->createMany($data['tables']);
        }

        return $restaurant;
    }

    public function update(Restaurant $restaurant, array $data): Restaurant
    {
        $restaurant->update($data);

        if (!empty($data['tables'])) {
            $restaurant->tables()->createMany($data['tables']);
        }

        return $restaurant;
    }
}
