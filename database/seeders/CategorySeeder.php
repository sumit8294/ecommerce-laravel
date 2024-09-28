<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $parentFilterCategories = [
            'Electronics',
            'Clothing',
            'Home Appliances',
            'Furniture',
            'Beauty & Personal Care',
            'Automotive',
            'Sports & Outdoors',
            'Toys & Games',
            'Books & Stationery',
            'Health & Wellness',
            'Kitchen & Dining',
            'Garden & Outdoor Living'
        ];
        // Assuming you already have the parent categories created
        $parentCategories = Category::whereIn('name', $parentFilterCategories)->get();; // Fetch all parent categories

        // Sample names for child categories
        $childNames = [
            'Electronics' => [
                'Smartphones', 'Laptops', 'Cameras', 'Televisions', 'Headphones', 
                'Smartwatches', 'Tablets', 'Home Theater Systems', 'Bluetooth Speakers', 'Gaming Consoles',
            ],
            'Clothing' => [
                'T-Shirts', 'Jeans', 'Dresses', 'Jackets', 'Suits', 
                'Activewear', 'Sweaters', 'Skirts', 'Shorts', 'Accessories',
            ],
            'Home Appliances' => [
                'Refrigerators', 'Washing Machines', 'Microwaves', 'Vacuum Cleaners', 
                'Dishwashers', 'Air Purifiers', 'Coffee Makers', 'Blenders', 'Toasters', 'Hair Dryers',
            ],
            'Furniture' => [
                'Sofas', 'Dining Tables', 'Beds', 'Chairs', 'Dressers', 
                'Coffee Tables', 'Bookcases', 'Desks', 'Nightstands', 'Outdoor Furniture',
            ],
            'Beauty & Personal Care' => [
                'Skincare', 'Makeup', 'Hair Care', 'Fragrances', 'Nail Care', 
                'Bath & Body', 'Oral Care', 'Men\'s Grooming', 'Beauty Tools', 'Health Supplements',
            ],
            'Automotive' => [
                'Car Accessories', 'Motorcycle Gear', 'Tools & Equipment', 'Tires & Wheels', 
                'Batteries', 'Car Care', 'GPS & Navigation', 'Dash Cameras', 'Car Electronics', 'Auto Detailing',
            ],
            'Sports & Outdoors' => [
                'Bicycles', 'Camping Gear', 'Fitness Equipment', 'Outdoor Furniture', 
                'Sports Apparel', 'Fishing Gear', 'Hiking Equipment', 'Yoga Mats', 'Team Sports', 'Water Sports',
            ],
            'Toys & Games' => [
                'Action Figures', 'Board Games', 'Building Sets', 'Dolls', 
                'Puzzles', 'Educational Toys', 'Outdoor Play', 'Arts & Crafts', 'Electronic Toys', 'Games for All Ages',
            ],
            'Books & Stationery' => [
                'Fiction', 'Non-Fiction', 'Children\'s Books', 'Textbooks', 
                'Notebooks', 'Stationery Supplies', 'Art Supplies', 'Calendars', 'Planners', 'Writing Tools',
            ],
            'Health & Wellness' => [
                'Vitamins & Supplements', 'Fitness Trackers', 'Yoga Equipment', 'Massage Tools', 
                'Personal Care', 'Healthy Cooking', 'Nutrition Guides', 'Wellness Books', 'Mental Health Resources', 'Health Monitors',
            ],
            'Kitchen & Dining' => [
                'Cookware', 'Dinnerware', 'Utensils', 'Kitchen Gadgets', 
                'Small Appliances', 'Storage Containers', 'Cutlery', 'Table Linens', 'Drinkware', 'Cookbooks',
            ],
            'Garden & Outdoor Living' => [
                'Patio Furniture', 'Grills', 'Gardening Tools', 'Planters', 
                'Outdoor Decor', 'Landscape Lighting', 'Outdoor Heating', 'Bird Feeders', 'Garden Accessories', 'Seeds & Bulbs',
            ],
        ];

        // Sample names for grandchild categories
        $grandchildNames = [
            'Smartphones' => ['Android Phones', 'iOS Phones', 'Feature Phones', '5G Phones', 'Refurbished Phones'],
            'Laptops' => ['Gaming Laptops', 'Ultrabooks', '2-in-1 Laptops', 'Business Laptops', 'Student Laptops'],
            'Cameras' => ['DSLR Cameras', 'Mirrorless Cameras', 'Compact Cameras', 'Action Cameras', 'Security Cameras'],
            'T-Shirts' => ['Graphic Tees', 'Plain Tees', 'V-Neck Tees', 'Tank Tops', 'Long Sleeve Tees'],
            'Jeans' => ['Skinny Jeans', 'Bootcut Jeans', 'Straight Leg Jeans', 'Mom Jeans', 'Distressed Jeans'],
            'Refrigerators' => ['French Door Refrigerators', 'Top Freezer Refrigerators', 'Side-by-Side Refrigerators', 'Mini Refrigerators', 'Smart Refrigerators'],
            'Sofas' => ['Sectional Sofas', 'Sleeper Sofas', 'Reclining Sofas', 'Loveseats', 'Chaise Lounges'],
            'Skincare' => ['Moisturizers', 'Sunscreens', 'Cleansers', 'Serums', 'Face Masks'],
            'Car Accessories' => ['Floor Mats', 'Seat Covers', 'Phone Mounts', 'Dash Covers', 'Sun Shades'],
            'Bicycles' => ['Mountain Bikes', 'Road Bikes', 'Hybrid Bikes', 'Electric Bikes', 'Kids Bikes'],
            // Add more mappings as needed
        ];

        foreach ($parentCategories as $parentCategory) {
            $categoryType = $parentCategory->name;
            $namesArray = $childNames[$categoryType] ?? [];

            // Generate random number of child categories (20 to 30)
            $numChildCategories = rand(20, 30);
            for ($i = 0; $i < $numChildCategories; $i++) {
                // Randomize child name from available names
                $childCategoryName = $namesArray[array_rand($namesArray)];

                // Create child category
                $childCategory = Category::create([
                    'name' => $childCategoryName,
                    'parent_id' => $parentCategory->id,
                    'description' => 'Explore our range of ' . $childCategoryName . ' under ' . $categoryType . '.',
                    'tags' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Randomly decide if this child should have grandchild categories
                if (rand(0, 2) === 1) { // 50% chance to create grandchild categories
                    $numGrandchildCategories = rand(5, 10);
                    for ($j = 0; $j < $numGrandchildCategories; $j++) {
                        // Get grandchild names based on the child category
                        $grandchildNamesArray = $grandchildNames[$childCategoryName] ?? [];
                        if (!empty($grandchildNamesArray)) {
                            $grandchildCategoryName = $grandchildNamesArray[array_rand($grandchildNamesArray)];

                            // Create grandchild category
                            Category::create([
                                'name' => $grandchildCategoryName,
                                'parent_id' => $childCategory->id,
                                'description' => 'Discover our exclusive ' . $grandchildCategoryName . ' products.',
                                'tags' => null,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
