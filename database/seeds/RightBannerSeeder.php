<?php

use Illuminate\Database\Seeder;

class RightBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $name = "Тестовый баннер ";
        $url = '/catalog/product/';
        $image = [
            '/img/velo.jpg','/img/moloko.jpg','/img/traktor.jpg'
        ];

        for ($i = 0; $i <= 2; $i++){
            $post = new App\Models\Banner;

            $post->name = $name.$i;
            $post->image = $image[$i];
            $post->url = $url.($i+1);
            $post->sort = rand(0,1000);
            $post->type = 'right';

            $post->save();
        }
    }
}
