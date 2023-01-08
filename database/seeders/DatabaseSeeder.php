<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->createUsers();

        // \App\Models\User::factory(10)->create();
    }

    private function createRoles(): void
    {
        $rolesData = [
            [
                'id' => 1,
                'name' => 'admin',
                'permissions' => '3333',
            ],
            [
                'id' => 0,
                'name' => 'user',
                'permissions' => '0000',
            ]
        ];
        foreach ($rolesData as $roleData) {
            Role::factory()->create([
                'id' => $roleData['id'],
                'name' => $roleData['name'],
                'users_permissions' => $roleData['permissions'],
                'roles_permissions' => $roleData['permissions'],
                'topics_permissions' => $roleData['permissions'],
                'tags_permissions' => $roleData['permissions'],
                'questions_permissions' => $roleData['permissions'],
                'quizzes_permissions' => $roleData['permissions'],
                'study_books_permissions' => $roleData['permissions'],
                'study_materials_permissions' => $roleData['permissions'],
                'study_videos_permissions' => $roleData['permissions'],
                'study_sites_permissions' => $roleData['permissions'],
                'vacancies_permissions' => $roleData['permissions'],
                'sent_questions_permissions' => $roleData['permissions'],
                'interview_requests_permissions' => $roleData['permissions'],
                'expertise_areas_permissions' => $roleData['permissions'],
            ]);
        }
    }

    private function createUsers(): void
    {
        User::factory()->create([
            'role' => 0
        ]);
        User::factory()->create([
            'role' => 1
        ]);
    }
}
