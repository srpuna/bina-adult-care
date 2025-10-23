<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            // Home page content
            [
                'page' => 'home',
                'key' => 'hero_headline',
                'value' => 'Owned, Operated, and Managed by Caregivers.',
            ],
            [
                'page' => 'home',
                'key' => 'hero_subtext',
                'value' => 'We look after your best interests, with a profound understanding of the challenges caregivers face firsthand.',
            ],
            [
                'page' => 'home',
                'key' => 'program_title',
                'value' => 'Bina Adult Care: The Human Service and Home Health Workers Loan Repayment Program',
            ],
            [
                'page' => 'home',
                'key' => 'program_text',
                'value' => 'Our employees are eligible through the Bina Adult care Program.',
            ],
            [
                'page' => 'home',
                'key' => 'community_text',
                'value' => 'By choosing us, you\'re not just selecting a home care provider; you\'re joining a community of caregivers dedicated to making your life easier.',
            ],

            // About page content
            [
                'page' => 'about',
                'key' => 'main_title',
                'value' => 'We Understand Caregiving — Because We\'ve Lived It.',
            ],
            [
                'page' => 'about',
                'key' => 'main_text',
                'value' => 'As an organization founded and operated by individuals who have walked in your shoes, we intimately comprehend the intricate demands and emotional toll that caregiving can encompass. Our mission is to support, empower, and uplift caregivers with meaningful opportunities and compassionate understanding.',
            ],
            [
                'page' => 'about',
                'key' => 'mission_text',
                'value' => 'To provide exceptional care services while creating meaningful career opportunities for passionate caregivers, fostering a community where both care recipients and caregivers thrive.',
            ],

            // Contact information
            [
                'page' => 'contact',
                'key' => 'address',
                'value' => '123 Care Street, Suite 100, City, State 12345',
            ],
            [
                'page' => 'contact',
                'key' => 'phone',
                'value' => '(555) 123-4567',
            ],
            [
                'page' => 'contact',
                'key' => 'email',
                'value' => 'info@binaadultcare.com',
            ],
            [
                'page' => 'contact',
                'key' => 'hours',
                'value' => 'Monday - Friday: 9:00 AM - 6:00 PM\nSaturday: 10:00 AM - 4:00 PM\nSunday: Closed',
            ],
        ];

        foreach ($contents as $content) {
            Content::create($content);
        }
    }
}