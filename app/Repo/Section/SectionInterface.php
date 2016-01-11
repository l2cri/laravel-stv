<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 15:19
 */

namespace App\Repo\Section;


interface SectionInterface
{
    public function byId($id);
    public function byCode($code);
    public function create(array $data);
    public function delete($id);

    /**
     * @param $id
     * @return mixed Массив с родителями - то есть путь до этой категории
     */
    public function getPath($id);

    /**
     * @param $id, если $id пусто, то возвращаем дерево целиком
     * @return mixed Массив с деревом потомков
     */
    public function getTree($id = null);

    /**
     * @param $supplierId - айди поставщика
     * @return mixed Массив категорий, в которых есть товары данного поставщика
     * Для использования в панели Поставщика, в его Магазине
     */
    public function bySupplier($supplierId);

    /**
     * @param $userId - ID пользователя
     * @return mixed - Массив категорий, добавленных этим пользователем. Для панели Поставщика
     */
    public function byUser($userId);
}