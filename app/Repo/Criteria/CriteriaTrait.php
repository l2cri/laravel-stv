<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 29.01.16
 * Time: 17:05
 */

namespace App\Repo\Criteria;


use Illuminate\Support\Collection;

trait CriteriaTrait
{
    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @return $this
     */
    public function  applyCriteria() {

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria) {
        $this->getCriteria()->push($criteria);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria() {

        if (!($this->criteria instanceof Collection))
            $this->criteria = new Collection();

        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }
}