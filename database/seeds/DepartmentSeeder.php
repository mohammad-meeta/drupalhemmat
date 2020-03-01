<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentCategory::create([
            "title" => "معاونت ها و واحدهای تابعه"
        ]);
        DocumentCategory::create([
            "title" => "شورای رابطان"
        ]);
        DocumentCategory::create([
            "title" => "هیات رئیسه دانشگاه"
        ]);
        DocumentCategory::create([
            "title" => "هیات امنای دانشگاه"
        ]);
    }
}
