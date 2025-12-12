<?php
// database/seeders/TravelPackageSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TravelPackage;
use App\Models\Destination;

class TravelPackageSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing packages
        TravelPackage::truncate();

        $packages = [];
        
        // Get all destinations
        $destinations = Destination::all();
        
        foreach ($destinations as $destination) {
            // Create 2-3 packages for each destination
            $packages = array_merge($packages, $this->createPackagesForDestination($destination));
        }

        foreach ($packages as $package) {
            TravelPackage::create($package);
        }

        $this->command->info('✅ Travel packages seeded successfully!');
    }

    private function createPackagesForDestination($destination): array
    {
        $destinationPackages = [];
        
        if ($destination->name === 'Paris - City of Lights') {
            $destinationPackages = [
                [
                    'destination_id' => $destination->id,
                    'name' => 'Paris Romantic Getaway',
                    'description' => '4-day romantic trip to Paris including Eiffel Tower visit, Seine River cruise, and gourmet dining.',
                    'duration_days' => 4,
                    'price' => 1899.99,
                    'inclusions' => json_encode(['Flight', '4-star Hotel', 'Breakfast', 'Eiffel Tower Tickets', 'Airport Transfer']),
                    'exclusions' => json_encode(['Lunch & Dinner', 'Travel Insurance', 'Visa Fees']),
                    'max_people' => 2,
                    'is_active' => true,
                    'image_url' => 'https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg'
                ],
                [
                    'destination_id' => $destination->id,
                    'name' => 'Paris Family Adventure',
                    'description' => '7-day family trip including Disneyland Paris, Louvre Museum, and city tour.',
                    'duration_days' => 7,
                    'price' => 3299.99,
                    'inclusions' => json_encode(['Flight', 'Family Hotel', 'All Meals', 'Disneyland Tickets', 'Museum Pass']),
                    'exclusions' => json_encode(['Shopping', 'Optional Tours']),
                    'max_people' => 4,
                    'is_active' => true,
                    'image_url' => 'https://images.pexels.com/photos/53464/sheraton-palace-hotel-lobby-architecture-san-francisco-53464.jpeg'
                ]
            ];
        }
        elseif ($destination->name === 'Tokyo - Modern Metropolis') {
            $destinationPackages = [
                [
                    'destination_id' => $destination->id,
                    'name' => 'Tokyo Tech & Culture Tour',
                    'description' => '6-day exploration of Tokyo\'s technology districts and traditional temples.',
                    'duration_days' => 6,
                    'price' => 2499.99,
                    'inclusions' => json_encode(['Flight', 'Business Hotel', 'Breakfast', 'Shibuya Tour', 'Temple Visits']),
                    'exclusions' => json_encode(['Shinkansen Tickets', 'Nightlife']),
                    'max_people' => 4,
                    'is_active' => true,
                    'image_url' => 'https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg'
                ]
            ];
        }
        elseif ($destination->name === 'Bali - Island of Gods') {
            $destinationPackages = [
                [
                    'destination_id' => $destination->id,
                    'name' => 'Bali Beach Retreat',
                    'description' => '8-day luxury beach vacation with spa treatments and water activities.',
                    'duration_days' => 8,
                    'price' => 1799.99,
                    'inclusions' => json_encode(['Flight', 'Beach Resort', 'All Meals', 'Spa Sessions', 'Snorkeling']),
                    'exclusions' => json_encode(['Alcohol', 'Scuba Diving']),
                    'max_people' => 2,
                    'is_active' => true,
                    'image_url' => 'https://images.pexels.com/photos/36717/amazing-animal-beautiful-beautifull.jpg'
                ]
            ];
        }
        else {
            // Default package for other destinations
            $destinationPackages = [
                [
                    'destination_id' => $destination->id,
                    'name' => $destination->name . ' Experience',
                    'description' => '5-day comprehensive tour of ' . $destination->name,
                    'duration_days' => 5,
                    'price' => round($destination->starting_price * 1.5, 2),
                    'inclusions' => json_encode(['Flight', 'Hotel', 'Breakfast', 'City Tour']),
                    'exclusions' => json_encode(['Meals', 'Optional Activities']),
                    'max_people' => 6,
                    'is_active' => true,
                    'image_url' => $destination->featured_image
                ]
            ];
        }

        return $destinationPackages;
    }
}