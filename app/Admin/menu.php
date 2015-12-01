<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu()->url('users')->label("User's list")->icon('fa-user');
Admin::menu()->url('examples')->label("Examples db list")->icon('fa-th-list');

if (AuthUser::can('infopage_admin')) {
    Admin::menu('App\Model\Infopage')->icon('fa-info-circle')->label('Информация');
}

/*
 * может редактировать только админ
 */
if (AuthUser::isAdmin()){
    Admin::menu('App\Model\Role')->icon('fa-info-circle')->label('Роли');
    Admin::menu('App\Model\Ability')->icon('fa-info-circle')->label('Возможности');
}