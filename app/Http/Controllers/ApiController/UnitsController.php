<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Department;
use stdClass;
use App\Models\Unit;


class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = new stdClass();
        $response->data = Unit::all();
        $response->message = 'Success';
        $httpCode = 200;
        return response(json_encode($response), $httpCode);
    }

    public function show($id)
    {
        $response = new stdClass();
        try {
            $response->data = Unit::findOrFail($id);
            $response->message = 'Success';
            $httpCode = 200;
        } catch (\Exception $e) {
            $response->data = null;
            $response->message = $e->getMessage();
            $httpCode = 404;
        }
        return response(json_encode($response), $httpCode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function showByUnitModule($unit_module)
    {
        
        $response = new stdClass();
        try {
            $response->data = Unit::where('unit_module', $unit_module)->get();
            $response->message = 'Success';
            $httpCode = 200;
        } catch (\Exception $e) {
            $response->data = null;
            $response->message = $e->getMessage();
            $httpCode = 404;
        }
        return response(json_encode($response), $httpCode);
    }

    //college

    public function showCollegeDept($unit_id)
    {
        $response = new stdClass();
        try {
            $response->data = College::with('units')->with('department')->where('unit_id', $unit_id)->get();

            $response->message = 'Success';
            $httpCode = 200;
        } catch (\Exception $e) {
            $response->data = null;
            $response->message = $e->getMessage();
            $httpCode = 404;
        }
        return response(json_encode($response), $httpCode);
    }

    //department

    public function showDepartmentPrograms($unit_id){
        $response = new stdClass();
        try {
            $response->data = Department::with('unit')->with('acad_prog')->where('unit_id', $unit_id)->get();
            $response->message = 'Success';
            $httpCode = 200;
        } catch (\Exception $e) {
            $response->data = null;
            $response->message = $e->getMessage();
            $httpCode = 404;
        }
        return response(json_encode($response), $httpCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDepartmentCourses($unit_id)
    {
        $response = new stdClass();
        try {
            $response->data = Department::with('unit')->with('courses')->where('unit_id', $unit_id)->get();
            $response->message = 'Success';
            $httpCode = 200;
        } catch (\Exception $e) {
            $response->data = null;
            $response->message = $e->getMessage();
            $httpCode = 404;
        }
        return response(json_encode($response), $httpCode);
    }
}
