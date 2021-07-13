<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function bookStall(Request $request, $event_id, $stall_id){
        try{

            $validator = Validator::make($request->all(), [
                'company_name' => 'required',
                'contact_details' => 'required'
            ]);

            if ($validator->fails()) {
                return APIHelper::createErrorAPIResponse($validator->errors(), 400, 'error');
            }

            $already_booked = Booking::where('stall_id', $stall_id)->first();
            if($already_booked != null){
                return APIHelper::createSuccessAPIResponse(null, 400, 'error' ,'Selected stall already booked!');
            }

            $booking = new Booking();
            $booking->company_name = $request->input('company_name');
            $booking->company_contact_details = $request->input('contact_details');
            $booking->company_logo = $request->input('company_logo');
            $booking->user_id = Auth::user()->id;
            $booking->stall_id = $stall_id;
            $booking->event_id = $event_id;
            $booking->save();

            return APIHelper::createSuccessAPIResponse($booking, 200, 'success' ,'Booking Successful');
        }catch (\Exception $e){
            report($e);
            return APIHelper::createErrorAPIResponse(null, 500, 'error');
        }
    }
}
