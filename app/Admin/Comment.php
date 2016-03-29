<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 29.03.2016
 * Time: 15:02
 */
Admin::model('App\Models\Comment')
    ->title('Комментарии')
    ->display(function () {
        $display = AdminDisplay::datatables();
        $display->order([[0, 'desc']]);
        $display->columns([
            Column::string('id')->label('ID'),
            Column::custom()->label('Проверенная')->callback(function ($instance)
            {
                return $instance->moderated ? '&check;' : '-';
            }),
            Column::string('created_at')->label('Создано'),
            Column::custom()->label('Пользователь')->callback(function($instance){
                if($instance->user())
                    return $instance->user->name;
            }),
            Column::custom()->label('Тип')->callback(function($instance){
                return class_basename($instance->commentable_type);
            }),
            Column::custom()->label('Элемент')->callback(function($instance){

                if($instance->commentable_type == 'App\Models\Product\Product'){
                    return '<a target="_blank" href="'.route('product.page',['id'=>$instance->commentable_id]).'">'.$instance->commentable->name.'</a>';
                }
            })
        ]);
        return $display;
    })->createAndEdit(function () {
        $form = AdminForm::form();
        $form->items([
            FormItem::checkbox('moderated','Проверенный'),
            FormItem::textarea('text', 'Описание')->required(),
            FormItem::select('user_id','Пользователь')->model('\App\User')->display('name')->required()->defaultValue(Auth::user()->id),
            FormItem::select('commentable_type','Тип')->options(['App\Models\Product\Product' => 'Продукты'])->required()->defaultValue('App\Models\Product\Product'),
            FormItem::select('commentable_id','Элемент')->model('App\Models\Product\Product')->display('name')->required()
        ]);
        return $form;
    });