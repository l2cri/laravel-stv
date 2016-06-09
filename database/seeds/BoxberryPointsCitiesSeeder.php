<?php

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Services\Delivery\Boxberry\Models\BoxberryPointsCities as BoxberryModel;

class BoxberryPointsCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url='http://api.boxberry.de/json.php?token='.config('marketplace.boxberry_token').'&method=ListCities';

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
            foreach ($data as $city) {
                $name = $city['Name'];

                $location = Location::where('name', $name)->where('shortname', 'г')->first();

                if ($location) {
                    BoxberryModel::create([
                        'location_id' => $location->id,
                        'name' => $name,
                        'code' => $city['Code'], // по этому коду свяжем точки самовывоза, bpc_id fk в таблице boxberry_points
                        'country_code' => $city['CountryCode']
                    ]);
                }
            }
        }
    }
}
