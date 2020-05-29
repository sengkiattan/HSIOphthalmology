@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="align-items: center; display: flex;">
            <a href="{{ route('dashboard') }}" style="margin-right: 10px;">
                <i class="fas fa-angle-left"></i>
            Dashboard </a>/ Add New Queue No.
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('storeQueue') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="queue_no" class="col-md-4 col-form-label text-md-right">{{ __('Queue No.') }}</label>

                            <div class="col-md-6">
                                <input id="queue_no" type="queue_no" class="form-control{{ $errors->has('queue_no') ? ' is-invalid' : '' }}" name="queue_no" value="{{ old('queue_no') }}" required autofocus>

                                @if ($errors->has('queue_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('queue_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="clinic_id" class="col-md-4 col-form-label text-md-right">{{ __('Clinic No.') }}</label>

                            <div class="col-md-6">
                                <select id="clinic_id" name="clinic_id" class="form-control{{ $errors->has('clinic_id') ? ' is-invalid' : '' }}" required>
                                    @foreach ($clinics as $clinic)
                                        <option value="{{ $clinic->id }}">{{ $clinic->clinic_no . " - " . $clinic->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('clinic_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('clinic_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <a href="{{ route('dashboard') }}" class="btn btn-danger">
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
