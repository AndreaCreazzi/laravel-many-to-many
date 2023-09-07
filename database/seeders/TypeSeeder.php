<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = ['Front-end', 'Back-end', 'Full-stack', 'MYSQL', 'Vue-js'];

        foreach ($labels as $label) {
            $newtype = new Type();
            $newtype->label = $label;
            $newtype->color = $faker->hexColor();
            $newtype->save();
        }
    }
}
