<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Stall;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        try{
            $events = Event::all();
            return APIHelper::createSuccessAPIResponse($events, 200, 'success' ,null);
        }catch (\Exception $e){
            report($e);
            return APIHelper::createErrorAPIResponse(null, 500, 'error');
        }
    }

    public function show($id){
        try{
            $event = Event::where('id', $id)->with('getStallsRel.getBookingRel')->first();
            return APIHelper::createSuccessAPIResponse($event, 200, 'success' ,null);
        }catch (\Exception $e){
            report($e);
            return APIHelper::createErrorAPIResponse(null, 500, 'error');
        }
    }

    public function getEventStalls($event_id){
        try{
            $event_stalls = Stall::where('event_id', $event_id)->with('getBookingRel')->get();
            return APIHelper::createSuccessAPIResponse($event_stalls, 200, 'success' ,null);
        }catch (\Exception $e){
            report($e);
            return APIHelper::createErrorAPIResponse(null, 500, 'error');
        }
    }

    public function getStall($stall_id){
        try{
            $stalls = Stall::where('id', $stall_id)->with(['getEventRel', 'getBookingRel'])->first();
            return APIHelper::createSuccessAPIResponse($stalls, 200, 'success' ,null);
        }catch (\Exception $e){
            report($e);
            return APIHelper::createErrorAPIResponse(null, 500, 'error');
        }
    }
}
