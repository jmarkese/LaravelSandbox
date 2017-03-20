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
        $faker = \Faker\Factory::create();

        $limit = 500;
        $belongs = 10;
        $hasMany = ((int) $limit / $belongs);
        //numberBetween($min = 1, $max = $limit)
        for ($i = 0; $i < $limit*2; $i++)
        {
            DB::table('users')->insert([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->word,
                'blue_id' => $faker->numberBetween($min = 1, $max = $limit),
                'red_id' => $faker->numberBetween($min = 1, $max = $limit),
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('whites')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
                'black_id' => $i+1,
                'grey_id' => ((int) ($i / $belongs)) + 1,
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('blacks')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
            ]);
        }

        for ($i = 0; $i < $hasMany; $i++) {
            DB::table('greys')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('blues')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
                'deleted_at' => ($i === $limit-1) ? null : $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'user_id' => $faker->numberBetween($min = 1, $max = $limit),
                'white_id' => $faker->numberBetween($min = 1, $max = $limit),

            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('cyans')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
                'white_id' => $faker->numberBetween($min = 1, $max = $limit),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('blue_cyan')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'blue_id' => $faker->numberBetween($min = 1, $max = $limit),
                'cyan_id' => $faker->numberBetween($min = 1, $max = $limit),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('black_white')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'black_id' => $faker->numberBetween($min = 1, $max = $limit),
                'white_id' => $faker->numberBetween($min = 1, $max = $limit),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('greens')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
                'yellow_id' => $faker->numberBetween($min = 1, $max = $limit),
                'greenable_id' => $faker->numberBetween($min = 1, $max = $limit),
                'greenable_type' => 'App\White',
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('magentas')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('magentables')->insert([
                'magenta_id' => $faker->numberBetween($min = 1, $max = $limit),
                'magentables_id' => $faker->numberBetween($min = 1, $max = $limit),
                'magentables_type' => 'App\White',
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('reds')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
                'user_id' => $faker->numberBetween($min = 1, $max = $limit),
                'white_id' => $faker->numberBetween($min = 1, $max = $limit),

            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('yellows')->insert([
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
                'name' => $faker->domainWord,
                'number' => $faker->randomNumber($nbDigits = NULL),
                'red_id' => $faker->numberBetween($min = 1, $max = $limit),
                'white_id' => $i+1,
            ]);
        }
    }
}
