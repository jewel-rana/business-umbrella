<?php


namespace App\Repositories;


use App\Repositories\Interfaces\ProposalRepositoryInterface;
use Illuminate\Support\Collection;

class ProposalRepository extends BaseRepository implements ProposalRepositoryInterface
{
    public function all(): Collection
    {
        return parent::all();
    }

    public function create(array $data)
    {
        return parent::create($data);
    }

    public function update(array $data, $id)
    {
        return parent::update($data, $id);
    }
}
