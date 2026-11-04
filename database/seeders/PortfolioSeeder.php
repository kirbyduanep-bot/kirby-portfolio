<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Profile::query()->create([
            'name' => 'Parel Kirby',
            'title' => 'Student / Developer',
            'headline' => 'Student / Developer',
            'summary' => 'Quietly becoming stronger, wiser, and better. I may not have it all figured out, but I trust the journey and believe my best chapters are still ahead.',
            'hero_summary' => 'Quietly becoming stronger, wiser, and better. I may not have it all figured out, but I trust the journey and believe my best chapters are still ahead.',
            'email' => 'parelkirby@gmail.com',
            'phone' => '09495909683',
            'location' => 'San Isidro, Abra',
            'avatar_path' => 'images/parel.jpg',
            'avatar_label' => 'Parel Kirby',
        ]);

        $groups = [
            'frontend' => [
                'title' => 'Frontend',
                'skills' => [
                    ['name' => 'HTML/CSS', 'icon' => 'SiHtml5'],
                    ['name' => 'JavaScript', 'icon' => 'SiJavascript'],
                    ['name' => 'React', 'icon' => 'SiReact'],
                    ['name' => 'Tailwind', 'icon' => 'SiTailwindcss'],
                ],
            ],
            'backend' => [
                'title' => 'Backend',
                'skills' => [
                    ['name' => 'PHP', 'icon' => 'SiPhp'],
                    ['name' => 'Laravel', 'icon' => 'SiLaravel'],
                    ['name' => 'MySQL', 'icon' => 'SiMysql'],
                ],
            ],
            'tools' => [
                'title' => 'Tools',
                'skills' => [
                    ['name' => 'Git', 'icon' => 'SiGit'],
                    ['name' => 'GitHub', 'icon' => 'SiGithub'],
                    ['name' => 'VS Code', 'icon' => 'SiVisualstudiocode'],
                ],
            ],
        ];

        foreach ($groups as $slug => $group) {
            $category = SkillCategory::query()->create([
                'title' => $group['title'],
                'slug' => $slug,
            ]);

            foreach ($group['skills'] as $index => $skill) {
                Skill::query()->create([
                    'skill_category_id' => $category->id,
                    'name' => $skill['name'],
                    'icon' => $skill['icon'],
                    'sort_order' => $index,
                ]);
            }
        }

        Project::query()->create([
            'slug' => 'students-document-request-system-dccp-bangued',
            'title' => 'STUDENTS DOCUMENT REQUEST SYSTEM FOR DCCP-BANGUED',
            'short' => 'A web-based document request workflow for DCCP-Bangued students and the registrar office.',
            'description' => 'A capstone project built for Data Center College of the Philippines – Bangued that digitizes student document requests. Students can submit requests while the registrar office tracks each one through pending, processing, ready-for-pickup, and completed stages from a single dashboard.',
            'image' => 'images/screenshots/DCCP.png',
            'tags' => ['Laravel', 'PHP', 'MySQL', 'HTML/CSS', 'JavaScript', 'Capstone'],
            'links' => [],
            'is_under_development' => true,
            'featured' => true,
            'sort_order' => 0,
        ]);

        SocialLink::query()->create([
            'label' => 'Facebook',
            'url' => 'https://www.facebook.com/kirby.parel.9',
            'icon' => 'SiFacebook',
            'size' => '2x',
            'sort_order' => 0,
        ]);

        SocialLink::query()->create([
            'label' => 'GitHub',
            'url' => 'https://github.com/kirbyduanep-bot',
            'icon' => 'SiGithub',
            'size' => '2x',
            'sort_order' => 1,
        ]);

        Education::query()->create([
            'degree' => 'Tertiary',
            'school' => 'Data Center College of Bangued',
            'start_date' => '2023',
            'is_present' => true,
            'sort_order' => 0,
        ]);

        Education::query()->create([
            'degree' => 'Secondary',
            'school' => 'Abra State Institute of Science and Technology-Bangued',
            'start_date' => '2021',
            'end_date' => '2023',
            'sort_order' => 1,
        ]);
    }
}
