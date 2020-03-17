<?php

use Illuminate\Database\Seeder;

use App\Department;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            "title" => "معاونت ها و واحدهای تابعه",
            "status" => true
        ]);
        Department::create([
            "title" => "شورای رابطان",
            "status" => true
        ]);
        Department::create([
            "title" => "هیات رئیسه دانشگاه",
            "status" => true
        ]);
        Department::create([
            "title" => "هیات امنای دانشگاه",
            "status" => true
        ]);
    }
}
