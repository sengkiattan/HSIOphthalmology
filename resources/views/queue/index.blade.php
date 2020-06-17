@extends('layouts.app')

@section('content')
<div class="container">
    @include('queueUpdate')
    @if($your_queue)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="border-bottom: 0px; background-color: transparent;">
                        <div class="row">
                            <div class="col-md-6 text-center" style="display: flex; align-items: center; justify-content: center;">
                                <span>Your Queue Number</span>
                            </div>
                            <div class="col-md-6 text-center">
                                <span style="font-size: x-large; font-weight: bold; color: #FD6A07">{{ $queue_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-12 text-center">
                <input type="hidden" id="search_queue" name="search_queue" value="{{ $queue_no }}"/>
                <a href="" onclick="searchQueue()" style="padding: .75rem 1.25rem; border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                    TAP TO UPDATE <i class="fas fa-redo"></i>
                </a>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p>
                                    <span style="font-size: smaller;">Current Queue Status for</span>
                                    <br/>
                                    <span style="font-size: large; font-weight: bold">{{ $clinic->name }}</span>
                                    <br/>
                                    <span style="font-size: smaller;">Clinic Number</span> <span style="font-size: larger; font-weight: bold">{{ $clinic->clinic_no }}</span>
                                </p>
                            </div>
                            <div class="col-md-6 text-center" style="background-color: #FFDFC0; border: solid white 5px;">
                                <span style="font-size: smaller;">As at</span>
                                <br/>
                                <span style="font-size: larger; font-weight: bold;">{{ $time_now }}</span>
                            </div>
                            <div class="col-md-6 text-center" style="background-color: #FFDFC0; border: solid white 5px;">
                                <span style="font-size: smaller;">Patients before you</span>
                                <br/>
                                <span style="font-size: x-large; font-weight: bold;">{{ $unserved_queue }}</span>
                            </div>
                            <div class="col-md-12 text-center mt-2">
                                <span style="font-size: smaller;">Number may adjust if patients require urgent attention.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="border-bottom: 0px; background-color: transparent;">
                        <div class="row">
                            <div class="col-md-6 text-center" style="display: flex; align-items: center; justify-content: center;">
                                <span>Your Queue Number</span>
                            </div>
                            <div class="col-md-6 text-center">
                                <span style="font-size: x-large; font-weight: bold; color: #FD6A07">{{ $queue_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                Queue number not found. Please check your number and try again.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-12 text-center">
                <input type="hidden" id="search_queue" name="search_queue" value="{{ $queue_no }}"/>
                <a href="/" class="btn btn-default" style="padding: .75rem 1.25rem; border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                    <i class="fas fa-angle-left"></i> BACK 
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

<script type="text/javascript">
    function searchQueue()
    {
        let queue_no = document.getElementById('search_queue').value;
        window.location.href = "/queueSearch/" + queue_no;
    }
</script>
<script src="{{ asset('js/enable-push.js') }}" defer></script>