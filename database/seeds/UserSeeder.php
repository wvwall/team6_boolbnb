<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 6; $i++) {
        $new_user = new User();
        $new_apartment->name = $faker->word();
        $new_apartment->email = $faker->uniqueEmail();
        $new_apartment->password = $faker->word();
        $new_apartment->save();
      }
    }
}
