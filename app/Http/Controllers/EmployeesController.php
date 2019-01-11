<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Employees;
use App\Http\Requests\EmployeesRequest;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employees::paginate(10);
        return view('employees.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create',[
            'companies' => $this->getCompanies()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EmployeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {
        $model = Employees::create($request->all());
        return redirect(url('/employees/'.$model->id))->with([
            'message'=> 'The employee record was successfully saved',
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
        $employee = $this->getEmployee($id);
        return view('employees.show')->with(['employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->getEmployee($id);
        return view('employees.edit',[
            'model'=>$model,
            'companies' => $this->getCompanies()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EmployeesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesRequest $request, $id)
    {
        $model = $this->getEmployee($id);
        $model->update($request->all());

        return redirect(url('/employees/'.$id))->with([
            'message'=> 'The employee record was successfully updated',
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
        Employees::destroy($id);
    }

    private function getEmployee($id){
        $model = Employees::with('company')->find($id);
        if(empty($model))
            return redirect(url('/employees'));

        return $model;
    }
    private function getCompanies(){
        return Companies::pluck('name', 'id')->toArray();
    }
}
