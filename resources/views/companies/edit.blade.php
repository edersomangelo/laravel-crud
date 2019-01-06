@extends('layouts.adm-lte')

@section('content')
    <div class="col-md-12">
        <h3>Edit company {{$model->name}}</h3>
    </div>
    <div class="col-md-6 well">
        <form class="col-md-12" action="{{url("/companies/{$model->id}/update")}}" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$model->id}}"/>
            <div class="form-group col-md-12 {{$errors->has('name')? 'has-error':''}}">
                <label class="control-label">Name</label>
                <input type="text" required name="name" value="{{is_null(old('name'))?$model->name:old('name')}}" class="form-control" placeholder="Name"/>
                @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
            <div class="form-group col-md-12 {{$errors->has('email')? 'has-error':''}}">
                <label class="control-label">Email</label>
                <input type="email" name="email" value="{{is_null(old('email'))?$model->email:old('email')}}" class="form-control" placeholder="Email"/>
                @if($errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                @endif
            </div>
            <div class="form-group col-md-12 {{$errors->has('website')? 'has-error':''}}">
                <label class="control-label">Website</label>
                <input type="url" name="website" value="{{is_null   (old('website'))?$model->website:old('website')}}" class="form-control" placeholder="Website"/>
                @if($errors->has('website'))
                    <span class="help-block">{{$errors->first('website')}}</span>
                @endif
            </div>
            <div class="form-group pic col-md-12 {{$errors->has('logo')? 'has-error':''}}">
                <label class="control-label">Logo</label>
                <input type="file" id="image-input" name="logo" accept="image/*"/>
                @if($errors->has('logo'))
                    <span class="help-block">{{$errors->first('logo')}}</span>
                @endif
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" style="margin-top: 5px;float: right">Save</button>
            </div>
        </form>
    </div>
@endsection