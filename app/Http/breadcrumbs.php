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