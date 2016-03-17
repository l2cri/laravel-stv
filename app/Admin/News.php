<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 16.03.2016
 * Time: 18:36
 */

Admin::model('App\Models\News')
    ->title('Новости')
    ->display(function ()
    {
        $display = AdminDisplay::datatables();
        $display->order([[0, 'desc']]);
        $display->columns([
            Column::string('id')->label('ID'),
            Column::string('name')->label('Название'),
            Column::image('image'),
            Column::string('created_at')->label('Создано'),
        ]);
        return $display;
    })->createAndEdit(function ()
    {
        $form = AdminForm::form();
        $form->items([
            FormItem::date('created_at','Дата создания'),
            FormItem::text('name', 'Название'),
            FormItem::image('image', 'Картинка'),
            FormItem::ckeditor('text', 'Описание'),
        ]);
        return $form;
    });