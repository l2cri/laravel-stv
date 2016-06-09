<?php

use Illuminate\Database\Seeder;
use App\Services\Delivery\Boxberry\Models\BoxberryPointsCities as City;
use App\Services\Delivery\Boxberry\Models\BoxberryPoints as BoxberryModel;

class BoxberryPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url='http://api.boxberry.de/json.php?token='.config('marketplace.boxberry_token').'&method=ListPoints';

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
            foreach ($data as $point) {

                $city = City::where('code', $point['CityCode'])->first();

                if ($city) {
                    BoxberryModel::create([
                        'bpc_id' => $city->id,
                        'code' => $point['Code'],
                        'name' => $point['Name'],
                        'address' => $point['Address'],
                        'phone' => $point['Phone'],
                        'work_schedule' => $point['WorkSchedule'],
                        'trip_description' => $point['TripDescription'],
                        'delivery_period' => $point['DeliveryPeriod'],
                        'city_code' => $point['CityCode'],
                        'city_name' => $point['CityName'],
                        'tarif_zone' => $point['TariffZone'],
                        'settlement' => $point['Settlement'],
                        'area' => $point['Area'],
                        'country' => $point['Country'],
                        'only_prepaid_orders' => $point['OnlyPrepaidOrders'],
                        'address_reduce' => $point['AddressReduce'],
                        'acquiring' => $point['Acquiring'],
                        'digital_signature' => $point['DigitalSignature'],
                        'office_type' => $point['TypeOfOffice'],
                        'nal_kd' => $point['NalKD'],
                        'metro' => $point['Metro'],
                        'gps' => $point['GPS'],
                    ]);
                }
            }
        }
    }
}
