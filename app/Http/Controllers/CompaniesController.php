<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Http\Requests\CompaniesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
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
        $data = Companies::paginate(10);
        return view('companies.index',['data'=>$data]);
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

        // proccess file upload before save
        $data['logo'] = $this->processUploadedLogo($request->file('logo'),$request->post('name'));

        $model = Companies::create($data);

        return redirect(url('/companies/'.$model->id))->with([
            'message'=> 'The company record was successfully saved',
            'message-type' => 'success'
        ]);
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
        unset($data['logo']);

        // if file exists then proccess file upload before save
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->processUploadedLogo($request->file('logo'),$request->post('name'));
        }

        $this->getCompany($id)->update($data);

        return redirect(url('/companies/'.$id))->with([
            'message'=> 'The company record was successfully updated',
            'message-type' => 'success'
        ]);
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

    public function processUploadedLogo(\Illuminate\Http\UploadedFile $file, $prefixFilename){
        $filename = $this->generateLogoFilename($file->getClientOriginalName(),$prefixFilename);

        $this->saveUploadedLogo($file,$filename);

        return $filename;
    }
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $filename
     * @return bool
     */
    private function saveUploadedLogo(\Illuminate\Http\UploadedFile $file, string $filename){
        if(!Storage::disk('localPicture')->put($filename,File::get($file)))
            throw new UploadException('Was no possible to save the logo file');

        return true;
    }

    /**
     * @param string $originalFileName
     * @param string $prefixName
     * @return string
     */
    private function generateLogoFilename(string $originalFileName,string $prefixName){
        $ext = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $prefix = preg_replace('/[^\w\s]/','',$prefixName);

        return  strtolower($prefix).'-'.time().'.'.$ext;
    }
}
