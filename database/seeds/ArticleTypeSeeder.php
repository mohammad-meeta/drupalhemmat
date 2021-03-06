<?php

use Illuminate\Database\Seeder;
use App\ArticleType;

class ArticleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleType::create([
            "title" => "مرکز اسناد راهبردی"
        ]);
        ArticleType::create([
            "title" => "رویداد"
        ]);
        ArticleType::create([
            "title" => "معرفی"
        ]);
        ArticleType::create([
            "title" => "آیین نامه"
        ]);
        ArticleType::create([
            "title" => "صورتجلسه"
        ]);
        ArticleType::create([
            "title" => "اعضا"
        ]);
    }
}
