@extends('layouts.adm-lte')
@section('styles-head')

@endsection

@section('title')
    Companies list
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content" style="padding: 0">
                    @include('companies.index.table.index')
                </div>
            </div>
        </div>
    </div>
@endsection