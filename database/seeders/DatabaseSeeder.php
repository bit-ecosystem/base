<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data_samples/users.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('users')->insert([
                    "name" => $data['0'],
                    'email' => $data['1'],
                    'password' => Hash::make($data['2'])
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
        $role = Role::create(['name' => 'Viewer']);
        User::factory(25)->create()->each(function ($user) {
            $user->assignRole('Viewer');
        });

        $csvFile = fopen(base_path("database/data_samples/links.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('links')->insert([
                    'url' => $data['0'],
                    'foruse' => $data['1'],
                    'title' => $data['2'],
                    'description' => $data['3'],
                    'color' => $data['4']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);

        $csvFile = fopen(base_path("database/data_samples/jobPosts.csv"), "r");
        $firstline = true;
        $key = null;
        while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
            if ($firstline) {
                $key = $data;
            } else {
                $id = DB::table('job_posts')->insertGetId([
                    'name' => $data['0'],
                    'reports_to_id' => $data['1'],
                ]);
                $role = Role::create(['name' => $data['0']]);
                //$id = JobPost::assignRole($data['0']);
                //dd($role);
                //JobPost::find($id)->assignRole($data['0'],'web');
                for ($x = 2; $x < 8; $x++) {
                    $pid = DB::table('job_post_properties')->insertGetId([
                        'name' => $key[$x],
                        'value' => $data[$x],
                        'job_post_id' => $id,
                    ]);
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
