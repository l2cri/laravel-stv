<?php

namespace App\DataTables;

use App\Models\Faq;
use Yajra\Datatables\Services\DataTable;
use Auth;

class FaqProductsDataTable extends DataTable
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
            ->editColumn('moderated', function($faq) {

                $checkClass = ($faq->moderated == 1)?'check-square-o':'square-o';

                return '<i class="fa fa-'.$checkClass.'"></i>';

            })
            ->editColumn('product.name',function($faq){
                return '<a target="_blank" href="'.route('product.page',['id'=>$faq->product->id]).'">'.$faq->product->name.'</a>';
            })
            ->addColumn('action', function($faq){

                return '<a href="'.route('panel::faq.edit', $faq->id).'" title="Редактировать"><i class="fa fa-edit"></i></a>'.
                ' <a href="'.route('panel::faq.delete', $faq->id).'" title="Удалить"><i class="fa fa-remove"></i></a>';

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

        $supplierId =  supplierId();

        $faq = Faq::whereIn('product_id',function($q)use ($supplierId){
            $q->select('id')
                ->from('products')
                ->where('supplier_id', $supplierId);
        })->with('user','product');

        return $this->applyScopes($faq);
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
                'url' => route('faq.datatables'),
            ])
            ->addAction(['width' => '50px', 'title' => 'Действия'])
            ->parameters([
                'dom' => 'Bfrtip',
                'lengthMenu' => [
                    [ 10, 25, 50, -1 ],
                    [ '10 вопросов', '25 вопросов', '50 вопросов', 'Все' ]
                ],
                'buttons' => ['pageLength', 'csv', 'excel', 'print'],
                'order'   => [[0, 'desc']],
                'language' => [
                    'processing' => 'Загрузка',
                    'search' => 'Поиск',
                    'lengthMenu' => 'Показать _MENU_ вопросов',
                    'info' => 'Вопросы с _START_ до _END_ из _TOTAL_ вопросов',
                    'infoEmpty' => 'Заказы с 0 до 0 из 0 вопросов',
                    'infoFiltered' => '(отфильтровано из _MAX_ вопросов)',
                    'infoPostFix' => '',
                    'loadingRecords' => 'Загрузка вопросов...',
                    'zeroRecords' => 'Вопросы отсутствуют.',
                    'emptyTable' => 'В таблице отсутствуют данные',
                    'paginate' => [
                        'first' => '<<',
                        'previous' => '<',
                        'next' => '>',
                        'last' => '>>'
                    ],
                    'buttons' => [
                        'pageLength' => [
                            '_' => 'Показать %d вопросов',
                            -1 => 'Все вопросы'
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
            'moderated' => ['title' => 'Модерирован'],
            'question'=> ['title' => 'Вопрос'],
            'answer'=> ['title' => 'Ответ'],
            'product.name'=> ['title' => 'Товар'],
            'user.name' => ['title' => 'Клиент'],
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
        return 'faq';
    }
}