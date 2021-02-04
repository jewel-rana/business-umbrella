<?php


namespace App\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
