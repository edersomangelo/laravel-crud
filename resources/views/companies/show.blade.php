@extends('layouts.adm-lte')

@section('content')
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3>{{$company->name}}</h3>
            </div>
            <div class="panel-body row">
                <div class="col-sm-2">
                    <img src="{{asset('/storage/'.$company->logo)}}" height="100">
                </div>
                <div class="col-sm-4">
                    <p><strong>Email: {{$company->email}}</strong></p>
                    <p><strong>Website: {{$company->website}}</strong></p>
                    <a href="{{url("/companies/{$company->id}/edit")}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection