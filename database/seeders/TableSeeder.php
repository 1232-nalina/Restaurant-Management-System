<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    public function run()
    {
        $tableNames = ['Table 1', 'Table 2', 'Table 3', 'Table 4', 'Table 5'];

        foreach ($tableNames as $tableName) {
            Table::create([
                'name' => $tableName,
                'status'=> 'empty',
            ]);
        }
    }
}