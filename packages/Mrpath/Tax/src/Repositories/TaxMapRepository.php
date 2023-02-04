<?php

namespace Mrpath\Tax\Repositories;

use Mrpath\Core\Eloquent\Repository;

class TaxMapRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\Tax\Contracts\TaxMap';
    }

    /**
     * @param  array  $data
     * @return \Mrpath\Tax\Contracts\TaxMap
     */
    public function create(array $data)
    {
        $taxMap = $this->model->create($data);

        return $taxMap;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     * @return \Mrpath\Tax\Contracts\TaxMap
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $taxMap = $this->find($id);

        $taxMap->update($data);

        return $taxMap;
    }
}