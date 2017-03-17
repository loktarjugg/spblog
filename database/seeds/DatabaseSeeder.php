<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(InitTableSeeder::class);
        $this->call(WorkTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(ShareTableSeeder::class);
    }
}
