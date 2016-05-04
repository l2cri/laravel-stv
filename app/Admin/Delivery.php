<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.05.16
 * Time: 14:26
 */

if (AuthUser::isAdmin()) {
    Admin::model('App\Models\Delivery')
        ->title('Службы доставки')
        ->display(function ()
        {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('description')->label('Описание'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([
                FormItem::checkbox('active', 'Активная'),
                FormItem::text('name', 'Название'),
                FormItem::textarea('description', 'Описание'),
            ]);
            return $form;
        });
}