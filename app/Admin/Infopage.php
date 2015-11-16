<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 16.11.15
 * Time: 21:26
 */

Admin::model('App\Models\Infopage')
    ->title('Информационные страницы')
    ->display(function ()
    {
        $display = AdminDisplay::datatables();
        $display->order([[0, 'desc']]);
        $display->columns([
            Column::string('id')->label('ID'),
            Column::string('name')->label('Название'),
            Column::string('code')->label('Код в URL'),
        ]);
        return $display;
    })->createAndEdit(function ()
    {
        $form = AdminForm::form();
        $form->items([
            FormItem::text('name', 'Название'),
            FormItem::text('code', 'Код в URL'),
            FormItem::ckeditor('text', 'Описание'),
        ]);
        return $form;
    });