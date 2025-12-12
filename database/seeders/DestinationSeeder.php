<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing destinations
        DB::table('destinations')->truncate();

        $destinations = [
            // Europe (8 destinations)
            [
                'name' => 'Paris - City of Lights',
                'description' => 'Experience the romance and culture of Paris, home to the Eiffel Tower, Louvre Museum, and exquisite cuisine.',
                'country' => 'France',
                'continent' => 'Europe',
                'best_time_to_visit' => 'April to June, September to October',
                'starting_price' => 1200,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Rome - Eternal City',
                'description' => 'Walk through ancient history with the Colosseum, Roman Forum, and Vatican City at your doorstep.',
                'country' => 'Italy',
                'continent' => 'Europe',
                'best_time_to_visit' => 'April to June, September to October',
                'starting_price' => 1100,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Santorini - Greek Paradise',
                'description' => 'Enjoy stunning sunsets, white-washed buildings, and crystal-clear waters in the Aegean Sea.',
                'country' => 'Greece',
                'continent' => 'Europe',
                'best_time_to_visit' => 'June to September',
                'starting_price' => 950,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Barcelona - Artistic Hub',
                'description' => 'Explore Gaudí\'s masterpieces, beautiful beaches, and vibrant Catalan culture.',
                'country' => 'Spain',
                'continent' => 'Europe',
                'best_time_to_visit' => 'May to June, September to October',
                'starting_price' => 900,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1583422409516-2895a77efded?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'London - Royal Capital',
                'description' => 'Discover royal palaces, world-class museums, and iconic landmarks in this historic city.',
                'country' => 'UK',
                'continent' => 'Europe',
                'best_time_to_visit' => 'March to May, September to November',
                'starting_price' => 1300,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Amsterdam - Canal City',
                'description' => 'Cycle along picturesque canals, visit world-class museums, and experience Dutch culture.',
                'country' => 'Netherlands',
                'continent' => 'Europe',
                'best_time_to_visit' => 'April to May, September to October',
                'starting_price' => 850,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1512470880442-9d7b9e2a6b10?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Prague - City of Hundred Spires',
                'description' => 'Marvel at Gothic architecture, medieval squares, and romantic bridges.',
                'country' => 'Czech Republic',
                'continent' => 'Europe',
                'best_time_to_visit' => 'April to May, September to October',
                'starting_price' => 750,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1549877452-9c387954fbc2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Swiss Alps - Mountain Paradise',
                'description' => 'Experience breathtaking mountain views, ski resorts, and charming alpine villages.',
                'country' => 'Switzerland',
                'continent' => 'Europe',
                'best_time_to_visit' => 'December to March (skiing), June to September (hiking)',
                'starting_price' => 1600,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],

            // Asia (8 destinations)
            [
                'name' => 'Tokyo - Modern Metropolis',
                'description' => 'Discover the perfect blend of tradition and technology in Tokyo.',
                'country' => 'Japan',
                'continent' => 'Asia',
                'best_time_to_visit' => 'March to May, September to November',
                'starting_price' => 1500,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Bali - Island of Gods',
                'description' => 'Relax on beautiful beaches and experience unique Balinese culture.',
                'country' => 'Indonesia',
                'continent' => 'Asia',
                'best_time_to_visit' => 'April to October',
                'starting_price' => 800,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Dubai - City of Gold',
                'description' => 'Marvel at modern architecture and luxury shopping in this Middle Eastern gem.',
                'country' => 'UAE',
                'continent' => 'Asia',
                'best_time_to_visit' => 'November to March',
                'starting_price' => 1300,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Bangkok - City of Angels',
                'description' => 'Experience vibrant street life, ornate temples, and delicious street food.',
                'country' => 'Thailand',
                'continent' => 'Asia',
                'best_time_to_visit' => 'November to February',
                'starting_price' => 700,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1563492065599-3520f775eeed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Seoul - Dynamic Capital',
                'description' => 'Experience K-pop culture, ancient palaces, and cutting-edge technology.',
                'country' => 'South Korea',
                'continent' => 'Asia',
                'best_time_to_visit' => 'April to May, September to November',
                'starting_price' => 1100,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1570913199996-4a6488d9d8c5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Singapore - Garden City',
                'description' => 'Experience futuristic gardens, diverse cuisine, and clean urban living.',
                'country' => 'Singapore',
                'continent' => 'Asia',
                'best_time_to_visit' => 'February to April',
                'starting_price' => 1200,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Maldives - Tropical Paradise',
                'description' => 'Relax in overwater bungalows and snorkel in crystal-clear waters.',
                'country' => 'Maldives',
                'continent' => 'Asia',
                'best_time_to_visit' => 'November to April',
                'starting_price' => 1800,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Kathmandu - Himalayan Gateway',
                'description' => 'Explore ancient temples and prepare for Himalayan adventures.',
                'country' => 'Nepal',
                'continent' => 'Asia',
                'best_time_to_visit' => 'October to November, March to April',
                'starting_price' => 600,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1564507004663-b6dfb3e2ede9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],

            // North America (5 destinations)
            [
                'name' => 'New York - The Big Apple',
                'description' => 'Explore the city that never sleeps with iconic landmarks.',
                'country' => 'USA',
                'continent' => 'North America',
                'best_time_to_visit' => 'April to June, September to November',
                'starting_price' => 1400,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Cancun - Beach Paradise',
                'description' => 'Enjoy white-sand beaches, turquoise waters, and ancient Mayan ruins.',
                'country' => 'Mexico',
                'continent' => 'North America',
                'best_time_to_visit' => 'December to April',
                'starting_price' => 900,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1513326738677-b964603b136d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Banff - Canadian Rockies',
                'description' => 'Explore stunning mountain landscapes, glacial lakes, and wildlife.',
                'country' => 'Canada',
                'continent' => 'North America',
                'best_time_to_visit' => 'June to August, December to March',
                'starting_price' => 1100,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Las Vegas - Entertainment Capital',
                'description' => 'Experience world-class shows, casinos, and vibrant nightlife.',
                'country' => 'USA',
                'continent' => 'North America',
                'best_time_to_visit' => 'March to May, September to November',
                'starting_price' => 1000,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1605833556294-ea5c7a74f57d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Hawaii - Pacific Paradise',
                'description' => 'Experience volcanic landscapes, beautiful beaches, and Polynesian culture.',
                'country' => 'USA',
                'continent' => 'North America',
                'best_time_to_visit' => 'April to June, September to December',
                'starting_price' => 1500,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],

            // South America (3 destinations)
            [
                'name' => 'Rio de Janeiro - Marvelous City',
                'description' => 'Experience Carnival, Christ the Redeemer, and vibrant Brazilian culture.',
                'country' => 'Brazil',
                'continent' => 'South America',
                'best_time_to_visit' => 'December to March',
                'starting_price' => 900,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1483729558449-99ef09a8c325?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Machu Picchu - Lost City',
                'description' => 'Explore ancient Incan ruins amidst breathtaking mountain scenery.',
                'country' => 'Peru',
                'continent' => 'South America',
                'best_time_to_visit' => 'May to September',
                'starting_price' => 850,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Patagonia - Wilderness Adventure',
                'description' => 'Hike through stunning glaciers, mountains, and fjords.',
                'country' => 'Chile/Argentina',
                'continent' => 'South America',
                'best_time_to_visit' => 'November to March',
                'starting_price' => 1300,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1510473396993-b7c7f1521368?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],

            // Africa (3 destinations)
            [
                'name' => 'Cape Town - Mother City',
                'description' => 'Enjoy stunning landscapes, Table Mountain, and beautiful beaches.',
                'country' => 'South Africa',
                'continent' => 'Africa',
                'best_time_to_visit' => 'November to March',
                'starting_price' => 1000,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Safari - African Wilderness',
                'description' => 'Experience wildlife safaris in the heart of African savannas.',
                'country' => 'Kenya/Tanzania',
                'continent' => 'Africa',
                'best_time_to_visit' => 'June to October',
                'starting_price' => 1800,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Marrakech - Red City',
                'description' => 'Explore vibrant markets, historic palaces, and Moroccan culture.',
                'country' => 'Morocco',
                'continent' => 'Africa',
                'best_time_to_visit' => 'March to May, September to November',
                'starting_price' => 750,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],

            // Oceania (3 destinations)
            [
                'name' => 'Sydney - Harbour City',
                'description' => 'Visit the iconic Opera House, Harbour Bridge, and beautiful beaches.',
                'country' => 'Australia',
                'continent' => 'Oceania',
                'best_time_to_visit' => 'September to November, March to May',
                'starting_price' => 1600,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Queenstown - Adventure Capital',
                'description' => 'Experience bungee jumping, skiing, and stunning New Zealand landscapes.',
                'country' => 'New Zealand',
                'continent' => 'Oceania',
                'best_time_to_visit' => 'December to March (summer), June to September (winter)',
                'starting_price' => 1400,
                'is_featured' => false,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1589739900243-4b5c0cfd6ab8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Fiji - Tropical Islands',
                'description' => 'Relax on pristine beaches and experience Fijian hospitality.',
                'country' => 'Fiji',
                'continent' => 'Oceania',
                'best_time_to_visit' => 'May to October',
                'starting_price' => 1200,
                'is_featured' => true,
                'is_active' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1573843989-c9d4a65b6c0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }

        $this->command->info('✅ 30 destinations seeded successfully with images!');
    }
}