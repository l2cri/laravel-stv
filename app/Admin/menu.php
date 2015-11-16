<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu()->url('users')->label("User's list")->icon('fa-user');
Admin::menu()->url('examples')->label("Examples db list")->icon('fa-th-list');
Admin::menu('App\Model\Infopage')->icon('fa-info-circle')->label('Информация');