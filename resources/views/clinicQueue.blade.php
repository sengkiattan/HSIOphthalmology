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
        </div>

        <form method="post" action="{{ route('storeQueueClinic', ['clinic_id' => $clinic['id']]) }}">
            @csrf
            <div class="form-group row mt-4 mb-4">
                <label for="store_queue_no" class="col-md-2 col-form-label text-md-right">{{ __('Add Queue Number:') }}</label>

                <div class="col-md-2">
                    <input id="store_queue_no" type="text" class="form-control{{ $errors->has('store_queue_no') ? ' is-invalid' : '' }}" name="store_queue_no" value="{{ old('store_queue_no') }}" placeholder="Queue No." required autofocus>
                </div>

                <div class="col-md-4">
                    <select id="store_clinic_id" name="store_clinic_id" class="form-control{{ $errors->has('store_clinic_id') ? ' is-invalid' : '' }}" required>
                        @foreach ($all_clinics as $store_clinic)
                            <option value="{{ $store_clinic->id }}">{{ $store_clinic->clinic_no . " - " . $store_clinic->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add') }}
                    </button>
                </div>
            </div>
        </form>

        <hr/>

        <form method="post" action="{{ route('transferQueueClinic', ['clinic_id' => $clinic['id']]) }}">
            @csrf
            <div class="form-group row mt-4 mb-4">
                <label for="transfer_queue_no" class="col-md-2 col-form-label text-md-right">{{ __('Transfer Queue Number:') }}</label>

                <div class="col-md-2">
                    <input id="transfer_queue_no" type="text" class="form-control{{ $errors->has('transfer_queue_no') ? ' is-invalid' : '' }}" name="transfer_queue_no" value="{{ old('transfer_queue_no') }}" placeholder="Queue No." required autofocus>
                </div>

                <div class="col-md-4">
                    <select id="transfer_clinic_id" name="transfer_clinic_id" class="form-control{{ $errors->has('transfer_clinic_id') ? ' is-invalid' : '' }}" required>
                        @foreach ($clinics as $transfer_clinic)
                            <option value="{{ $transfer_clinic->id }}">{{ $transfer_clinic->clinic_no . " - " . $transfer_clinic->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Transfer') }}
                    </button>
                </div>
            </div>
        </form>

        <hr/>

        <form method="post" action="{{ route('callQueueClinic', ['clinic_id' => $clinic['id']]) }}">
            @csrf
            <div class="form-group row mt-4 mb-4">
                <label for="transfer_queue_no" class="col-md-2 col-form-label text-md-right">{{ __('Call Queue Number:') }}</label>

                <div class="col-md-2">
                    <input id="call_queue_no" type="text" class="form-control{{ $errors->has('call_queue_no') ? ' is-invalid' : '' }}" name="call_queue_no" value="{{ old('call_queue_no') }}" placeholder="Queue No." required autofocus>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Call') }}
                    </button>
                </div>

                <div class="col-md-6 text-right">
                    <a href="{{ route('nextPatient', ['clinic_id' => $clinic['id']]) }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: #F16C0F; color: white;">
                        <i class="fas fa-angle-right"></i> Call Next Queue Number
                    </a>
                </div>
            </div>
        </form>

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
