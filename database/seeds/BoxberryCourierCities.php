<?php

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Services\Delivery\Boxberry\Models\BoxberryCourierCities as BoxberryModel;

class BoxberryCourierCities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url='http://api.boxberry.de/json.php?token='.config('marketplace.boxberry_token').'&method=CourierListCities';

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
            // все отлично, ответ получен, теперь в массиве $data,
            // список доступных для курьерской доставки городов в формате:
            /*
            $data[0...n]=array(
              'City'=>'Населенный пункт',
              'Region'=>'Регион',
              'Area'=>'Область',
               'DeliveryPeriod' => '8.00'
            );
	           */

            foreach ($data as $city) {
                $name = $city['City'];
                $time = $city['DeliveryPeriod'];

                $location = Location::where('name', $name)->where('shortname', 'г')->first();

                if ($location) {
                    BoxberryModel::create([
                        'location_id' => $location->id,
                        'name' => $name,
                        'time' => $time
                    ]);
                }
            }
        }
    }
}
