<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->insert([
            [
                'name'  => "Новичок",
                'score' => 100,
            ],
            [
                'name'  => "Ученик",
                'score' => 200,
            ],
            [
                'name'  => "Знаток",
                'score' => 500,
            ],
            [
                'name'  => "Специалист",
                'score' => 1000,
            ],
            [
                'name'  => "Мастер",
                'score' => 2000,
            ],
            [
                'name'  => "Гуру",
                'score' => 5000,
            ],
            [
                'name'  => "Мудрец",
                'score' => 10000,
            ],
            [
                'name'  => "Гений",
                'score' => 20000,
            ],
            [
                'name'  => "Оракул",
                'score' => 50000,
            ],
            [
                'name'  => "Высший разум",
                'score' => 100000,
            ],
        ]);
    }
}
