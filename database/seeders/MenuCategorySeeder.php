<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menucategories = ['Soft Drink', 'Deserts', 'Momo', 'Burgers', 'Friedrice'];

        foreach ($menucategories as $table) {
            MenuCategory::create([
                'name' => $table,
                
            ]);
        }
    }
}
