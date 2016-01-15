<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.12.15
 * Time: 17:49
 */

if (AuthUser::can('section_admin')) {

    Admin::model('App\Models\Section')
        ->title('Категории')
        ->display(function ()
        {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([

                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('code')->label('Код в URL'),
                Column::string('parent.name')->label('Родительская'),
                Column::image('icon'),
                Column::custom()->label('Активная')->callback(function ($instance)
                {
                    return $instance->active ? '&check;' : '-';
                }),
                Column::custom()->label('Проверенная')->callback(function ($instance)
                {
                    return $instance->moderated ? '&check;' : '-';
                }),

            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([
                FormItem::text('name', 'Название'),
                FormItem::text('code', 'Код в URL'),
                FormItem::checkbox('active', 'Активная'),
                FormItem::checkbox('moderated', 'Проверенная'),
                FormItem::select('parent_id', 'Родительская')->model('\App\Models\Section')->display('name')->nullable(),
                FormItem::image('icon', 'Иконка'),
                FormItem::ckeditor('description', 'Описание'),
            ]);
            return $form;
        });
}