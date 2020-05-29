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

    <div class="row justify-content-center">
        <div class="col-md-4" style="align-items: center; display: flex;">
            Clinic Management 
        </div>
        <div class="col-md-8 text-right">
            <a href="{{ route('addClinic') }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                <i class="fas fa-plus"></i> Add New Clinic 
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Clinic No.</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($clinics as $clinic)
                    <tr>
                        <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td class="align-middle">{{ $clinic["clinic_no"] }}</td>
                        <td class="align-middle">{{ $clinic["name"] }}</td>
                        <td class="text-right">
                            <a href="{{ route('editClinic', $clinic['id']) }}" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: #F16C0F; border: 1px solid; background-color: white;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$clinic['id']}})" data-target="#DeleteModal" class="btn btn-default" style="border-radius: calc(.25rem - 1px); color: red; border: 1px solid; background-color: white;">
                                <i class="far fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                @if (count($clinics) == 0)
                <tr>
                    <td colspan="4" class="text-center">No record found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

<script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("deleteClinic", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
