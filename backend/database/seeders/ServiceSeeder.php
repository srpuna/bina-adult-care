<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Personal Care Assistance',
                'description' => 'Professional assistance with daily activities including bathing, dressing, grooming, and mobility support.',
                'image_path' => 'images/personal-care.jpg',
            ],
            [
                'title' => 'Companionship & Emotional Support',
                'description' => 'Friendly conversation, social engagement, and emotional support to enhance quality of life.',
                'image_path' => 'images/companionship.jpg',
            ],
            [
                'title' => 'Medication Reminders',
                'description' => 'Timely medication reminders and assistance with organizing prescriptions.',
                'image_path' => 'images/medication.jpg',
            ],
            [
                'title' => 'Light Housekeeping',
                'description' => 'Assistance with maintaining a clean and organized living environment.',
                'image_path' => 'images/housekeeping.jpg',
            ],
            [
                'title' => 'Respite Care',
                'description' => 'Temporary relief for family caregivers to prevent burnout and ensure continued quality care.',
                'image_path' => 'images/respite.jpg',
            ],
            [
                'title' => 'Transportation Assistance',
                'description' => 'Safe and reliable transportation for medical appointments, shopping, and social activities.',
                'image_path' => 'images/transportation.jpg',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}