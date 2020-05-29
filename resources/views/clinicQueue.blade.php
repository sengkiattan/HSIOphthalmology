@extends('layouts.app')

@section('content')

<div class="container">
    @include('modal')
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

    @if ($clinic)
        <div class="row justify-content-center">
            <div class="col-md-12">
                <small><a href="{{ route('dashboard') }}" style="margin-right: 10px;">
                    <i class="fas fa-angle-left"></i>
                Dashboard</a>/ Clinic Queue Management</small>
                <br/>
                <span style="font-weight: bold; font-size: larger">
                    Clinic {{ $clinic["clinic_no"] }} - {{ $clinic["name"] }}
                </span>
            </div>
            <!-- <div class="col-md-8 text-right">
                <a href="{{ route('addClinic') }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                    <i class="fas fa-plus"></i> Add New Clinic 
                </a>
            </div> -->
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="border-bottom: 0px; background-color: transparent;">
                        <div class="row">
                            <div class="col-md-6 text-center" style="display: flex; align-items: center; justify-content: center;">
                                <span>Current Queue Number : {{ $serving_queue_no }}</span>
                            </div>
                            <div class="col-md-6 text-center">
                                @if ($serving_queue_no == "N/A")
                                    <a href="javascript:;" data-toggle="modal" onclick="startNewPatient({{ $clinic['id'] }})" data-target="#nextPatient" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white; margin-left: 5px;">
                                        <i class="fas fa-play"></i> Serve First Number
                                    </a>
                                @else

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Queue No.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($queues as $queue)
                        <tr>
                            <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                            <td class="align-middle">{{ $queue["queue_no"] }}</td>
                        </tr>
                    @endforeach
                    @if (count($queues) == 0)
                    <tr>
                        <td colspan="2" class="text-center">No record found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-12">
                <small><a href="{{ route('dashboard') }}" style="margin-right: 10px;">
                    <i class="fas fa-angle-left"></i>
                Dashboard</a>/ Clinic Queue Management</small>
                <br/>
                <span style="font-weight: bold; font-size: larger">
                    
                </span>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-12 text-center">
                <h4>
                    Clinic Not Found. Please choose a correct clinic in Dashboard.
                </h4>
            </div>
        </div>
    @endif
</div>
@endsection
