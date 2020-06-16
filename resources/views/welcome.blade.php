@extends('layouts.app')

@section('content')

<div class="container">
    @include('queueUpdate')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Search Your Queue Number') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('searchQueue') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="search_queue" class="col-md-4 col-form-label text-md-right">{{ __('Queue Number') }}</label>

                            <div class="col-md-6">
                                <input id="search_queue" type="search_queue" class="form-control{{ $errors->has('search_queue') ? ' is-invalid' : '' }}" name="search_queue" value="{{ old('search_queue') }}" required autofocus>
                                @if ($errors->has('search_queue'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_queue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-12 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
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