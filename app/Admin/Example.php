<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 16.11.15
 * Time: 11:37
 */

Admin::model('App\Example')->title('Example')->display(function ()
{
    $display = AdminDisplay::table();
    $display->columns([
        Column::string('name')->label('Name'),
        Column::string('text')->label('Text'),
    ]);
    return $display;
})->createAndEdit(function ()
{
    $form = AdminForm::form();
    $form->items([
        FormItem::text('name', 'Name')->required(),
        FormItem::text('text', 'Text')->required(),
    ]);
    return $form;
});