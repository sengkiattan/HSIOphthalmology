<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Clinic;
use App\Queue;
use Validator;
use Session;
use Redirect;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ClinicController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the clinic queue
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clinic($clinic_no)
    {
        $clinic = Clinic::where('clinic_no', $clinic_no)->first();
        $queues = [];
        $clinics = Clinic::where('clinic_no', '!=', $clinic_no)->get();

        if ($clinic) {
            $queues = Queue::where('clinic_id', $clinic->id)->whereDate('updated_at', Carbon::today())->where('is_completed', false)->get();
        }

        return view('clinicQueue', compact('clinic', 'queues', 'clinics'));
    }

    /**
     * Show the clinic management page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clinicManagement()
    {
        $clinics = Clinic::all();

        return view('clinicManagement', compact('clinics'));
    }

    /**
     * Show the add clinic page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addClinic()
    {
        return view('addClinic');
    }

    /**
     * Store new clinic
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeClinic(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'clinic_no' => 'required | unique:clinics,clinic_no',
            'name' => 'required'
        );
        $validator = Validator::make($input, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('clinicManagement/addClinic')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $clinic = Clinic::create($input);

            // redirect
            Session::flash('message', 'Successfully created clinic!');
            return Redirect::to('clinicManagement');
        }
    }

    /**
     * Show the edit clinic page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editClinic($id)
    {
        $clinic = Clinic::find($id);

        return view('editClinic', compact('clinic'));
    }

    /**
     * Update the clinic
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateClinic(Request $request, $id)
    {
        $input = $request->all();

        $rules = array(
            'clinic_no' => 'required | unique:clinics,clinic_no,' . $id,
            'name' => 'required'
        );
        $validator = Validator::make($input, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('clinicManagement/editClinic/'.$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // update
            $clinic = Clinic::find($id);
            $clinic->clinic_no = $request->input('clinic_no');
            $clinic->name = $request->input('name');
            $clinic->description = $request->input('description');
            $clinic->save();

            // redirect
            Session::flash('message', 'Successfully updated clinic!');
            return Redirect::to('clinicManagement');
        }
    }

    /**
     * Remove the clinic
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteClinic($id)
    {
        $clinic = Clinic::findOrfail($id);
        if($clinic->delete()){
            Session::flash('message', 'Successfully deleted clinic!');
            return Redirect::to('clinicManagement');
        }

        Session::flash('error', 'Unable to delete clinic! Pleae contact administrator.');
        return Redirect::to('clinicManagement');
    }
}
