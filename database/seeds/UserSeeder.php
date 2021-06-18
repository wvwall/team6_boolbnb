<?php
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 6; $i++) {
        $new_user = new User();
        $new_user->name = $faker->word();
        $new_user->email = $faker->safeEmail();
        $new_user->password = $faker->word();
        $new_user->save();
      }
    }
}
