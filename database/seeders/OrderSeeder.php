<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [];
        $currentDate = Carbon::now();

        for ($i = 0; $i < 50; $i++) {
            // Generate a random date between today and 12 months ago
            $randomDate = Carbon::now()->subMonths(rand(0, 12))->subDays(rand(0, 30)); // Random date within the past 12 months
            
            $orders[] = [
                'user_id' => rand(1, 3), // User ID between 1 and 3
                'seller_id' => 1, // Seller ID between 1 and 3
                'product_id' => $this->getRandomProductId(), // Product ID (1-10 except 2)
                'quantity' => rand(1, 3), // Random quantity
                'status' => 'pending', // Random status
                'address' => $this->getRandomAddress(), // Random address
                'payment_id' => rand(1, 100), // Assuming payment IDs are between 1 and 100
                'created_at' => $randomDate->format('Y-m-d H:i:s'), // Format date correctly
                'updated_at' => $randomDate->format('Y-m-d H:i:s'), // Format date correctly
            ];
        }

        DB::table('orders')->insert($orders);
    }

    private function getRandomProductId()
    {
        // Get a random product ID between 1 and 10, excluding 2
        $ids = range(1, 10);
        unset($ids[array_search(2, $ids)]); // Remove 2 from the list
        return $ids[array_rand($ids)];
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'completed', 'cancelled'];
        return $statuses[array_rand($statuses)];
    }

    private function getRandomAddress()
    {
        // You can generate random addresses or use a predefined set
        $addresses = [
            '123 Main St, City A',
            '456 Side St, City B',
            '789 High St, City C',
            '101 Low St, City D',
            '202 Broad St, City E',
        ];
        return $addresses[array_rand($addresses)];
    }
}
