<?php


namespace App\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface ProposalRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
