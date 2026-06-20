<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Category::create(['user_id'=>1,'name'=>'Salary','type'=>'income']);
    \App\Models\Category::create(['user_id'=>1,'name'=>'Food','type'=>'expense']);
    \App\Models\Category::create(['user_id'=>1,'name'=>'Fuel','type'=>'expense']);
}
}
