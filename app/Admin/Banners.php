<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 19.04.16
 * Time: 13:56
 */

if (AuthUser::can('banners_admin')) {
    Admin::model('App\Models\Banner')
        ->title('Баннеры')
        ->display(function () {
            $display = AdminDisplay::datatables();
            $display->order([['sort', 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('type')->label('Тип'),
                Column::image('image')->label('Картинка'),
                Column::string('url')->label('Ссылка'),
                Column::string('sort')->label('Сортировка'),
                Column::string('created_at')->label('Создано'),
            ]);
            return $display;
        })->createAndEdit(function () {
            $form = AdminForm::form();
            $form->items([
                FormItem::text('name', 'Название'),
                FormItem::text('type', 'Тип'),
                FormItem::text('sort', 'Сортировка')->defaultValue(500),
                FormItem::image('image', 'Картинка')->required(),
                FormItem::text('url',"Ссылка"),
            ]);
            return $form;
        });
}