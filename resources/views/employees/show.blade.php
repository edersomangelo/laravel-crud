@extends('layouts.adm-lte')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3>{{$employee->name}} {{$employee->lastname}}</h3>
            </div>
            <div class="panel-body row">
                <div class="col-sm-4">
                    <p><strong>Email: {{$employee->email}}</strong></p>
                    <p><strong>Phone: {{$employee->phone}}</strong></p>
                    <p><strong>Company: {{$employee->company->name}}</strong></p>
                    <a href="{{url("/employees/{$employee->id}/edit")}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection