<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 10; $i++) {
        $new_apartment = new Apartment();
        $new_apartment->title = $faker->sentence(3);
        $new_apartment->city = $faker->city();
        $new_apartment->address = $faker->streetAddress();
        $new_apartment->n_rooms = $faker->numberBetween(1, 15);
        $new_apartment->n_beds = $faker->numberBetween(1, 5);
        $new_apartment->user_id = User::all()->random()->id;
        $new_apartment->n_bathrooms = $faker->numberBetween(1, 5);
        $new_apartment->lat = $faker->latitude();
        $new_apartment->long = $faker->longitude();
        $new_apartment->slug = Str::slug($new_apartment->title, '-');
        $new_apartment->square_meters = $faker->numberBetween(50, 120);
        $new_apartment->visibility = $faker->boolean();
        $new_apartment->save();
      }
    }
}
