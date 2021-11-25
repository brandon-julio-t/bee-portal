<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [
            'admin' => ['Allocation', 'Manage Classrooms', 'Manage Students', 'Manage Subjects', 'Manage Lecturers'],
            'student' => [],
            'lecturer' => [],
        ];

        foreach ($routes as $role => $menus) {
            foreach ($menus as $menu) {
                Menu::create(
                    [
                        'id' => Str::uuid(),
                        'name' => $menu,
                        'route_name' => Str::kebab($menu),
                        'role' => $role,
                    ]
                );
            }
        }
    }
}
