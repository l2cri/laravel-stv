<?php

use Illuminate\Database\Seeder;
use App\Models\Product\Product;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $loreum = 'lorem ipsum dolor sit amet';
        $ipsum = 'consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat';
        $user_id = 3;

        for ($i = 1; $i <= 30; $i++){
            $comment = new App\Models\Faq;
            $comment->question = $loreum;
            $comment->user_id = $user_id;
            $comment->product_id = Product::first()->id;
            $comment->moderated = 1;
            $comment->answer = $ipsum;

            $comment->save();
        }
    }
}