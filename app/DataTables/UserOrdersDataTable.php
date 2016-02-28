<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;
use Auth;
use App\Models\Order;

class UserOrdersDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('id', function($order) {

                return '<a target="_blank" href="">'.$order->id.'</a>';

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
        $orders = Order::where('user_id', '=', Auth::user()->id)->with('profile', 'supplier');

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
                'url' => route('userorders.datatables'),
            ])
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
            'supplier.name' => ['title' => 'Поставщик', 'orderable' => 'false'],
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
        return 'users';
    }
}
