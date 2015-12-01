<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.12.15
 * Time: 12:37
 */

if (AuthUser::isAdmin()) {
    Admin::model('App\Models\Ability')
        ->title('Роли')
        ->display(function ()
        {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('action')->label('Действие'),
                Column::string('description')->label('Описание'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([
                FormItem::text('name', 'Название'),
                FormItem::text('action', 'Действие'),
                FormItem::text('description', 'Описание'),
            ]);
            return $form;
        });
}