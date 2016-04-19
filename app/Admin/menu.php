<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu()->url('users')->label("User's list")->icon('fa-user');
Admin::menu()->url('examples')->label("Examples db list")->icon('fa-th-list');

if (AuthUser::can('infopage_admin')) {
    Admin::menu('App\Models\Infopage')->icon('fa-info-circle')->label('Информация');
}

if (AuthUser::can('section_admin')) {
    Admin::menu('App\Model\Section')->icon('fa-folder')->label('Категории');
}

/*
 * может редактировать только админ
 */
if (AuthUser::isAdmin()){
    Admin::menu('App\Model\Supplier')->icon('fa-users')->label('Поставщики');
    Admin::menu('App\Model\Role')->icon('fa-male')->label('Роли');
    Admin::menu('App\Model\Ability')->icon('fa-unlock')->label('Возможности');
    Admin::menu('App\Model\Status')->icon('fa-shopping-cart')->label('Статусы заказов');
    Admin::menu('App\Model\Location')->icon('fa-location-arrow')->label('Локации');
}

if (AuthUser::can('news_admin'))
    Admin::menu('App\Model\News')->icon('fa-list-alt')->label("Новости");

if (AuthUser::can('banners_admin')) {
    Admin::menu('App\Model\Banner')->icon('fa-picture-o')->label('Баннеры');
}
