<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.04.16
 * Time: 15:53
 */

if (AuthUser::isAdmin()) {
    Admin::model('App\Models\Location')
        ->title('Локации')
        ->display(function ()
        {
            $display = AdminDisplay::datatablesAsync();
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('shortname')->label('Обозначение'),
                Column::string('path')->label('Регион'),
                Column::string('level')->label('Уровень'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([

                FormItem::text('name', 'Название'),
                FormItem::text('parent_id', 'ID родительской локации'),
                FormItem::text('regioncode', 'Код региона'),
                FormItem::text('level', 'Уроверь субъекта'),
                FormItem::text('shortname', 'Обозначение'),

            ]);
            return $form;
        });
}