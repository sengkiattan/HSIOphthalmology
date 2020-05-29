@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="align-items: center; display: flex;">
            <a href="{{ route('clinicManagement') }}" style="margin-right: 10px;">
                <i class="fas fa-angle-left"></i>
            Clinic Management </a>/ Add New Clinic
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('storeClinic') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="clinic_no" class="col-md-4 col-form-label text-md-right">{{ __('Clinic No.') }}</label>

                            <div class="col-md-6">
                                <input id="clinic_no" type="clinic_no" class="form-control{{ $errors->has('clinic_no') ? ' is-invalid' : '' }}" name="clinic_no" value="{{ old('clinic_no') }}" required autofocus>

                                @if ($errors->has('clinic_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('clinic_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Clinic Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}">
                                    
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <a href="{{ route('clinicManagement') }}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
