<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 30.11.15
 * Time: 11:00
 */

/*
 * Роли может редактировать только Администратор
 */

if (AuthUser::isAdmin()) {
    Admin::model('App\Models\Role')
        ->title('Роли')
        ->display(function ()
        {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::lists('abilities.action'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([
                FormItem::text('name', 'Название'),
                FormItem::multiselect('abilities', 'Возможности')->model('App\Models\Ability')->display('name')
            ]);
            return $form;
        });
}