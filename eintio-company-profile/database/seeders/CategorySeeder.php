<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            'SDM',
            'Website',
            'Aplikasi',
            'Finance',
            'Direktur',
            'Corporate and Marketing',
            'Akademik',
            'Sekretaris',
        ];

        foreach ($divisions as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}