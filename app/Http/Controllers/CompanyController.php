<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CompanyController extends Controller
{
    private $company;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->company = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response|View
     */
    public function index()
    {
        $country = "Canada";
        $companies = Company::with(['users'])
            ->whereHas('country', function($query) use($country) {
                $query->where('name', $country);
            })
            ->get();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->company->create($request->validated());
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->back()->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function show(Company $company) :View
    {
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('company.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        try {
            $this->company->update($request->validated(), $id);
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->back()->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id): int
    {
        return $this->company->delete($id);
    }
}
