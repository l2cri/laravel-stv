<?
    $company = $order->supplier->company;
    $companyClient = $order->profile->company;
    $supplier = $order->supplier;
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Бланк "Счет на оплату"</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; margin-left: auto; margin-right: auto; border: 1px #efefef solid; font-size: 8pt;}
        table.invoice_bank_rekv { border-collapse: collapse; border: 1px solid; }
        table.invoice_bank_rekv > tbody > tr > td, table.invoice_bank_rekv > tr > td { border: 1px solid; }
        table.invoice_items { border: 1px solid; border-collapse: collapse;}
        table.invoice_items td, table.invoice_items th { border: 1px solid;}
    </style>
</head>
<body>

<img src="{{ public_path($supplier->logo) }}">
</br>
</br>

<table cellpadding="2" cellspacing="2" class="invoice_bank_rekv" style="width: 1190px;">
    <tr>
        <td colspan="2" rowspan="2" style="min-height:50px; width: 50%;">
            <table border="0" cellpadding="0" cellspacing="0" style="height: 50px;">
                <tr>
                    <td valign="top">
                        <div>{{ $company->bank }}</div>
                    </td>
                </tr>
                <tr>
                    <td valign="bottom" style="height: 11px;">
                        <div style="font-size:9pt;">Банк получателя        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td style="min-height: 26px;height:auto; width: 94px;">
            <div>БИK</div>
        </td>
        <td rowspan="2" style="vertical-align: top; width: 227px;">
            <div style=" height: 27px; line-height: 27px; vertical-align: middle;">{{ $company->bik }}</div>
            <div>{{ $company->ks }}</div>
        </td>
    </tr>
    <tr>
        <td style="width: 95px;">
            <div>Сч. №</div>
        </td>
    </tr>
    <tr>
        <td style="min-height: 23px; height:auto; width: 150px">
            <div>ИНН {{ $company->inn }}</div>
        </td>
        <td style="min-height:23px; height:auto; width: 50%">
            <div>КПП {{ $company->kpp }}</div>
        </td>
        <td rowspan="2" style="min-height:72px; height:auto; vertical-align: top; width: 95px;">
            <div>Сч. №</div>
        </td>
        <td rowspan="2" style="min-height: 72px; height:auto; vertical-align: top; width: 227px;">
            <div>{{ $company->rs }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="min-height:50px; height:auto; width: 50%">

            <table border="0" cellpadding="0" cellspacing="0" style="height: 50px;">
                <tr>
                    <td valign="top">
                        <div>{{ $company->name }}</div>
                    </td>
                </tr>
                <tr>
                    <td valign="bottom" style="height: 12px;">
                        <div style="font-size: 10pt;">Получатель</div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
<br/>

<? $date = localizedFormat($order->created_at) ?>

<div style="font-weight: bold; font-size: 16pt; padding-left:5px;">
    Счет № {{ $order->id }} от {{ mb_convert_case($date->format('d F Y'), MB_CASE_TITLE, "UTF-8") }}</div>
<br/>

<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>

<table width="100%">
    <tr>
        <td style="width: 114px;">
            <div style=" padding-left:2px;">Поставщик:    </div>
        </td>
        <td>
            <div style="font-weight:bold;  padding-left:2px;">
                {{ $company->name }}, ИНН {{ $company->inn }}, КПП {{ $company->kpp }}, {{ $company->law_address }}
            </div>
        </td>
    </tr>
    <tr>
        <td style="width: 114px;">
            <div style=" padding-left:2px;">Покупатель:    </div>
        </td>
        <td>
            <div style="font-weight:bold;  padding-left:2px;">
                {{ $companyClient->name }}, ИНН {{ $companyClient->inn }}, КПП {{ $companyClient->kpp }}, {{ $companyClient->law_address }}
            </div>
        </td>
    </tr>
</table>

<table class="invoice_items" width="100%" cellpadding="2" cellspacing="2">
    <thead>
    <tr>
        <th style="width:50px;">№</th>
        <th style="width:76px;">Код</th>
        <th>Товар</th>
        <th style="width:76px;">Кол-во</th>
        <th style="width:65px;">Ед.</th>
        <th style="width:103px;">Цена</th>
        <th style="width:103px;">Сумма</th>
    </tr>
    </thead>
    <tbody >

    <? $i = 1; $orderQuantity = 0; ?>
    @foreach($order->cartItems as $item)

        <tr>
            <td align="center">{{ $i }}</td>
            <td align="left">{{ $item->product_id }}</td>
            <td align="left">{{ $item->name }}</td>
            <td align="right">{{ $item->quantity }}</td>
            <td align="left">{{ @$item->product->unit }}</td>
            <td align="right">{{ $item->final_price }}</td>
            <td align="right">{{ $item->total }}</td>
        </tr>
        <? $i++; $orderQuantity += $item->quantity; ?>
    @endforeach

    </tbody>
</table>

<table border="0" width="100%" cellpadding="1" cellspacing="1">
    <tr>
        <td>&nbsp;</td>
        <td style="width:103px; font-weight:bold;  text-align:right;">Итого:</td>
        <td style="width:103px; font-weight:bold;  text-align:right;">{{ $order->total }}</td>
    </tr>

    <? $total = 0; ?>
    @if($company->nds)
        <? $total = roundPrice(0.18 * $order->total) + $order->total; ?>
        <tr>
            <td colspan="2" style="font-weight:bold;  text-align:right;">В том числе НДС:</td>
            <td style="width:103px; font-weight:bold;  text-align:right;">{{ roundPrice(0.18 * $order->total) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight:bold;  text-align:right;">Всего к оплате:</td>
            <td style="width:103px; font-weight:bold;  text-align:right;">{{ $total }}</td>
        </tr>
    @else
        <? $total = $order->total; ?>
        <tr>
            <td colspan="2" style="font-weight:bold;  text-align:right;">Без налога (НДС):</td>
            <td style="width:103px; font-weight:bold;  text-align:right;"></td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight:bold;  text-align:right;">Всего к оплате:</td>
            <td style="width:103px; font-weight:bold;  text-align:right;">{{ $total }}</td>
        </tr>
    @endif
</table>

<br />

<?
$intpart = floor($total);    // results in 3
$fraction = $total - $intpart // results in 0.75
?>
<div>
    Всего наименований {{ $orderQuantity }} на сумму {{ $order->total }} рублей.<br />
    {{ mb_ucfirst(number2string($intpart)) }} {{ str_replace('0.', '', $fraction) }} копеек</div>
<br /><br />
<div style="background-color:#000000; width:100%; font-size:1px; height:2px;">&nbsp;</div>
<br/>

<img src="{{ public_path($company->stamp) }}" width="500">

@if( !empty($company->invoice_days) )
    <div style="width:800px;text-align:left;font-size:10pt;">Счет действителен к оплате в течении {{ $company->invoice_days }} дней.</div>
@endif
</body>
</html>