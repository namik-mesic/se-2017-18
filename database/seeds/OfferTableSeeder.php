<?php

use Illuminate\Database\Seeder;

class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Offer::class, 50)->create()->each(function (\App\Offer $offer){

            $offer->tags()->attach([1,7, 4]);

        });
    }
}
