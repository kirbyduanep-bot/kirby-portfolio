<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $certificates = [
            [
                'name' => 'Introduction to Modern AI',
                'issuer' => 'Cisco Networking Academy',
                'url' => 'images/certificates/CISCO.jpe',
                'end_date' => '29 Oct 2026',
                'description' => "Completed Cisco Networking Academy's Introduction to Modern AI course, building a foundation in AI concepts, real-world applications, and the responsible adoption of emerging AI tools.",
                'sort_order' => 0,
            ],
            [
                'name' => 'Understanding Startups & Getting Your Idea Ready for the Philippine Startup Challenge XI',
                'issuer' => 'Department of Information and Communications Technology (DICT)',
                'url' => 'images/certificates/DICT.jpe',
                'end_date' => '7 Sep 2026',
                'description' => 'Participated in the DICT webinar series on startup fundamentals, idea validation, and preparing concepts for the Philippine Startup Challenge XI.',
                'sort_order' => 1,
            ],
            [
                'name' => 'StartupNow Cordillera: Exploring Programs, Funding, and Opportunities for Aspiring Startups',
                'issuer' => 'DOST iHub Innovation Hub — Cordillera',
                'url' => 'images/certificates/DOST.jpe',
                'end_date' => '2 Sep 2026',
                'description' => 'Participated in StartupNow Cordillera, exploring DOST programs, funding avenues, and support opportunities for aspiring startups in the region.',
                'sort_order' => 2,
            ],
        ];

        foreach ($certificates as $certificate) {
            Certification::query()->updateOrCreate(
                ['name' => $certificate['name']],
                $certificate
            );
        }
    }
}
