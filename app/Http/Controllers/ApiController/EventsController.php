<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use stdClass;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = new stdClass();
        try {
            $response->data = Event::orderBy('event_id', 'desc')->get();
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = new stdClass();
        try {
            $response->data = Event::findOrFail($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
