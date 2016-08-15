<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.12.15
 * Time: 16:51
 */

if (AuthUser::can('supplier_admin')) {
    Admin::model('App\Models\Supplier')
        ->title('Поставщики')
        ->display(function ()
        {
            $display = AdminDisplay::datatables();
            $display->order([[0, 'desc']]);
            $display->columns([
                Column::string('id')->label('ID'),
                Column::string('name')->label('Название'),
                Column::string('code')->label('Код никнэйм'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([

                // TODO: на будущее переделать на поиск по фио автокомплитом и выбор айдишника - как в битриксе
                FormItem::select('user_id', 'Пользователь')->model('App\User')->display('name'),
                FormItem::image('logo', 'Логотип для каталога'),
                FormItem::image('logo_store', 'Логотип магазина'),
                FormItem::text('color', 'Цвет шаблона'),
                FormItem::text('name', 'Название'),
                FormItem::text('code', 'Код никнэйм'),
                FormItem::ckeditor('description', 'Описание'),
                FormItem::ckeditor('conditions', 'Оплата и Доставка'),
                FormItem::ckeditor('responsibility', 'Гарантии'),
                FormItem::text('whosale_order', 'Оптовый заказ от (руб)'),
                FormItem::text('whosale_quantity', 'Кол-во товара для оптовой цены'),

            ]);
            return $form;
        });
}