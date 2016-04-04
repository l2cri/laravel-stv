<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 20:58
 */

namespace App\Http\Controllers;


use App\Repo\Action\ActionInterface;
use App\Services\Form\Action\ActionForm;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    protected $action;
    protected $form;

    public function __construct(ActionInterface $action, ActionForm $form){
        $this->action = $action;
        $this->form = $form;
    }

    public function index(){
        $actions = $this->action->bySupplier(supplierId());
        return view('panel.supplier.actions.index', compact('actions'));
    }

    public function add(Request $request ){

        $input = removeEmptyValues($request->all());

        if ($this->form->save($input)) {
            return response("action added");
        } else {
            return response()->json( ['errors' => $this->form->errors()], 500 );
        }
    }

    public function show($id) {
        $action = $this->action->byId($id);
        return view('panel.supplier.actions.show', compact('action'));
    }
}