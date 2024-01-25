<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\travel_agents;
use App\Models\adminusers;
use App\Models\accommodations;
use App\Models\contracts;
use App\Models\bookings;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{
    public function getAccommodations()
    {
        return response()->json(accommodations::latest()->get());
    }
    public function getContracts()
    {
        return response()->json(contracts::with('accommodation')->with('travelAgent')->latest()->get());
    }
    public function getBookings($agent)
    {
        if($agent!='null')
        {
            return response()->json(bookings::where('travel_agent_id',$agent)->with('accommodation')->with('travelAgent')->where('status','active')->latest()->get());
        }
        else
        {
            return response()->json(bookings::with('accommodation')->with('travelAgent')->where('status','active')->latest()->get());
        }
    }
    public function getContractRates($accommodation_id,$agent_id)
    {
        return response()->json(contracts::where('accommodation_id',$accommodation_id)->where('travel_agent_id',$agent_id)->whereDate('start_date','<=',\Carbon\Carbon::tomorrow())->whereDate('end_date','>=',\Carbon\Carbon::today())->get());
    }

    public function getAgents()
    {
        return response()->json(travel_agents::latest()->get());
    }

   

    public function storeAccommodation(Request $request)
    {
        accommodations::create([
            'name'         => $request->name,
            'description'          => $request->description,
            'standard_rack_rate'          => $request->rates,
        ]);

        return response()->json('accommodation created successfully!');
    }

    public function updateAccommodation(Request $request, $id)
    {
        accommodations::where('id', $id)->update([
            'name'         => $request->name,
            'description'          => $request->description,
            'standard_rack_rate'          => $request->rates,
        ]);

        return response()->json('accommodation updated successfully!');
    }
    
    public function deleteAccommodation($id)
    {
        accommodations::where('id', $id)->delete();
        return response()->json('accommodations deleted successfully!');
    }

    public function storeContract(Request $request)
    {
        contracts::create([
            'contract_rate'=>$request->contract_rates,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'accommodation_id'=>$request->accommodation,
            'travel_agent_id'=>$request->agent,

        ]);

        return response()->json('Contract created successfully!');
    }

    public function updateContract(Request $request, $id)
    {
        contracts::where('id', $id)->update([
            'contract_rate'=>$request->contract_rates,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'accommodation_id'=>$request->accommodation,
            'travel_agent_id'=>$request->agent,
        ]);

        return response()->json('Contract updated successfully!');
    }
    
    public function deleteContract($id)
    {
        contracts::where('id', $id)->delete();
        return response()->json('Contracts deleted successfully!');
    }

    public function storeBooking(Request $request)
    {
        bookings::create([
           'rates'=>$request->rates,
           'clientName'=>$request->clientName,
           'clientEmail'=>$request->clientEmail,
           'clientPhone'=>$request->clientPhone,
           'clientAddress'=>$request->clientAddress,
           'rooms'=>$request->rooms,
           'checkInDate'=>$request->checkInDate,
           'checkOutDate'=>$request->checkOutDate,
           'accommodation_id'=>$request->room_id,
           'travel_agent_id'=>$request->agent,
           'totals'=>$request->totals


        ]);

        return response()->json('Booking created successfully!');
    }

    public function updateBooking(Request $request,$id)
    {
        bookings::where('id',$id)->update([
           'rates'=>$request->rates,
           'clientName'=>$request->clientName,
           'clientEmail'=>$request->clientEmail,
           'clientPhone'=>$request->clientPhone,
           'clientAddress'=>$request->clientAddress,
           'rooms'=>$request->rooms,
           'checkInDate'=>$request->checkInDate,
           'checkOutDate'=>$request->checkOutDate,
           'accommodation_id'=>$request->room_id,
           'travel_agent_id'=>$request->agent,
           'totals'=>$request->totals


        ]);

        return response()->json('Booking created successfully!');
    }
    public function cancelBooking($id)
    {
        bookings::where('id', $id)->update(['status'=>'canceled']);
        return response()->json('Booking canceled successfully!');
    }
    
}
