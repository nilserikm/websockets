<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChecklistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('checklists')->insert([
                'title' => $faker->company,
                'checked' => false
            ]);
        }
    }
}
