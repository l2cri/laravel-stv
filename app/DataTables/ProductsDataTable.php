<?php

namespace App\DataTables;

use App\Models\Product\Product;
use Yajra\Datatables\Services\DataTable;
use Auth;

class ProductsDataTable extends DataTable
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
            ->editColumn('name', function($product) {

                return '<a target="_blank" href="'.route('product.page', $product->id).'">'.$product->name.'</a>';

            })->editColumn('sections.name', function($product){

                $sections = $product->sections;

                $arr = array();
                foreach ($sections as $s) {
                    $arr [] = '<a href="'.url($s->url).'" target="_blank">'.$s->name.'</a>';
                }
                return implode('<br>', $arr);

            })
            ->addColumn('action', function($product){

                return '<a href="" title="Редактировать"><i class="fa fa-edit"></i></a>'.
                        ' <a href="" title="Удалить"><i class="fa fa-remove"></i></a>';
                
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
        $products = Product::where('supplier_id', '=', Auth::user()->suppliers[0]->id)->with('sections');

        return $this->applyScopes($products);
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
                    ->ajax(route('products.datatables'))
                    ->addAction(['width' => '50px', 'title' => 'Действие'])
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'lengthMenu' => [
                            [ 10, 25, 50, -1 ],
                            [ '10 товаров', '25 товаров', '50 товаров', 'Все' ]
                        ],
                        'buttons' => ['pageLength', 'csv', 'excel', 'print'],
                        'order'   => [[0, 'desc']],
                        'language' => [
                            'processing' => 'Загрузка',
                            'search' => 'Поиск',
                            'lengthMenu' => 'Показать _MENU_ товаров',
                            'info' => 'Товары с _START_ до _END_ из _TOTAL_ товаров',
                            'infoEmpty' => 'Товары с 0 до 0 из 0 товаров',
                            'infoFiltered' => '(отфильтровано из _MAX_ товаров)',
                            'infoPostFix' => '',
                            'loadingRecords' => 'Загрузка товаров...',
                            'zeroRecords' => 'Товары отсутствуют.',
                            'emptyTable' => 'В таблице отсутствуют данные',
                            'paginate' => [
                                'first' => '<<',
                                'previous' => '<',
                                'next' => '>',
                                'last' => '>>'
                            ],
                            'buttons' => [
                                'pageLength' => [
                                    '_' => 'Показать %d товаров',
                                    -1 => 'Все товары'
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
            'name' => ['title' => 'Название'],
            'created_at' => ['title' => 'Добавлен'],
            'sections.name' => ['title' => 'В категориях']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'products';
    }
}
