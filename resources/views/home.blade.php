@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-4" style="align-items: center; display: flex;">
            Dashboard 
        </div>
        <div class="col-md-8 text-right">
            <a href="{{ route('addQueue') }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                <i class="fas fa-plus"></i> Add New Queue No. 
            </a>
        </div>
    </div>

    <div class="row mt-4">
        @foreach($clinics as $clinic)
            <div class="col-md-4 mb-4 text-center">
                <div class="card">
                    <a class="dropdown-item" href="{{ route('clinic', ['clinic_no' => $clinic['clinic_no']]) }}">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Room {{ $clinic["clinic_no"] }}
                    </div>
                </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
