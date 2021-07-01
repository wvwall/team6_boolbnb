<?php

use Illuminate\Database\Seeder;
use App\Promotion;
class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $promotion24hours = new Promotion;
      $promotion72hours = new Promotion;
      $promotion144hours = new Promotion;
      $promotion24hours->name = 'standard(24ore)';
      $promotion24hours->price = 2.99;
      $promotion24hours->duration = 1;
      $promotion72hours->name = 'special(72ore)';
      $promotion72hours->price = 5.99;
      $promotion72hours->duration =  3;
      $promotion144hours->name = 'premium(24ore)';
      $promotion144hours->price = 9.99;
      $promotion144hours->duration =  6;
      $promotion24hours->save();
      $promotion72hours->save();
      $promotion144hours->save();
    }
}
