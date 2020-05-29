@extends('layouts.app')

@section('content')

<div class="container">
    @include('transferPatientModal')
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
            <div class="col-md-12 text-right">
                <a href="{{ route('nextPatient', ['clinic_id' => $clinic['id']]) }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: #F16C0F; color: white;">
                    <i class="fas fa-angle-right"></i> Next Queue Number
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%">#</th>
                        <th scope="col" style="width: 20%">Queue No.</th>
                        <th scope="col" style="width: 60%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($queues as $queue)
                        <tr>
                            <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                            <td class="align-middle">{{ $queue["queue_no"] }}</td>
                            <td class="text-right">
                                @if ($queue['is_served'])
                                    <a href="javascript:;" class="btn btn-default disabled" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                                        <i class="fas fa-play"></i> Now Serving
                                    </a>
                                @else
                                    <a href="{{ route('nextSpecificPatient', ['queue_id' => $queue['id'], 'clinic_id' => $clinic['id']]) }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                                        <i class="fas fa-play"></i> Serve Now
                                    </a>
                                @endif

                                <a href="javascript:;" data-toggle="modal" onclick="transferPatient({{ $queue['id'] }})" data-target="#transferPatientModal" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                                    <i class="fas fa-exchange-alt"></i> Transfer
                                </a>
                                <a href="{{ route('completePatient', ['queue_id' => $queue['id'], 'clinic_id' => $clinic['id']]) }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                                    <i class="fas fa-flag-checkered"></i> Done
                                </a>
                                    
                            </td>
                        </tr>
                    @endforeach
                    @if (count($queues) == 0)
                    <tr>
                        <td colspan="3" class="text-center">No record found</td>
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

<script type="text/javascript">
    function transferPatient(id)
    {
        var id = id;
        var url = '{{ route("transferPatient", ":id") }}';
        url = url.replace(':id', id);
        $("#transferPatientForm").attr('action', url);
    }

    function transferPatientSubmit()
    {
        $("#transferPatientForm").submit();
    }
</script>
