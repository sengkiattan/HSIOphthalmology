<div id="transferPatientModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
    <!-- Modal content-->
        <form action="" id="transferPatientForm" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title text-center">Transfer Patient</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label for="clinic_id" class="col-form-label">{{ __('Transfer to:') }}</label>
                    <select id="clinic_id" name="clinic_id" class="form-control{{ $errors->has('clinic_id') ? ' is-invalid' : '' }}" required>
                        @foreach ($clinics as $search_clinic)
                            <option value="{{ $search_clinic->id }}">{{ $search_clinic->clinic_no . " - " . $search_clinic->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="current_clinic_id" name="current_clinic_id" value="{{ $clinic['id'] }}"/>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="transferPatientSubmit()">
                            Yes
                        </button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>