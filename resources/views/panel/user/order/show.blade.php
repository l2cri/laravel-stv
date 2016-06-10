@extends('panel.index')
@section('breadcrumbs', Breadcrumbs::render('common.order-sub','Заказ № '.$order->id,route('userorders.datatables')))
@section('panel_content')

    <div class="row information-blocks sections-panel article-container style-2">
        <div class="col-md-12">

            <h1>Заказ № {{ $order->id }}
                @if($order->returned)<span class="pull-right left20">ВОЗВРАТ</span>@endif
                <span class="pull-right" style="color: {{ @$order->status->color }}">{{ @$order->status->name }}</span></h1>

            <table class="table table-striped panel">
                <tr>
                    <th>Итого</th>
                    <td>{{ $order->subtotal }} <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Итого со скидками</th>
                    <td>{{ $order->total }} <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Доставка</th>
                    <td>@include('order.conditions', ['order' => $order])</td>
                </tr>
                <tr>
                    <th>Комментарий</th>
                    <td>{{ $order->comment }}</td>
                </tr>
            </table>

            @include('order.pvz', ['order' => $order])

            <h1>{{ $order->profile->person }} <span class="small">({{ $order->profile->name }})</span></h1>

            <table class="table table-striped panel">
                <tr>
                    <th>Телефон</th>
                    <td>{{ $order->profile->phone }}</td>
                </tr>
                <tr>
                    <th>Адрес</th>
                    <td>{{ $order->profile->address }}</td>
                </tr>
            </table>

            @if ($order->profile->company)
                @include('panel.common.companyshow', [ 'company' =>  $order->profile->company ])
            @endif

            <h1>Корзина</h1>

            <div class="table-responsive">
                <table class="cart-table">
                    <tr>
                        <th class="column-1">Название</th>
                        <th class="column-2">Цена</th>
                        <th class="column-3">Кол-во</th>
                        <th class="column-4">Всего</th>
                    </tr>

                    @foreach($order->cartItems as $item)

                        <? $item->attributes = unserialize($item->attributes) ?>
                        <?$conditions = \App\StaticHelpers\CartHelper::getConditions($item);?>

                        <tr>
                            <td>
                                <div class="traditional-cart-entry">
                                    <a href="{{ route('product.page', $item->id) }}" class="image"><img src="{{ @url($item->attributes['file']) }}" alt=""></a>
                                    <div class="content">
                                        <div class="cell-view">
                                            <a href="{{ url($item->attributes['section_url']) }}" class="tag">
                                                {{ $item->attributes['section_name'] }}</a>
                                            <a href="{{ route('product.page', $item->id) }}" class="title">{{ $item->name }}
                                                @foreach($conditions as $conditionName)
                                                    <span class="inline-label red">{{ $conditionName }}</span>
                                                @endforeach
                                            </a>
                                            {{--<div class="inline-description">S / Dirty Pink</div>--}}
                                            <div class="inline-description">{{ $item->attributes['supplier_name'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->final_price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td><div class="subtotal">{{ $item->total }}</div></td>
                        </tr>

                    @endforeach

                </table>
            </div>

            <br>
            <br>

            <h1>Сообщения</h1>

            @foreach($order->messages as $message)

                <div class="blog-entry">
                    <div class="comment">
                        <div class="comment-content">
                            <div class="comment-title"><span>{{ $message->user->name }}</span>  {{ localizedFormat($message->created_at)->format('l j F Y H:i') }}</div>
                            <div class="comment-text">{{ $message->text }}</div>
                        </div>
                    </div>
                </div>

            @endforeach

            <br>

            <form method="post" action="{{ route('panel::order.saveUserMessage') }}">

                {{ csrf_field() }}

                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <label>Текст <span>*</span></label>
                <textarea class="simple-field" placeholder="" aria-autocomplete="off" name="text"></textarea>
                <div class="button style-10">Отправить<input type="submit" value="" /></div>
            </form>
        </div>
    </div>

@endsection