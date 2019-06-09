<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    const TABLE = 'users';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->truncateTables();

        $this->seedTables();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Truncate seeded tables
     */
    private function truncateTables()
    {
        DB::table(SELF::TABLE)->truncate();
    }

    /**
     * Seeds Users data
     */
    private function seedTables()
    {
        $faker = \Faker\Factory::create();

        $password = Hash::make('secret');

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
            'api_token' => str_random(20),
            'role' => User::ADMIN_ROLE,
        ]);

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'api_token' => str_random(20),
                'role' => User::DEFAULT_ROLE,
            ]);
        }
    }
}
