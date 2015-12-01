<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */

Admin::model('App\User')->title('Users')->display(function ()
{
	$display = AdminDisplay::table();
	$display->columns([
		Column::string('name')->label('Name'),
		Column::string('email')->label('Email'),
		Column::lists('roles.name'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('name', 'Name')->required(),
		FormItem::text('email', 'Email')->required()->unique(),
		FormItem::password('password', 'Password'),
		FormItem::multiselect('roles', 'Роли')->model('App\Models\Role')->display('name'),
	]);
	return $form;
});