<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Http\Requests\CompaniesRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CompaniesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesRequest $request)
    {
        $data = $request->all();
        $filename = $this->saveUploadedLogo($request);
        $data['logo'] = $filename;

        $model = Companies::create($data);
        return redirect(url('/companies/'.$model->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('companies.show',['company'=>$this->getCompany($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('companies.edit',['model'=>$this->getCompany($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompaniesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniesRequest $request, $id)
    {
        $data = $request->all();
        if (empty($request->file('logo'))) {
            unset($data['logo']);
        }else{
            $data['logo'] = $this->saveUploadedLogo($request);
        }

        $this->getCompany($id)->update($data);
        return redirect(url('/companies/'.$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Companies::destroy($id);
    }

    public function tableNew()
    {
        $model = Companies::select()
            ->get();

        return DataTables::of($model)
            ->addColumn('logo', function($model){
                $logo = ($model->logo == null) ? asset('img/avatar.png') : $model->logo;
                return '<img class="img-circle table-foto" src="'.$logo.'">';
            })
            ->addColumn('logo', function($model){
                $logo = ($model->logo == null) ? asset('img/avatar.png') : $model->logo;
                return '<img class="img-circle table-foto" src="'.$logo.'">';
            })
            ->addColumn('created_at', function($model){
                return $model->created_at == null ? '-' : Carbon::parse($model->created_at)->format('d/m/Y');
            })
            ->addColumn('view', function($model) {
                return '<a href="'.url("/companies/{$model->id}").'" style="font-size: 18px"><i class="fa fa-eye"></i></a>';
            })
            ->addColumn('edit', function($model) {
                return '<a href="'.url("/companies/{$model->id}/edit").'" style="font-size: 18px"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('delete', function($model) {
                return '<a onclick="delete_company(this.dataset.company_id)" data-company_id="' . $model->id . '" style="color: red;font-size: 18px; cursor: pointer"><i class="fa fa-close"></i></a>';
            })
            ->rawColumns(['logo', 'created_at','delete', 'edit','view'])
            ->make(true);
    }

    /**
     * @param $id
     * @return \App\Companies
     */
    private function getCompany($id){
        $model = Companies::find($id);
        if(empty($model))
            return redirect(url('/companies'));
        return $model;
    }

    /**
     * @param CompaniesRequest $request
     * @return string
     */
    private function saveUploadedLogo(CompaniesRequest $request){
        $file = $request->file('logo');
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $companyName = preg_replace('/[^\w\s]/','',$request->post('name'));
        $filename= strtolower($companyName).'-'.time().'.'.$ext;

        Storage::disk('localPicture')->put($filename,File::get($file));
        return $filename;
    }
}
