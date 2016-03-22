<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 22.03.16
 * Time: 15:14
 */

if (AuthUser::isAdmin()) {
    Admin::model('App\Models\Status')
        ->title('Статусы заказов')
        ->display(function ()
        {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('color')->label('Цвет'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([
                FormItem::text('name', 'Название'),
                FormItem::text('color', 'Цвет'),
            ]);
            return $form;
        });
}