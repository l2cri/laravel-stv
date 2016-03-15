<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.03.16
 * Time: 18:06
 */

namespace App\Services\CartConditions;


use App\Repo\Product\ProductInterface;
use App\Repo\Supplier\SupplierInterface;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\ItemCollection;

abstract class AbstractConditionHandler
{
    protected $next;
    protected $product;
    protected $supplier;

    public function __construct(ProductInterface $product, SupplierInterface $supplier) {
        $this->product = $product;
        $this->supplier = $supplier;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    public function process($item, Cart $cart){

       // if ($item instanceof ItemCollection)

        if (!$this->_process($item, $cart)) {

            if ($this->getNext()) {
                $this->getNext()->process($item, $cart);
            }
        }
    }

    abstract protected function _process($item, Cart $cart);
}