<?php

use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    const TABLE = 'products';

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
     * Seeds Products data
     */
    private function seedTables()
    {
        $faker = \Faker\Factory::create();

        $users = User::all()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {

            $user_id = $faker->randomElement($users);

            Product::create([
                'name' => $faker->text($maxNbChars = 20),
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat($nbMaxDecimals = null, $min = 0, $max = 100000),
                'active' => $faker->numberBetween($min = 0, $max = 1),
                'user_id' => $user_id,
            ]);
        }
    }
}
