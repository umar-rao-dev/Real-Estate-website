<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Announcement;
use App\Models\AgentRequest;
use App\Models\Query;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1234567890',
            'theme' => 'light',
            'is_active' => true,
        ]);

        // Create Agent Users
        $agent1 = User::create([
            'name' => 'John Agent',
            'email' => 'agent1@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'phone' => '+1234567891',
            'theme' => 'light',
            'is_active' => true,
        ]);

        $agent2 = User::create([
            'name' => 'Sarah Agent',
            'email' => 'agent2@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'phone' => '+1234567892',
            'theme' => 'dark',
            'is_active' => true,
        ]);

        // Create Regular Users
        $user1 = User::create([
            'name' => 'Mike User',
            'email' => 'user1@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '+1234567893',
            'theme' => 'light',
            'is_active' => true,
        ]);

        $user2 = User::create([
            'name' => 'Emma User',
            'email' => 'user2@realestate.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '+1234567894',
            'theme' => 'light',
            'is_active' => true,
        ]);

        // Create Categories
        $residential = Category::create([
            'name' => 'Residential',
            'description' => 'Residential properties including houses, apartments, and condos',
            'is_active' => true,
        ]);

        $commercial = Category::create([
            'name' => 'Commercial',
            'description' => 'Commercial properties including offices, retail spaces, and warehouses',
            'is_active' => true,
        ]);

        $land = Category::create([
            'name' => 'Land',
            'description' => 'Vacant land and lots for development',
            'is_active' => true,
        ]);

        $luxury = Category::create([
            'name' => 'Luxury',
            'description' => 'High-end luxury properties and estates',
            'is_active' => true,
        ]);

        // Create Properties
        $property1 = Property::create([
            'user_id' => $agent1->id,
            'category_id' => $residential->id,
            'title' => 'Modern Family Home',
            'description' => 'Beautiful 3-bedroom family home in a quiet neighborhood with modern amenities and spacious backyard.',
            'price' => 450000,
            'beds' => 3,
            'baths' => 2,
            'area' => 2000,
            'location' => 'Los Angeles, CA',
            'type' => 'buy',
            'availability' => 'available',
            'status' => 'available',
            'is_approved' => true,
        ]);

        $property2 = Property::create([
            'user_id' => $agent1->id,
            'category_id' => $commercial->id,
            'title' => 'Downtown Office Space',
            'description' => 'Prime office space in the heart of downtown with excellent views and modern facilities.',
            'price' => 5000,
            'beds' => 0,
            'baths' => 2,
            'area' => 3500,
            'location' => 'New York, NY',
            'type' => 'rent',
            'availability' => 'available',
            'status' => 'available',
            'is_approved' => true,
        ]);

        $property3 = Property::create([
            'user_id' => $agent2->id,
            'category_id' => $luxury->id,
            'title' => 'Luxury Beachfront Villa',
            'description' => 'Stunning 5-bedroom beachfront villa with private pool, ocean views, and high-end finishes throughout.',
            'price' => 2500000,
            'beds' => 5,
            'baths' => 4,
            'area' => 5000,
            'location' => 'Miami, FL',
            'type' => 'buy',
            'availability' => 'available',
            'status' => 'available',
            'is_approved' => true,
        ]);

        $property4 = Property::create([
            'user_id' => $agent2->id,
            'category_id' => $residential->id,
            'title' => 'Cozy Apartment',
            'description' => 'Charming 2-bedroom apartment perfect for young professionals or small families.',
            'price' => 1800,
            'beds' => 2,
            'baths' => 1,
            'area' => 1200,
            'location' => 'San Francisco, CA',
            'type' => 'rent',
            'availability' => 'available',
            'status' => 'available',
            'is_approved' => true,
        ]);

        $property5 = Property::create([
            'user_id' => $agent1->id,
            'category_id' => $land->id,
            'title' => 'Development Land',
            'description' => '10-acre plot of land perfect for residential or commercial development.',
            'price' => 500000,
            'beds' => 0,
            'baths' => 0,
            'area' => 435600,
            'location' => 'Austin, TX',
            'type' => 'buy',
            'availability' => 'available',
            'status' => 'available',
            'is_approved' => true,
        ]);

        // Create Announcements
        Announcement::create([
            'title' => 'Welcome to Our Platform',
            'description' => 'We are excited to announce the launch of our new real estate platform. Find your dream property today!',
            'is_active' => true,
        ]);

        Announcement::create([
            'title' => 'New Properties Added',
            'description' => 'Check out our latest listings featuring luxury homes and commercial spaces in prime locations.',
            'is_active' => true,
        ]);

        Announcement::create([
            'title' => 'Summer Sale',
            'description' => 'Special discounts on selected properties this summer. Contact our agents for more details.',
            'is_active' => true,
        ]);

        // Create Agent Requests
        AgentRequest::create([
            'user_id' => $user1->id,
            'message' => 'I have 5 years of experience in real estate and would like to become an agent on your platform.',
            'status' => 'pending',
        ]);

        AgentRequest::create([
            'user_id' => $user2->id,
            'message' => 'Licensed real estate professional looking to expand my business through your platform.',
            'status' => 'pending',
        ]);

        // Create Queries
        Query::create([
            'property_id' => $property1->id,
            'agent_id' => $agent1->id,
            'user_id' => $user1->id,
            'message' => 'I am interested in this property. Can we schedule a viewing?',
        ]);

        Query::create([
            'property_id' => $property3->id,
            'agent_id' => $agent2->id,
            'user_id' => $user2->id,
            'message' => 'What is the financing option available for this property?',
        ]);

        // Create Feedback
        Feedback::create([
            'user_id' => $user1->id,
            'message' => 'Great platform! Very easy to use and find properties.',
        ]);

        Feedback::create([
            'user_id' => $user2->id,
            'message' => 'The agents are very responsive and helpful. Highly recommended!',
        ]);

        echo "Database seeded successfully!\n";
        echo "Admin: admin@realestate.com / password\n";
        echo "Agent 1: agent1@realestate.com / password\n";
        echo "Agent 2: agent2@realestate.com / password\n";
        echo "User 1: user1@realestate.com / password\n";
        echo "User 2: user2@realestate.com / password\n";
    }
}
