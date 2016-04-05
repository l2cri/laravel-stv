<?php

namespace App\DataTables;

use App\Models\Comment;
use Yajra\Datatables\Services\DataTable;
use Auth;

class CommentsProductsDataTable extends DataTable
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
            ->editColumn('moderated', function($comment) {

                $modareted = $comment->moderated == 1;

                $checkClass = ($modareted)?'check-square-o':'square-o';

                $title = ($modareted)?'Деактивировать':'Активировать';

                return '<a href="'.route('panel::comment.toggle', $comment->id).'" title="'.$title.'"><i class="fa fa-'.$checkClass.'"></i></a>';

            })
            ->editColumn('commentable.name',function($comment){
                return '<a target="_blank" href="'.route('product.page',['id'=>$comment->commentable->id]).'">'.$comment->commentable->name.'</a>';
            })
            ->addColumn('action', function($comment){

                return '<a href="'.route('panel::comment.delete', $comment->id).'" title="Удалить"><i class="fa fa-remove"></i></a>';

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

        $comments = Comment::whereIn('commentable_id',function($q)use ($supplierId){
            $q->select('id')
                ->from('products')
                ->where('supplier_id', $supplierId);
        })->with('user','commentable');

        return $this->applyScopes($comments);
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
                'url' => route('comments.datatables'),
            ])
            ->addAction(['width' => '50px', 'title' => 'Удалить'])
            ->parameters([
                'dom' => 'Bfrtip',
                'lengthMenu' => [
                    [ 10, 25, 50, -1 ],
                    [ '10 отзывов', '25 отзывов', '50 отзывов', 'Все' ]
                ],
                'buttons' => ['pageLength', 'csv', 'excel', 'print'],
                'order'   => [[0, 'desc']],
                'language' => [
                    'processing' => 'Загрузка',
                    'search' => 'Поиск',
                    'lengthMenu' => 'Показать _MENU_ отзывов',
                    'info' => 'Отзывы с _START_ до _END_ из _TOTAL_ отзывов',
                    'infoEmpty' => 'Заказы с 0 до 0 из 0 заказов',
                    'infoFiltered' => '(отфильтровано из _MAX_ отзывов)',
                    'infoPostFix' => '',
                    'loadingRecords' => 'Загрузка отзывов...',
                    'zeroRecords' => 'Отзывы отсутствуют.',
                    'emptyTable' => 'В таблице отсутствуют данные',
                    'paginate' => [
                        'first' => '<<',
                        'previous' => '<',
                        'next' => '>',
                        'last' => '>>'
                    ],
                    'buttons' => [
                        'pageLength' => [
                            '_' => 'Показать %d отзывов',
                            -1 => 'Все отзыввы'
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
            'text'=> ['title' => 'Отзыв'],
            'commentable.name'=> ['title' => 'Товар'],
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
        return 'comments';
    }
}