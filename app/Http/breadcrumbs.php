<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('home'));
});

// News
Breadcrumbs::register('news', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Новости', route('news.index'));
});

// News > detail
Breadcrumbs::register('news-detail', function($breadcrumbs,$post)
{
    $breadcrumbs->parent('news');
    $breadcrumbs->push($post->name, route('news.detail',['id'=>$post->id]));
});

// Infopage
Breadcrumbs::register('infopage', function($breadcrumbs,$infopage)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($infopage->name, route('infopage',['id'=>$infopage->code]));
});

// Section
Breadcrumbs::register('section', function($breadcrumbs,$section)
{

    $breadcrumbs->parent('home');
    $sections = $section->getAncestors();

    foreach ($sections as $s) {
        $breadcrumbs->push($s->name, url($s->url) );
    }
    $breadcrumbs->push($section->name, url($section->url) );
});

// Section > Product
Breadcrumbs::register('product', function($breadcrumbs,$product,$section)
{

    $breadcrumbs->parent('section',$section);
    $breadcrumbs->push($product->name, route('product.page',['id'=>$product->id]));
});

// Supplier main
Breadcrumbs::register('supplier', function($breadcrumbs,$supplier,$currentSection)
{
    $breadcrumbs->parent('home');

    $breadcrumbs->push($supplier->name, route('supplier', $supplier->code) );

    if(isset($currentSection)){
        $breadcrumbs->push($currentSection->name, route('supplier',['code'=>$currentSection->id,'name'=>$supplier->code]));
    }
});

// Static Supplier
Breadcrumbs::register('supplier-static', function($breadcrumbs,$supplier,$name, $url = null)
{
    $breadcrumbs->parent('supplier',$supplier,null);

    $breadcrumbs->push($name, $url );
});


// Static 1 root
Breadcrumbs::register('common.static', function($breadcrumbs,$name, $url = null)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($name, $url );

});

// Static 2 root
Breadcrumbs::register('common.static-sub', function($breadcrumbs,$parent,$name, $url = null)
{
    $breadcrumbs->parent('common.static',$parent['name'],$parent['url']);
    $breadcrumbs->push($name, $url );

});

// Static panel
Breadcrumbs::register('common.panel-sub', function($breadcrumbs,$name, $url = null)
{
    $breadcrumbs->parent('common.static','Панель управления',route('panel::panel.index'));
    $breadcrumbs->push($name, $url );

});
// Static order
Breadcrumbs::register('common.order-sub', function($breadcrumbs,$name, $url = null)
{
    $breadcrumbs->parent('common.panel-sub','Заказы',$url);
    $breadcrumbs->push($name, $url );

});

Breadcrumbs::register('edit-faq', function($breadcrumbs,$name)
{
    $breadcrumbs->parent('common.static','Панель управления',route('panel::panel.index'));
    $breadcrumbs->push('Вопросы', route('panel::faq.list'));
    $breadcrumbs->push($name);

});

Breadcrumbs::register('edit-product', function($breadcrumbs,$name)
{
    $breadcrumbs->parent('common.static','Панель управления',route('panel::panel.index'));
    $breadcrumbs->push('Товары', route('panel::products'));
    $breadcrumbs->push($name);

});