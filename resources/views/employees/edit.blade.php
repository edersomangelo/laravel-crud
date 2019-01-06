@extends('layouts.adm-lte')

@section('content')
    <div class="col-md-12">
        <h3>Editing employee {{$model->name}}</h3>
    </div>
    <div class="col-md-6 well">
        <form class="col-md-12" action="{{url("/employees/{$model->id}/update")}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$model->id}}"/>
            <div class="form-group col-md-12 {{$errors->has('name')? 'has-error':''}}">
                <label class="control-label">Name</label>
                <input type="text" required name="name" value="{{is_null(old('name'))?$model->name:old('name')}}" class="form-control" placeholder="Name"/>
                @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
            <div class="form-group col-md-12 {{$errors->has('lastname')? 'has-error':''}}">
                <label class="control-label">Lastname</label>
                <input type="text" required name="lastname" value="{{is_null(old('lastname'))?$model->lastname:old('lastname')}}" class="form-control" placeholder="Lastname"/>
                @if($errors->has('lastname'))
                    <span class="help-block">{{$errors->first('lastname')}}</span>
                @endif
            </div>
            <div class="form-group col-md-12 {{$errors->has('phone')? 'has-error':''}}">
                <label class="control-label">Phone</label>
                <input type="text" required name="phone" value="{{is_null(old('phone'))?$model->phone:old('phone')}}" class="form-control" placeholder="Phone"/>
                @if($errors->has('phone'))
                    <span class="help-block">{{$errors->first('phone')}}</span>
                @endif
            </div>
            <div class="form-group col-md-12 {{$errors->has('email')? 'has-error':''}}">
                <label class="control-label">Email</label>
                <input type="email" name="email" value="{{is_null(old('email'))?$model->email:old('email')}}" class="form-control" placeholder="Email"/>
                @if($errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                @endif
            </div>
            <div class="form-group col-md-12 {{$errors->has('company_id')? 'has-error':'' }}">
                {!! Form::label("control-label",'Company')!!}
                {!! Form::select("company_id",$companies,$model->company_id,['class'=>'form-control']) !!}
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" style="margin-top: 5px;float: right">Save</button>
            </div>
        </form>
    </div>
@endsection