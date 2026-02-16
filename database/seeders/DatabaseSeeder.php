<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Property;
use App\Models\Announcement;
use App\Models\AgentRequest;
use App\Models\Query;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'theme' => 'light',
        ]);

        // 2. Create Agent User
        $agent = User::create([
            'name' => 'Premium Agent',
            'email' => 'agent@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'theme' => 'light',
        ]);

        // 3. Create Regular User
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'theme' => 'light',
        ]);

        // 4. Create Categories
        $cat1 = Category::create(['name' => 'Apartment', 'description' => 'Modern luxury apartments']);
        $cat2 = Category::create(['name' => 'Villa', 'description' => 'Spacious independent villas']);
        $cat3 = Category::create(['name' => 'Office', 'description' => 'Prime commercial spaces']);

        // 5. Create Sample Properties
        $p1 = Property::create([
            'user_id' => $agent->id,
            'category_id' => $cat2->id,
            'name' => 'Skyline Luxury Villa',
            'description' => 'A stunning 5-bedroom villa with panoramic city views and private pool.',
            'price' => 1250000,
            'beds' => 5,
            'baths' => 4,
            'area' => 4500,
            'location' => 'Beverly Hills, CA',
            'type' => 'buy',
            'availability' => 'available',
        ]);

        $p2 = Property::create([
            'user_id' => $agent->id,
            'category_id' => $cat1->id,
            'name' => 'Downtown Modern Studio',
            'description' => 'Compact and stylish studio in the heart of the tech district.',
            'price' => 2500,
            'beds' => 1,
            'baths' => 1,
            'area' => 850,
            'location' => 'San Francisco, CA',
            'type' => 'rent',
            'availability' => 'available',
        ]);

        // 6. Create Announcements
        Announcement::create([
            'title' => 'Welcome to RealEstate',
            'description' => 'We have officially launched our premium property platform today!'
        ]);

        // 7. Create Feedback
        Feedback::create([
            'user_id' => $user->id,
            'subject' => 'Great Support',
            'message' => 'The platform is very intuitive and easy to use.'
        ]);

        echo "Seeding completed successfully!\n";
        echo "---------------------------------\n";
        echo "Admin: admin@realestate.com / password\n";
        echo "Agent: agent@realestate.com / password\n";
        echo "User:  user@realestate.com / password\n";
    }
}
