<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 13.04.16
 * Time: 12:33
 */

namespace App\Repo\Location;

use Illuminate\Http\Request;
use SimpleXMLElement;
use Illuminate\Database\Eloquent\Model;

class LocationRepo implements LocationInterface
{
    protected $model;
    protected $supplier;
    protected $request;

    public function __construct(Model $model, Model $supplier, Request $request) {
        $this->model = $model;
        $this->supplier = $supplier;
        $this->request = $request;
    }

    public function saveDeliveryZone(array $locationIds, $supplierId)
    {
        // Location and Supplier ManyToMany

        $supplier = $this->supplier->find($supplierId);
        $supplier->locations()->detach();
        $supplier->locations()->attach($locationIds);
    }

    public function getByName($locationName)
    {
        // Name делаем like

        return $this->model->where('name', 'like', $locationName.'%')->first();
    }

    public function getTree($level)
    {
        return $this->model->where('level', '<=', $level)->defaultOrder()->get()->toTree();
    }

    public function getByGeoIp()
    {
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, "http://ipgeobase.ru:7020/geo/?ip=" . getUserIP() );
        curl_setopt( $ch, CURLOPT_HEADER, false );
        curl_setopt( $ch, CURLOPT_VERBOSE, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 2 );

        $text = curl_exec( $ch );

        $errno  = curl_errno( $ch );
        $errstr = curl_error( $ch );
        curl_close( $ch );

        if ( $errno )
            return false;

        //$text = mb_convert_encoding($text, 'UTF-8', 'windows-1251');

        $xml = new SimpleXMLElement($text);

        return $this->getByName( $xml->ip->city );
    }

    public function getSessionLocation()
    {
        if ($this->request->session()->has('locationId'))
            return $this->model->find( $this->request->session()->get('locationId') );

        $location = $this->getByGeoIp();
        $this->request->session()->put('locationId', $location->id);

        return $location;
    }

    public function setSessionLocation($locationId)
    {
        if ($this->model->find($locationId))
            $this->request->session()->put('locationId', $locationId);
        else return false;
    }

}