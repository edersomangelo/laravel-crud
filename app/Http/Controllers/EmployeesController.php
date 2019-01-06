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
        return view('employees.index');
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

    public function tableNew()
    {
        $model = Employees::with('company')
            ->select()
            ->get();

        return DataTables::of($model)
            ->addColumn('company_name', function ($model){
                return $model->company->name;
            })
            ->addColumn('created_at', function($model){
                return $model->created_at == null ? '-' : Carbon::parse($model->created_at)->format('d/m/Y');
            })
            ->addColumn('view', function($model) {
                return '<a href="'.url("/employees/{$model->id}").'" style="font-size: 18px"><i class="fa fa-eye"></i></a>';
            })
            ->addColumn('edit', function($model) {
                return '<a href="'.url("/employees/{$model->id}/edit").'" style="font-size: 18px"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('delete', function($model) {
                return '<a onclick="delete_employee(this.dataset.employee_id)" data-employee_id="' . $model->id . '" style="color: red;font-size: 18px; cursor: pointer"><i class="fa fa-close"></i></a>';
            })
            ->rawColumns(['created_at','delete', 'edit','view'])
            ->make(true);
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
