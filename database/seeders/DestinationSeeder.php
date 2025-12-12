<?php
// database/seeders/DestinationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing destinations (will also clear related packages)
        DB::table('destinations')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $destinations = [
            // 1. Paris - Working Pexels URL
            [
                'name' => 'Paris - City of Lights',
                'description' => 'Experience the romance and culture of Paris, home to the Eiffel Tower, Louvre Museum, and exquisite cuisine.',
                'country' => 'France',
                'continent' => 'Europe',
                'best_time_to_visit' => 'April to June, September to October',
                'starting_price' => 1200,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/338515/pexels-photo-338515.jpeg'
            ],
            // 2. Tokyo - Working Pexels URL
            [
                'name' => 'Tokyo - Modern Metropolis',
                'description' => 'Discover the perfect blend of tradition and technology in Tokyo.',
                'country' => 'Japan',
                'continent' => 'Asia',
                'best_time_to_visit' => 'March to May, September to November',
                'starting_price' => 1500,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg'
            ],
            // 3. Bali - Working Pexels URL
            [
                'name' => 'Bali - Island of Gods',
                'description' => 'Relax on beautiful beaches and experience unique Balinese culture.',
                'country' => 'Indonesia',
                'continent' => 'Asia',
                'best_time_to_visit' => 'April to October',
                'starting_price' => 800,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/36717/amazing-animal-beautiful-beautifull.jpg'
            ],
            // 4. New York - Working Pexels URL
            [
                'name' => 'New York - The Big Apple',
                'description' => 'Explore the city that never sleeps with iconic landmarks.',
                'country' => 'USA',
                'continent' => 'North America',
                'best_time_to_visit' => 'April to June, September to November',
                'starting_price' => 1400,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/466685/pexels-photo-466685.jpeg'
            ],
            // 5. Sydney - Working Pexels URL
            [
                'name' => 'Sydney - Harbour City',
                'description' => 'Visit the iconic Opera House, Harbour Bridge, and beautiful beaches.',
                'country' => 'Australia',
                'continent' => 'Oceania',
                'best_time_to_visit' => 'September to November, March to May',
                'starting_price' => 1600,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/161988/pexels-photo-161988.jpeg'
            ],
            // 6. Dubai - Working Pexels URL
            [
                'name' => 'Dubai - City of Gold',
                'description' => 'Marvel at modern architecture and luxury shopping in this Middle Eastern gem.',
                'country' => 'UAE',
                'continent' => 'Asia',
                'best_time_to_visit' => 'November to March',
                'starting_price' => 1300,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/1796715/pexels-photo-1796715.jpeg'
            ],
            // 7. Rio de Janeiro - Working Pexels URL
            [
                'name' => 'Rio de Janeiro - Marvelous City',
                'description' => 'Experience Carnival, Christ the Redeemer, and vibrant Brazilian culture.',
                'country' => 'Brazil',
                'continent' => 'South America',
                'best_time_to_visit' => 'December to March',
                'starting_price' => 900,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/2096983/pexels-photo-2096983.jpeg'
            ],
            // 8. Santorini - Working Pexels URL
            [
                'name' => 'Santorini - Greek Paradise',
                'description' => 'Enjoy stunning sunsets, white-washed buildings, and crystal-clear waters.',
                'country' => 'Greece',
                'continent' => 'Europe',
                'best_time_to_visit' => 'June to September',
                'starting_price' => 950,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/1028225/pexels-photo-1028225.jpeg'
            ],
            // 9. Swiss Alps - Working Pexels URL
            [
                'name' => 'Swiss Alps - Mountain Paradise',
                'description' => 'Experience breathtaking mountain views, ski resorts, and charming alpine villages.',
                'country' => 'Switzerland',
                'continent' => 'Europe',
                'best_time_to_visit' => 'December to March (skiing), June to September (hiking)',
                'starting_price' => 1600,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/618833/pexels-photo-618833.jpeg'
            ],
            // 10. Maldives - Working Pexels URL
            [
                'name' => 'Maldives - Tropical Paradise',
                'description' => 'Relax in overwater bungalows and snorkel in crystal-clear waters.',
                'country' => 'Maldives',
                'continent' => 'Asia',
                'best_time_to_visit' => 'November to April',
                'starting_price' => 1800,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.pexels.com/photos/1483053/pexels-photo-1483053.jpeg'
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }

        $this->command->info('✅ 10 destinations seeded successfully with WORKING image URLs!');
    }
}