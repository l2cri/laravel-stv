<?php

use Illuminate\Database\Seeder;
use App\Services\Delivery\Boxberry\Models\BoxberryCourierZips as BoxberryModel;

class BoxberryCourierZipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url='http://api.boxberry.de/json.php?token='.config('marketplace.boxberry_token').'&method=ListZips';

        $handle = fopen($url, "rb");
        $contents = stream_get_contents($handle);
        fclose($handle);
        $data=json_decode($contents,true);
        if(count($data)<=0 || isset($data[0]['err']))
        {
            // если произошла ошибка и ответ не был получен:
            echo $data[0]['err'];
        }
        else
        {
            foreach ($data as $zip) {
                BoxberryModel::create([
                    'zip' => $zip['Zip'],
                    'city' => $zip['City'],
                    'area' => $zip['Area']
                ]);
            }
        }
    }
}