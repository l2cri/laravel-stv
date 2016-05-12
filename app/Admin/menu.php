<?php

Admin::menu()->url('/')->label('Главная')->icon('fa-dashboard');

/*
 * может редактировать только админ
 */
if (AuthUser::isAdmin()){
    Admin::menu()->url('users')->label("Пользователи")->icon('fa-user');
    Admin::menu('App\Model\Role')->icon('fa-male')->label('Роли');
    Admin::menu('App\Model\Ability')->icon('fa-unlock')->label('Возможности');
    Admin::menu('App\Model\Status')->icon('fa-shopping-cart')->label('Статусы заказов');
    Admin::menu('App\Model\Location')->icon('fa-location-arrow')->label('Локации');
    Admin::menu('App\Model\Delivery')->icon('fa-truck')->label('Службы доставки');
    Admin::menu('App\Model\Payment')->icon('fa-credit-card')->label('Службы оплаты');
}

if (AuthUser::can('supplier_admin')) {
    Admin::menu('App\Model\Supplier')->icon('fa-users')->label('Поставщики');
}

if (AuthUser::can('infopage_admin')) {
    Admin::menu('App\Models\Infopage')->icon('fa-info-circle')->label('Информация');
}

if (AuthUser::can('section_admin')) {
    Admin::menu('App\Model\Section')->icon('fa-folder')->label('Категории');
}

if (AuthUser::can('news_admin'))
    Admin::menu('App\Model\News')->icon('fa-list-alt')->label("Новости");

if (AuthUser::can('banners_admin')) {
    Admin::menu('App\Model\Banner')->icon('fa-picture-o')->label('Баннеры');
}
