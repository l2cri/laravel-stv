<?php
return [
    'cacheTime' => 60, // время кеширования по-умолчанию в минутах
    'cachePrefixInfopage' => 'infopage',
    'cacheStoreNews' => 'filenews',

    // id корневых категорий Промышленная и Потребительская
    'promSectionId' => env('SECTION_PROM', 3),
    'potrebSectionId' => env('SECTION_POTREB', 1),

    // товар
    'productPhotoDir' => 'images/products',
    'perpage' => 12,
    'unit' => 'шт',
    'commentsPerPage' => 7,
    'recommedates_count' => 3,

    'client_role_id' => 1,

    // поставщик
    'supplierDir' => 'images/supplier',

    // локации
    'locationLevel' =>3,

    // email-уведомления
    'email' => 'info@buy26.ru',
    'emailOrderNew' => 'BUY26.RU: новый заказ!',
    'emailOrderReturned' => 'BUY26.RU: возврат заказа!',
    'emailOrderStatusChanged' => 'BUY26.RU: новый статус заказа - ',
    'emailUserRegistered' => 'BUY26.RU: спасибо за регистрацию!',

    // boxberry
    'boxberry_token' => '16630.pbpqceaf',
    'boxberry_courier' => 'Курьерская доставка Boxberry',
    'boxberry_weight' => 500,
    'nodelivery_id' => 3,

    // директория для загрузки счетов
    'invoices' => 'storage/invoices',

    // директория для загрузки файлов компании - печать, подписи
    'company_dir' => 'storage/company',
];