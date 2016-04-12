<?php

use Illuminate\Database\Seeder;
use \App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    protected $model;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxLevel = 6;
        $model = new Location();
        $this->model = $model;

        // сначала сделаем для первого уровня

        for ($l = 1; $l <= $maxLevel; $l++) {
            // достаем из базы данных fias (mysql), connection mysql_fias
            $fiasLocations = DB::connection('mysql_fias')->table('d_fias_addrobj')
                            ->where('actstatus', 1)->where('aolevel', $l)->get();


            // локации уровня 1 и записываем их в базу данных.
            foreach ($fiasLocations as $flocation) {

                $location = $this->makeLocation($flocation);

                // после сохранения локации достаем из базы fias всех ее детей c aolevel <= $maxLevel
                $fiasChildren = DB::connection('mysql_fias')->table('d_fias_addrobj')
                    ->where('actstatus', 1)->where('aolevel', '<=', $maxLevel)
                    ->where('parentguid', $location->aoguid)->get();

                // после сохранения локации достаем из базы fias всех ее детей c aolevel <= $maxLevel
                foreach( $fiasChildren as $fiasChild ) {

                    // сохраняем детей с проверкой, нет ли уже такого в базе
                    $locationChild = $this->makeLocation($fiasChild);
                    $location->appendNode($locationChild);
                }
            }
        }
    }

    protected function makeLocation($flocation) {
        // перед записью по aoguid проверяем, нет ли уже такой локации в базе данных
        $location = $this->model->firstOrNew( array( 'aoguid' => $flocation->aoguid ) );

        if ( !isset($location->attributes['name']) ) {
            $location->name = $flocation->offname;
            $location->regioncode = $flocation->regioncode;
            $location->parentguid = $flocation->parentguid;
            $location->aoid = $flocation->aoid;
            $location->level = $flocation->aolevel;
            $location->shortname = $flocation->shortname;
            $location->save();
        }

        return $location;
    }
}
