<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $name = "Тестовый баннер ";
        $url = '/catalog/product/';
        $image = [
            '/img/velo.jpg','/img/egg.jpg','/img/moloko.jpg','/img/traktor.jpg'
        ];

        for ($i = 0; $i <= 3; $i++){
            $post = new App\Models\Banner;

            $post->name = $name.$i;
            $post->image = $image[$i];
            $post->url = $url.($i+1);
            $post->sort = rand(0,1000);

            $post->save();
        }

        self::addAbiluties();
    }

    private function addAbiluties() {
        $ability = new App\Models\Ability;

        $isset = $ability->where('action','banners_admin')->first();

        if(is_null($isset)){
            $ability->name = "Banners  администрирование";
            $ability->description = "Администрирование баннеров";
            $ability->action = "banners_admin";

            $ability->save();
        }
    }
}
