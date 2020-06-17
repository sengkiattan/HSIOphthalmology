@extends('layouts.app')

@section('content')

<div class="container">
    @include('queueUpdate')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Search Your Queue Number') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="search_queue" class="col-md-4 col-form-label text-md-right">{{ __('Queue Number') }}</label>

                        <div class="col-md-6">
                            <input id="search_queue" type="search_queue" class="form-control{{ $errors->has('search_queue') ? ' is-invalid' : '' }}" name="search_queue" value="{{ old('search_queue') }}" required autofocus>
                            <span class="invalid-feedback" style="display: initial;">
                                <p id="queue_error" style="font-weight: bold;"></p>
                            </span>
                            @if ($errors->has('search_queue'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('search_queue') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-12 offset-md-5">
                            <a href="javascript:;" data-toggle="modal" onclick="searchQueue()" class="btn btn-primary">
                                {{ __('Search') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    function searchQueue()
    {
        let queue_no = document.getElementById('search_queue').value;
        if (!queue_no) {
            //Display error message
            let error = "Please enter Queue Number";
            document.getElementById("queue_error").innerHTML = error; 
            return;
        }
        window.location.href = "/queueSearch/" + queue_no;
    }
</script>