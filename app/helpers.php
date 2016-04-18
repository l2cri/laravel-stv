<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.12.15
 * Time: 19:55
 */

/*
 * возвращает все возможные действия в системе
 */

function allActions(){
    $actions = array();
    $abilities = \App\Models\Ability::all();
    foreach ($abilities as $ability) {
        $actions[] = $ability->action;
    }
    return $actions;
}

/*
 * возвращает символ для html деревьев
 */

function treeSymbol($q, $sign){

    if (empty($q)) return '';

    $str = '';
    for($i = 0; $i < $q; $i++){
        $str .= $sign;
    }
    return $str;
}

/*
 * почистить массив от пустых значений - для инпута
 */

function removeEmptyValues(array $array){

    return array_filter($array, function($v, $k) {

        if (is_array($v)) return count($v);
        return strlen(trim($v));
    }, ARRAY_FILTER_USE_BOTH);
}

/**
 * @param $params - массив для query string
 *
 */
function url_add_params($params, $current = null){

    if (!$current) $current = URL::full();

    $query = implode('&', $params);
    if (stristr($current, '?')){
        return $current.'&'.$query;
    } else return $current.'?'.$query;
}

function url_set_params($params, $current = null){

    if (!$current) $current = URL::current();

    $query = implode('&', $params);
    return $current.'?'.$query;
}

function getPerPage(){
    $limit = ( !empty(\Input::get('limit')) ) ? \Input::get('limit') : \Input::session()->get('limit', 12);
    if ( !empty(\Input::get('limit')) ) {
        \Input::session()->put('limit', \Input::get('limit'));
    }
    return $limit;
}

// разбивает массив на четный и нечетные по ключам, для таблиц в две колонки
function evenOddArray($array){
    $odd = $even = array();
    for ($i = 0, $l = count($array); $i < $l;) { // Notice how we increment $i each time we use it below, by two in total
        $even[] = $array[$i++];
        $odd[] = $array[$i++];
    }

    return array('even'=>$even, 'odd'=>$odd);
}

/**
 * тернанрый оператор
 */
function trn($val, $default){
    return !empty($val) ? $val : $default;
}

/*
 * загрузить UploadedFile файлы с созданием дополнительных директорий для уменьшения
 * кол-ва файлов в одной директории
 */
function uploadFileToMultipleDirs(
    \Symfony\Component\HttpFoundation\File\UploadedFile $file, $dir = "uploads", $simbols=2){

    // название файла
    $filename = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

    // создаем новую директорию, если нет старой
    $path = getMultiplePath($dir, $filename, $simbols);

    // путь к директории относительно public_path
    $fullpath = public_path($path);
    // перемещаем файл в нужную директорию
    $file->move($fullpath, $filename);

    //возвращаем полное название файла с относительным путем к нему для записи в бд например
    return $path . '/' . $filename;
}

function getMultiplePath($dir, $filename, $simbols) {

    $parts = array_slice(str_split($filename, $simbols), 0, $simbols);
    $path = $dir.'/'.implode('/', $parts);

    // создаем директории
    if ( !file_exists($path) ) @mkdir($path, 0777, true);

    return $path;
}

function removefile ($filename) {
    return @unlink( public_path($filename));
}

function getColumnArray(\Illuminate\Support\Collection $collection, $column = "id") {
    return $collection->lists("id")->all();
}

function localizedFormat ($date){
    Jenssegers\Date\Date::setLocale(\App::getLocale());

    $obLocDate = new Jenssegers\Date\Date($date);

    return $obLocDate;
}

// пока в требованиях нет возможности вести несколько поставщиков в одном аккаунте
function supplierId(){
    return Auth::user()->suppliers[0]->id;
}

function userId() {
    if (Auth::user()) return Auth::user()->id;
    return false;
}
function userField($field) {
    if (Auth::user()) return Auth::user()->$field;
    return false;
}

function roundPrice($price) {
    return round($price, 2);
}

function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function getCurrentLocation(){
    /**
     * geoLocation
     */
    $location = app()->make('App\Repo\Location\LocationInterface');
    return $location->getSessionLocation();
}