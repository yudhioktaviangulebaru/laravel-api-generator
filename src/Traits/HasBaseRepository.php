<?php

namespace Yudhi\Apigen\Traits;

trait HasBaseRepository
{
    public function findAll()
    {
        return $this->entity->all();
    }

    public function create(array $data)
    {
        return $this->entity->create($data);
    }

    public function delete(int $id)
    {
        $data = $this->entity->find($id);
        $find = $data;
        $find->delete();

        return $data;
    }
}
