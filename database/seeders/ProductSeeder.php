<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Define product images
        $images = [
            'uploads/plain-1.jpg',
            'uploads/plain-2.png',
            'uploads/plain-3.jpg',
            'uploads/plain-4.jpg'
        ];

        // Define sample product names for some common categories
        $productNames = [
            // Electronics
            // 'smartphones' => [
            //     'Samsung Galaxy S21', 'iPhone 14 Pro', 'Xiaomi Redmi Note 12', 'OnePlus Nord 2', 'Realme GT Master Edition'
            // ],
            // 'electronic devices' => [
            //     'Sony PlayStation 5', 'Google Nest Mini', 'Amazon Echo Dot', 'Bose SoundLink Mini', 'Nintendo Switch'
            // ],
            // 'smart watch' => [
            //     'Apple Watch Series 7', 'Samsung Galaxy Watch 4', 'Fitbit Versa 3', 'Garmin Forerunner 945', 'Amazfit GTS 3'
            // ],
            // 'electric toothbrush' => [
            //     'Philips Sonicare 9900', 'Oral-B Genius X', 'Colgate Hum', 'Fairywill Sonic Toothbrush', 'Waterpik Complete Care 5.0'
            // ],
            // 'water heater' => [
            //     'AO Smith Water Heater', 'Rheem Tankless Water Heater', 'Bosch Electric Mini-Tank', 'Ecosmart ECO 11', 'Stiebel Eltron Tempra'
            // ],
            // 'air conditioner' => [
            //     'LG Dual Inverter AC', 'Samsung Wind-Free AC', 'Daikin Inverter AC', 'Voltas Adjustable AC', 'Blue Star Split AC'
            // ],
            // 'ceiling fans' => [
            //     'Hunter Ceiling Fan', 'Orient Electric Aeroquiet', 'Havells Stealth Air', 'Crompton Aura Prime', 'Usha Striker High Speed'
            // ],
            // 'water cooler' => [
            //     'Kenstar Water Cooler', 'Blue Star Water Cooler', 'Voltas Water Cooler', 'Symphony Diet Air Cooler', 'Havells Freddo Air Cooler'
            // ],

            
        
            // // Jewelry
            // 'earings' => [
            //     'Diamond Stud Earrings', 'Gold Hoop Earrings', 'Sapphire Drop Earrings', 'Pearl Cluster Earrings', 'Emerald Teardrop Earrings'
            // ],
            // 'jwellery' => [
            //     'Gold Chain Necklace', 'Silver Bangle Bracelet', 'Ruby Pendant Necklace', 'Sapphire Tennis Bracelet', 'Diamond Ring'
            // ],
            // 'moti necklace' => [
            //     'Freshwater Pearl Necklace', 'Baroque Pearl Necklace', 'Classic White Moti Necklace', 'Triple Strand Pearl Necklace', 'Akoya Pearl Necklace'
            // ],
            // 'golden neckless' => [
            //     '24K Gold Necklace', 'Yellow Gold Chain', 'Rose Gold Necklace', 'Gold Heart Locket', 'Gold Infinity Pendant'
            // ],
            // 'diamond earings' => [
            //     'Princess Cut Diamond Earrings', 'Diamond Halo Studs', 'Round Brilliant Diamond Earrings', 'Cushion Cut Diamond Hoops', 'Diamond Drop Earrings'
            // ],
            // 'gold earings' => [
            //     'Gold Teardrop Earrings', 'Gold Stud Earrings', 'Gold Dangle Earrings', 'Hoop Earrings in Gold', 'Gold Leaf Earrings'
            // ],
            // 'long gold earings' => [
            //     'Gold Chandelier Earrings', 'Gold Linear Drop Earrings', 'Gold Filigree Long Earrings', 'Dangling Gold Chain Earrings', 'Gold Cascade Earrings'
            // ],
        
            // // Fashion
            // 'fashion' => [
            //     'Gucci Sunglasses', 'Nike Sportswear', 'Louis Vuitton Handbag', 'Adidas Sneakers', 'Prada Belt'
            // ],
            // 'mens shirts' => [
            //     'Oxford Button-Down Shirt', 'Flannel Plaid Shirt', 'Cotton Polo Shirt', 'Slim Fit Dress Shirt', 'Henley Long Sleeve Shirt'
            // ],
            // 'mens pants' => [
            //     'Levi\'s 501 Original Jeans', 'Chinos Khaki Pants', 'Cargo Utility Pants', 'Slim Fit Trousers', 'Corduroy Pants'
            // ],
            // 'mens shoes' => [
            //     'Nike Air Max', 'Adidas Ultraboost', 'Timberland Classic Boots', 'Clarks Desert Boots', 'Puma Suede Sneakers'
            // ],
            // 'men trousers' => [
            //     'Classic Fit Trousers', 'Slim Fit Dress Pants', 'Stretch Chinos', 'Flat Front Dress Pants', 'Wool Blend Trousers'
            // ],
            // 'chinos' => [
            //     'Dockers Slim Chinos', 'Gap Straight Fit Chinos', 'Uniqlo Skinny Chinos', 'Tommy Hilfiger Classic Chinos', 'Banana Republic Slim Tapered Chinos'
            // ],
            // 'men tshirts' => [
            //     'Graphic Print T-Shirt', 'V-Neck Cotton T-Shirt', 'Crew Neck Basic Tee', 'Athletic Performance T-Shirt', 'Striped Jersey T-Shirt'
            // ],
        
            // Default names for unspecified categories
            'default' => [
                'Product One', 'Product Two', 'Product Three', 'Product Four', 'Product Five'
            ],





            //new


            
                // 'jewellery' => [
                //     'Gold Necklace', 'Diamond Ring', 'Sapphire Earrings', 'Pearl Bracelet', 'Emerald Pendant',
                //     'Ruby Brooch', 'Silver Cufflinks', 'Topaz Earrings', 'Amethyst Necklace', 'Opal Ring',
                // ],
                // 'fashion' => [
                //     'Gucci Handbag', 'Nike Air Max', 'Adidas Superstar', 'Ray-Ban Sunglasses', 'Levi’s 501 Jeans',
                //     'Zara Blazer', 'H&M Dress', 'Puma T-Shirt', 'Chanel Perfume', 'Burberry Scarf',
                // ],
                'clothing' => [
                    'Cotton T-Shirt', 'Denim Jacket', 'Leather Pants', 'Chinos', 'Summer Dress',
                    'Hoodie', 'Formal Shirt', 'Sweater', 'Winter Coat', 'Activewear Leggings',
                ],
                'home appliances' => [
                    'Dyson Vacuum Cleaner', 'Instant Pot Duo', 'Philips Air Fryer', 'KitchenAid Mixer', 'LG Smart Refrigerator',
                    'Samsung Washing Machine', 'Whirlpool Dryer', 'Bosch Dishwasher', 'Nespresso Coffee Maker', 'Sharp Microwave',
                ],
                'furniture' => [
                    'IKEA Sofa', 'Wooden Dining Table', 'Ergonomic Office Chair', 'Queen Bed Frame', 'Glass Coffee Table',
                    'Leather Recliner', 'Storage Ottoman', 'Bookshelf', 'Nightstand', 'TV Stand',
                ],
                'beauty & personal care' => [
                    'Moisturizing Cream', 'Retinol Serum', 'Sunscreen Lotion', 'Hydrating Face Mask', 'Lip Balm',
                    'Hair Conditioner', 'Nail Polish', 'Facial Cleanser', 'Shampoo', 'Body Scrub',
                ],
                'automotive' => [
                    'Car Wax', 'Dashboard Cleaner', 'Leather Seat Conditioner', 'Portable Jump Starter', 'Tire Inflator',
                    'Car Vacuum Cleaner', 'Bluetooth Car Adapter', 'GPS Navigation System', 'Windshield Sun Shade', 'Emergency Kit',
                ],
                'sports & outdoors' => [
                    'Yoga Mat', 'Tennis Racket', 'Camping Tent', 'Bicycle', 'Fishing Rod',
                    'Hiking Backpack', 'Running Shoes', 'Soccer Ball', 'Kayak', 'Golf Clubs',
                ],
                'toys & games' => [
                    'LEGO Building Set', 'Action Figure', 'Board Game', 'Puzzle', 'Dollhouse',
                    'Remote Control Car', 'Stuffed Animal', 'Video Game Console', 'Outdoor Playhouse', 'Craft Kit',
                ],
                'books & stationery' => [
                    'Fiction Novel', 'Non-Fiction Book', 'Sketchbook', 'Journal', 'Colored Pencils',
                    'Art Supplies', 'Children’s Storybook', 'Textbook', 'Planner', 'Notebook',
                ],
                'health & wellness' => [
                    'Multivitamins', 'Protein Powder', 'Yoga Blocks', 'Fitness Tracker', 'Massage Gun',
                    'Essential Oils', 'Herbal Tea', 'First Aid Kit', 'Stretch Bands', 'Healthy Snacks',
                ],
                'kitchen & dining' => [
                    'Ceramic Cookware', 'Cutlery Set', 'Food Processor', 'Glass Storage Containers', 'Spice Rack',
                    'Non-stick Baking Mat', 'Measuring Cups', 'Blender', 'Coffee Grinder', 'Tableware Set',
                ],
                'garden & outdoor living' => [
                    'Garden Shed', 'Patio Furniture Set', 'Outdoor Grill', 'Fire Pit', 'Gardening Tools',
                    'Hammock', 'Bird Feeder', 'Planter Boxes', 'Watering Can', 'Outdoor String Lights',
                ],
            
            
        ];
        

        // Get all categories
        $categories = Category::all();

        // For each category, create 5 products with more realistic names
        foreach ($categories as $category) {
            // Determine the category type (you could customize this based on your own category names)
            $categoryType = strtolower($category->name);
            $namesArray = $productNames[$categoryType] ?? $productNames['default'];

            for ($i = 1; $i <= 10; $i++) {
                // Get a random name from the array
                $name = $namesArray[array_rand($namesArray)];

                $uniqueSku = Str::slug($name . '-' . $category->name . '-' . Str::random(5));

                Product::create([
                    'name' => $name, // Adding category name for more specificity
                    'category_id' => $category->id,
                    'sku' => $uniqueSku,
                    'seller_id' => 1, // Assuming seller ID is 1; adjust if necessary
                    'image' => $images[array_rand($images)], // Random image
                    'visible' => 1,
                    'ratings' => '0.00',
                    'mrp' => rand(10000, 30000) . '.00', // Random price between 10,000 and 30,000
                    'selling_price' => rand(8000, 25000) . '.00', // Random selling price
                    'description' => $name . ' | High quality product from ' . $category->name,
                    'quantity' => rand(50, 200),
                    'item_sold' => 0,
                    'reach' => 0,
                    'tags' => $category->name . ', best ' . $category->name . ', ' . $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
