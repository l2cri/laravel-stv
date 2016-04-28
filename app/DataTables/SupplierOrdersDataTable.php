<?php

namespace App\DataTables;

use App\Models\Order;
use App\User;
use Yajra\Datatables\Services\DataTable;
use Auth;

class SupplierOrdersDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $messageRepo = app()->make('App\Repo\Message\MessageInterface');

        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('id', function($order) {

                return '<a target="_blank" href="'.route('panel::ordersupplier.page', $order->id).'">'.$order->id. '</a>';

            })
            ->editColumn('status', function($order) {

                if ($order->returned) return 'ВОЗВРАТ';

                if ($order->status) return '<span style="color:'.$order->status->color.'">'.$order->status->name.'</span>';

            })
            ->editColumn('profile.person', function($order) use ($messageRepo){

                $newMessageCount = $messageRepo->supplierNew($order->id);
                $label = '';
                if ( !empty( count($newMessageCount) ) ) {
                    $label = '<span class="menu-label blue">'.count($newMessageCount).'</span>';
                    return $order->profile->person.$label;
                }

                return $order->profile->person;

            })
            ->addColumn('action', function($order){

                return '<a href="'.route('panel::order.edit', $order->id).'" title="Редактировать"><i class="fa fa-edit"></i></a>'.
                ' <a href="'.route('panel::order.delete', $order->id).'" title="Удалить"><i class="fa fa-remove"></i></a>';

            })
            ->setRowClass(function ($order) {
                if ($order->returned) return 'oderReturn';
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $orders = Order::where('supplier_id', '=', supplierId())->with('profile');

        return $this->applyScopes($orders);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax( [
                'url' => route('orders.datatables'),
            ])
            ->addAction(['width' => '50px', 'title' => 'Действие'])
            ->parameters([
                'dom' => 'Bfrtip',
                'lengthMenu' => [
                    [ 10, 25, 50, -1 ],
                    [ '10 заказов', '25 заказов', '50 заказов', 'Все' ]
                ],
                'buttons' => ['pageLength', 'csv', 'excel', 'print'],
                'order'   => [[0, 'desc']],
                'language' => [
                    'processing' => 'Загрузка',
                    'search' => 'Поиск',
                    'lengthMenu' => 'Показать _MENU_ товаров',
                    'info' => 'Товары с _START_ до _END_ из _TOTAL_ товаров',
                    'infoEmpty' => 'Заказы с 0 до 0 из 0 заказов',
                    'infoFiltered' => '(отфильтровано из _MAX_ товаров)',
                    'infoPostFix' => '',
                    'loadingRecords' => 'Загрузка товаров...',
                    'zeroRecords' => 'Заказы отсутствуют.',
                    'emptyTable' => 'В таблице отсутствуют данные',
                    'paginate' => [
                        'first' => '<<',
                        'previous' => '<',
                        'next' => '>',
                        'last' => '>>'
                    ],
                    'buttons' => [
                        'pageLength' => [
                            '_' => 'Показать %d заказов',
                            -1 => 'Все заказы'
                        ],
                        'print' => 'Печать'
                    ]
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id',
            'status' => ['title' => 'Статус', 'orderable' => 'false'],
            'profile.person' => ['title' => 'Клиент', 'orderable' => 'false'],
            'profile.phone' => ['title' => 'Телефон', 'orderable' => 'false'],
            'total' => ['title' => 'Сумма'],
            'created_at' => ['title' => 'Добавлен'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'orders';
    }
}
