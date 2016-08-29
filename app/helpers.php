<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.12.15
 * Time: 19:55
 */

//define ("ARRAY_FILTER_USE_BOTH", 1);
//define ("ARRAY_FILTER_USE_KEY", 2);

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

    return array_filter($array, function($v) {

        if (is_array($v)) return count($v);
        return strlen(trim($v));
    });
}

/**
 * @param $params - массив для query string
 *
 */
function url_add_params($params, $current = null){

    if (!$current) $current = URL::full();

    $params = array_filter($params);

    $query = implode('&', $params);
    if (stristr($current, '?')){
        return $current.'&'.$query;
    } else return $current.'?'.$query;
}

function url_set_params($params, $current = null){

    if (!$current) $current = URL::current();

    $params = array_filter($params);

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
        $e = $i++;
        if (isset($array[$e]))
            $even[] = $array[$e];
        $o = $i++;
        if (isset($array[$o]))
            $odd[] = $array[$o];
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

    if (!Auth::user()) return 0;

    Auth::user()->suppliers;

    if (Auth::user() && isset(Auth::user()->suppliers) && count(Auth::user()->suppliers)>0){
        return Auth::user()->suppliers[0]->id;
    }
    return 0;
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

function mb_ucfirst($string, $enc = 'UTF-8')
{
    return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
    mb_substr($string, 1, mb_strlen($string, $enc), $enc);
}

function getJSONbyUrl($url) {

    $handle = fopen($url, "rb");
    $contents = stream_get_contents($handle);
    fclose($handle);

    $data=json_decode($contents,true);

    if(count($data)<=0) return false;

    return $data;
}

function implode_assoc(array $array) {
    $str = '';
    $terms = count($array);
    foreach ($array as $field => $value)
    {
        $terms--;
        $str .= $field . '===>' . $value;
        if ($terms)
        {
            $str .= '|||';
        }
    }

    return $str;
}

function explode_assoc($str) {
    $assoc = array();
    $kvArr = explode('|||', $str);

    foreach ($kvArr as $v) {
        $vArr = explode('===>', $v);
        $assoc[$vArr[0]] = $vArr[1];
    }
    return $assoc;
}

function process_upload_file(\Symfony\Component\HttpFoundation\File\UploadedFile $file, $oldFile, $dir){

    if (is_null($file) || empty($file)) return;

    $imgFile = uploadFileToMultipleDirs( $file, $dir );
    if ($oldFile) removefile($oldFile);

    return $imgFile;
}

function number2string($number) {

    // обозначаем словарь в виде статической переменной функции, чтобы
    // при повторном использовании функции его не определять заново
    static $dic = array(

        // словарь необходимых чисел
        array(
            -2	=> 'две',
            -1	=> 'одна',
            1	=> 'один',
            2	=> 'два',
            3	=> 'три',
            4	=> 'четыре',
            5	=> 'пять',
            6	=> 'шесть',
            7	=> 'семь',
            8	=> 'восемь',
            9	=> 'девять',
            10	=> 'десять',
            11	=> 'одиннадцать',
            12	=> 'двенадцать',
            13	=> 'тринадцать',
            14	=> 'четырнадцать' ,
            15	=> 'пятнадцать',
            16	=> 'шестнадцать',
            17	=> 'семнадцать',
            18	=> 'восемнадцать',
            19	=> 'девятнадцать',
            20	=> 'двадцать',
            30	=> 'тридцать',
            40	=> 'сорок',
            50	=> 'пятьдесят',
            60	=> 'шестьдесят',
            70	=> 'семьдесят',
            80	=> 'восемьдесят',
            90	=> 'девяносто',
            100	=> 'сто',
            200	=> 'двести',
            300	=> 'триста',
            400	=> 'четыреста',
            500	=> 'пятьсот',
            600	=> 'шестьсот',
            700	=> 'семьсот',
            800	=> 'восемьсот',
            900	=> 'девятьсот'
        ),

        // словарь порядков со склонениями для плюрализации
        array(
            array('рубль', 'рубля', 'рублей'),
            array('тысяча', 'тысячи', 'тысяч'),
            array('миллион', 'миллиона', 'миллионов'),
            array('миллиард', 'миллиарда', 'миллиардов'),
            array('триллион', 'триллиона', 'триллионов'),
            array('квадриллион', 'квадриллиона', 'квадриллионов'),
            // квинтиллион, секстиллион и т.д.
        ),

        // карта плюрализации
        array(
            2, 0, 1, 1, 1, 2
        )
    );

    // обозначаем переменную в которую будем писать сгенерированный текст
    $string = array();

    // дополняем число нулями слева до количества цифр кратного трем,
    // например 1234, преобразуется в 001234
    $number = str_pad($number, ceil(strlen($number)/3)*3, 0, STR_PAD_LEFT);

    // разбиваем число на части из 3 цифр (порядки) и инвертируем порядок частей,
    // т.к. мы не знаем максимальный порядок числа и будем бежать снизу
    // единицы, тысячи, миллионы и т.д.
    $parts = array_reverse(str_split($number,3));

    // бежим по каждой части
    foreach($parts as $i=>$part) {

        // если часть не равна нулю, нам надо преобразовать ее в текст
        if($part>0) {

            // обозначаем переменную в которую будем писать составные числа для текущей части
            $digits = array();

            // если число треххзначное, запоминаем количество сотен
            if($part>99) {
                $digits[] = floor($part/100)*100;
            }

            // если последние 2 цифры не равны нулю, продолжаем искать составные числа
            // (данный блок прокомментирую при необходимости)
            if($mod1=$part%100) {
                $mod2 = $part%10;
                $flag = $i==1 && $mod1!=11 && $mod1!=12 && $mod2<3 ? -1 : 1;
                if($mod1<20 || !$mod2) {
                    $digits[] = $flag*$mod1;
                } else {
                    $digits[] = floor($mod1/10)*10;
                    $digits[] = $flag*$mod2;
                }
            }

            // берем последнее составное число, для плюрализации
            $last = abs(end($digits));

            // преобразуем все составные числа в слова
            foreach($digits as $j=>$digit) {
                $digits[$j] = $dic[0][$digit];
            }

            // добавляем обозначение порядка или валюту
            $digits[] = $dic[1][$i][(($last%=100)>4 && $last<20) ? 2 : $dic[2][min($last%10,5)]];

            // объединяем составные числа в единый текст и добавляем в переменную, которую вернет функция
            array_unshift($string, join(' ', $digits));
        }
    }

    // преобразуем переменную в текст и возвращаем из функции, ура!
    return join(' ', $string);
}
