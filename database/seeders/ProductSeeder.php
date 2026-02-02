<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [];

        // Dog - Dry Food
        $dogDryProducts = [
            [
                'name' => 'Royal Canin Size Health Nutrition',
                'description' => 'Tailor-made nutrition for specific breeds and sizes. Complete and balanced.',
                'price' => 48.99,
                'pet_type' => 'dog',
                'category' => 'dry_food',
                'image' => '/images/products/dog_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedigree Adult Complete Nutrition',
                'description' => 'Complete and balanced nutrition for adult dogs. Roasted Chicken flavor.',
                'price' => 24.50,
                'pet_type' => 'dog',
                'category' => 'dry_food',
                'image' => '/images/products/dog_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blue Buffalo Life Protection Formula',
                'description' => 'Real meat first, brown rice, and fruit & vegetables. No corn, wheat, or soy.',
                'price' => 52.00,
                'pet_type' => 'dog',
                'category' => 'dry_food',
                'image' => '/images/products/dog_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purina Pro Plan Savor',
                'description' => 'High protein formula with shredded blend. Probiotics for digestive health.',
                'price' => 45.00,
                'pet_type' => 'dog',
                'category' => 'dry_food',
                'image' => '/images/products/dog_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hill\'s Science Diet Adult',
                'description' => 'Biology-based nutrition for lifelong health. Easy-to-digest ingredients.',
                'price' => 55.00,
                'pet_type' => 'dog',
                'category' => 'dry_food',
                'image' => '/images/products/dog_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Dog - Wet Food
        $dogWetProducts = [
            [
                'name' => 'Cesar Gourmet Wet Food',
                'description' => 'Classic Loaf in sauce. Filet Mignon flavor. Crafted for small dogs.',
                'price' => 2.50,
                'pet_type' => 'dog',
                'category' => 'wet_food',
                'image' => '/images/products/dog_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedigree Choice Cuts in Gravy',
                'description' => 'Meaty chunks in delicious gravy. Hickory Smoked Chicken flavor.',
                'price' => 1.99,
                'pet_type' => 'dog',
                'category' => 'wet_food',
                'image' => '/images/products/dog_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blue Buffalo Homestyle Recipe',
                'description' => 'Natural wet dog food with real chicken and garden vegetables.',
                'price' => 3.25,
                'pet_type' => 'dog',
                'category' => 'wet_food',
                'image' => '/images/products/dog_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purina One True Instinct',
                'description' => 'Nutrient-dense formula. Real turkey and venison in nutrient-rich broth.',
                'price' => 2.75,
                'pet_type' => 'dog',
                'category' => 'wet_food',
                'image' => '/images/products/dog_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Merrick Grain-Free Real Texas Beef',
                'description' => 'Real deboned beef is the #1 ingredient. Gluten-free recipe.',
                'price' => 4.00,
                'pet_type' => 'dog',
                'category' => 'wet_food',
                'image' => '/images/products/dog_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Cat - Dry Food
        $catDryProducts = [
            [
                'name' => 'Meow Mix Original Choice',
                'description' => 'The perfect mix of tastes cats love. Chicken, Turkey, Salmon, and Ocean Fish flavors.',
                'price' => 12.99,
                'pet_type' => 'cat',
                'category' => 'dry_food',
                'image' => '/images/products/cat_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Purina Friskies Seafood Sensations',
                'description' => 'A sea of flavors with salmon, tuna, shrimp, crab, and seaweed.',
                'price' => 14.50,
                'pet_type' => 'cat',
                'category' => 'dry_food',
                'image' => '/images/products/cat_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IAMS ProActive Health',
                'description' => 'Supports healthy digestion and strong immune system with prebiotics.',
                'price' => 18.00,
                'pet_type' => 'cat',
                'category' => 'dry_food',
                'image' => '/images/products/cat_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '9Lives Daily Essentials',
                'description' => 'Complete nutrition for all life stages. Salmon, Chicken, and Beef flavors.',
                'price' => 11.50,
                'pet_type' => 'cat',
                'category' => 'dry_food',
                'image' => '/images/products/cat_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Royal Canin Feline Health Nutrition',
                'description' => 'Indoor Adult dry cat food. Supports hairball reduction and weight management.',
                'price' => 38.00,
                'pet_type' => 'cat',
                'category' => 'dry_food',
                'image' => '/images/products/cat_dry_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Cat - Wet Food
        $catWetProducts = [
            [
                'name' => 'Sheba Perfect Portions',
                'description' => 'Premium paté wet cat food. Roasted Chicken Entrée. Grain-free.',
                'price' => 1.50,
                'pet_type' => 'cat',
                'category' => 'wet_food',
                'image' => '/images/products/cat_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Friskies Pate Wet Cat Food',
                'description' => 'Smooth texture and savory flavor. Liver & Chicken Dinner.',
                'price' => 0.85,
                'pet_type' => 'cat',
                'category' => 'wet_food',
                'image' => '/images/products/cat_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fancy Feast Grilled Collection',
                'description' => 'Grilled poultry and beef feast in gravy. Slow-cooked perfection.',
                'price' => 1.10,
                'pet_type' => 'cat',
                'category' => 'wet_food',
                'image' => '/images/products/cat_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Whiskas Perfect Portions Paté',
                'description' => 'Fresh meal every time. Chicken & Tuna Entrée.',
                'price' => 1.25,
                'pet_type' => 'cat',
                'category' => 'wet_food',
                'image' => '/images/products/cat_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '9Lives Meaty Paté',
                'description' => 'Soft, moist, and rich in taste. Super Supper flavor.',
                'price' => 0.75,
                'pet_type' => 'cat',
                'category' => 'wet_food',
                'image' => '/images/products/cat_wet_food.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Aquarium Products
        $aquariumProducts = [
            [
                'name' => 'Magnetic Glass Cleaner',
                'description' => 'Powerful magnetic cleaner for glass aquariums. Floating design for easy retrieval.',
                'price' => 25.00,
                'pet_type' => 'aquarium',
                'category' => 'aquarium',
                'image' => '/images/products/aquarium_glass_cleaner.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tropical Fish Flakes',
                'description' => 'Nutrient-rich flakes for color enhancement and health of tropical fish.',
                'price' => 12.00,
                'pet_type' => 'aquarium',
                'category' => 'aquarium',
                'image' => '/images/products/fish_food_flakes.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'External Canister Filter',
                'description' => 'Silent and efficient multi-stage filtration for crystal clear water.',
                'price' => 120.00,
                'pet_type' => 'aquarium',
                'category' => 'aquarium',
                'image' => '/images/products/aquarium_filter.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water Conditioner',
                'description' => 'Instantly makes tap water safe for fish by removing chlorine and heavy metals.',
                'price' => 15.50,
                'pet_type' => 'aquarium',
                'category' => 'aquarium',
                'image' => '/images/products/water_conditioner.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LED Aquarium Light',
                'description' => 'Slim efficient LED lighting for plant growth and vibrant fish colors.',
                'price' => 45.00,
                'pet_type' => 'aquarium',
                'category' => 'aquarium',
                'image' => '/images/products/aquarium_led_light.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Health Products
        $healthProducts = [
            [
                'name' => 'Flea & Tick Spray',
                'description' => 'Fast-acting spray to protect your pets from fleas and ticks.',
                'price' => 35.00,
                'pet_type' => 'health',
                'category' => 'medicine',
                'image' => '/images/products/flea_spray.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Multivitamin Chews',
                'description' => 'Daily essential vitamins to support immune health and vitality.',
                'price' => 22.50,
                'pet_type' => 'health',
                'category' => 'medicine',
                'image' => '/images/products/multivitamin.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Joint Support Tablets',
                'description' => 'Supplements to maintain healthy joints and mobility in older pets.',
                'price' => 40.00,
                'pet_type' => 'health',
                'category' => 'medicine',
                'image' => '/images/products/joint_support.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ear Cleaner Solution',
                'description' => 'Gentle formula to clean ears and prevent infections.',
                'price' => 18.00,
                'pet_type' => 'health',
                'category' => 'medicine',
                'image' => '/images/products/ear_cleaner.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deworming Syrup',
                'description' => 'Effective treatment for common intestinal worms.',
                'price' => 15.00,
                'pet_type' => 'health',
                'category' => 'medicine',
                'image' => '/images/products/deworming_syrup.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Grooming Products
        $groomingProducts = [
            [
                'name' => 'Oatmeal Pet Shampoo',
                'description' => 'Soothing natural oatmeal shampoo for pets with sensitive skin.',
                'price' => 12.50,
                'pet_type' => 'grooming',
                'category' => 'tools',
                'image' => '/images/products/shampoo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Self-Cleaning Slicker Brush',
                'description' => 'Removes loose hair and tangles gently. One-button cleaning mechanism.',
                'price' => 18.99,
                'pet_type' => 'grooming',
                'category' => 'tools',
                'image' => '/images/products/slicker_brush.png', // Temporary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Safety Nail Clippers',
                'description' => 'Sharp stainless steel blades with a safety guard to prevent overcutting.',
                'price' => 14.00,
                'pet_type' => 'grooming',
                'category' => 'tools',
                'image' => '/images/products/nail_clippers.png', // Temporary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deshedding Tool',
                'description' => 'Reduces shedding by up to 90%. Reach deep beneath the topcoat.',
                'price' => 28.00,
                'pet_type' => 'grooming',
                'category' => 'tools',
                'image' => '/images/products/deshedding_tool.png', // Temporary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hypoallergenic Paw Wipes',
                'description' => 'Gentle wipes for cleaning paws after walks. Alcohol and fragrance-free.',
                'price' => 9.99,
                'pet_type' => 'grooming',
                'category' => 'tools',
                'image' => '/images/products/paw_wipes.png', // Temporary (Multivitamin Reuse)
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $products = array_merge($dogDryProducts, $dogWetProducts, $catDryProducts, $catWetProducts, $aquariumProducts, $healthProducts, $groomingProducts);

        DB::table('products')->insert($products);
    }
}
