<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use stdClass;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = new stdClass();
        $response->data = News::orderBy('news_id', 'desc')->get();
        $response->message = 'Success';
        $httpCode = 200;
        return response(json_encode($response), $httpCode);
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
            $response->data = News::findOrFail($id);
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
     * Display the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function showByNewsItemType($type)
    {
        $response = new stdClass();
        try {
            $response->data = News::where('news_item_type', $type)->get();
            $response->message = 'Success';
            $httpCode = 200;
        } catch (\Exception $e) {
            $response->data = null;
            $response->message = $e->getMessage();
            $httpCode = 404;
        }
        return response(json_encode($response), $httpCode); 
    }

    public function getNewsItemTypes()
    {
        $response = new stdClass();
        try {
            //$response->data = News::groupBy('news_item_type')->pluck('news_item_type');
            $response->data = [
                (object)['BRK' => 'Breaking'],
                (object)['MLS' => 'Milestone'],
                (object)['NWS' => 'News'],
                (object)['NTC' => 'Notice'],
                (object)['VCM' => 'VC Message'],
            ];
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
