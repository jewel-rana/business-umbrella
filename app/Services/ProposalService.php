<?php


namespace App\Services;


use App\Models\Proposal;
use App\Repositories\Interfaces\ProposalRepositoryInterface;

class ProposalService
{
    private $proposal;
    public function __construct(ProposalRepositoryInterface $proposalRepository)
    {
        $this->proposal = $proposalRepository;
    }

    public function create(array $data)
    {
        return Proposal::updateOrCreate(
            ['file_name' =>  $data['file_name'], 'file_size' => $data['file_size']],
            $data
        );
    }
}
