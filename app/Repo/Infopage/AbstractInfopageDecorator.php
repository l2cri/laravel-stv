<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 17.11.15
 * Time: 15:12
 */

namespace App\Repo\Infopage;


class AbstractInfopageDecorator implements InfopageInterface
{
    protected $nextInfopage;

    public function __construct(InfopageInterface $infopage){
        $this->nextInfopage = $infopage;
    }

    /**
     * По умолчанию передаем выполение следующему объекту инфостраницы
     *
     * @param код $code
     */
    public function byCode($code){
        return $this->nextInfopage->byCode($code);
    }
}