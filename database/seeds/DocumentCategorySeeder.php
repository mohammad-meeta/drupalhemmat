<?php

use Illuminate\Database\Seeder;

use App\DocumentCategory;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentCategory::create([
            "title" => "اسناد مربوط به کار گروه سلامت و امنیت استان"
        ]);
        DocumentCategory::create([
            "title" => "شیوه نامه های کار گروه سلامت و امنیت غذایی"
        ]);
        DocumentCategory::create([
            "title" => "اسناد بالا دستی"
        ]);
        DocumentCategory::create([
            "title" => "گزارش های مرتبط با کارگروه ساغ"
        ]);
        DocumentCategory::create([
            "title" => "تفاهم نامه همکاری بین بخشی با حوزه ها"
        ]);
        DocumentCategory::create([
            "title" => "احکام"
        ]);
    }
}
