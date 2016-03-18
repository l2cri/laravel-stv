<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 16.03.2016
 * Time: 18:36
 */

if (AuthUser::can('news_admin')) {
    Admin::model('App\Models\News')
        ->title('Новости')
        ->display(function () {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::image('image')->label('Картинка'),
                Column::string('created_at')->label('Создано'),
            ]);
            return $display;
        })->createAndEdit(function () {
            $form = AdminForm::form();
            $form->items([
                FormItem::timestamp('created_at', 'Дата создания')
                    ->required()
                    ->defaultValue(Carbon\Carbon::now()->toDateTimeString()),
                FormItem::text('name', 'Название')->required()->unique(),
                FormItem::image('image', 'Картинка'),
                FormItem::ckeditor('text', 'Описание')->required(),
            ]);
            return $form;
        });
}