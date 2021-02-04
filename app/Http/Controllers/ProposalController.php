<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProposalUploadRequest;
use App\Services\PdfService;
use App\Services\ProposalService;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    private $pdfService;
    private $proposalService;

    public function __construct(PdfService $pdfService, ProposalService $proposalService)
    {
        $this->pdfService = $pdfService;
        $this->proposalService = $proposalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proposal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proposal.create')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(ProposalUploadRequest $request)
    {
        try {
            if($this->pdfService->searchText('proposal')) {
                $request->file('attachment')->storeAs('uploads', $request->file('attachment')->getClientOriginalName(), 'public');
                $request->merge([
                    'file_name' => $request->file('attachment')->getClientOriginalExtension(),
                    'file_extension' => $request->file('attachment')->getClientOriginalExtension(),
                    'file_size' => $request->file('attachment')->getSize(),
                    'user_id' => auth()->user()->id
                ]);
                $this->proposalService->create($request->all());
            } else {
                throw new \Exception('Word Proposal not exist on the attachment');
            }
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->back()->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
