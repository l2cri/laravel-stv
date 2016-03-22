<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'Новый',
            'color' => '#03b4ea',
        ]);

        DB::table('statuses')->insert([
            'name' => 'В обработке',
            'color' => '#e7b60a',
        ]);

        DB::table('statuses')->insert([
            'name' => 'Завершен',
            'color' => '#8cbc09',
        ]);

        DB::table('statuses')->insert([
            'name' => 'Отменен',
            'color' => '#bc0909',
        ]);

    }
}
