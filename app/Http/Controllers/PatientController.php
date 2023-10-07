<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;

class PatientController extends Controller
{
    private $patients;

    public function __construct()
    {
        $this->patients = new Patient();
    }

    public function index()
    {
        $listPatient = $this->patients->all();
        return view("patient.index", ['listPatient' => $listPatient]);
    }

    public function create()
    {
        $generateId = $this->patients->getPatientID();
        return view('patient.create', ['generateId' => $generateId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpatient' => 'required',
            'namepatient' => 'required',
            'phonepatient' => 'required',
        ]);


        $patientRequest = $request->all();
        try {
            DB::beginTransaction();
            $this->patients->create([
                'patient_id' => $patientRequest['idpatient'],
                'name' => $patientRequest['namepatient'],
                'phone' => $patientRequest['phonepatient'],
            ]);
            DB::commit();
            return Redirect::to(route('patient.index'))->with('success', 'Success add new data');
        } catch (Exception $e) {
            DB::rollBack();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $dataPatient = $this->patients->where('patient_id', $id)->first();
        return view('patient.update', ['data' => $dataPatient]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'idpatient' => 'required',
            'namepatient' => 'required',
            'phonepatient' => 'required',
        ]);


        $patientRequest = $request->all();
        try {
            DB::beginTransaction();
            $this->patients->where('patient_id', $id)->update([
                'name' => $patientRequest['namepatient'],
                'phone' => $patientRequest['phonepatient'],
            ]);
            DB::commit();
            return Redirect::to(route('patient.index'))->with('success', "Success update product $id");
        } catch (Exception $e) {
            DB::rollBack();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }


    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->patients->where('patient_id', $id)->delete();
            DB::commit();
            return Redirect(route('patient.index'))->with('success', 'Data has been deleted');
        } catch (Exception $e) {
            DB::rollback();
            DB::commit();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
