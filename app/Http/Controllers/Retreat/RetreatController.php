<?php

namespace App\Http\Controllers\Retreat;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetreatController extends Controller
{
    public function index()
    {
        $data['page_name'] = 'Home';
        return view('retreat.home', $data);
    }
    public function yoga_garden()
    {
        $data['page_name'] = 'Yoga Garden';
        return view('retreat.yoga_garden', $data);
    }
    public function yoga_food()
    {
        $data['page_name'] = 'Yoga Food';
        return view('retreat.yoga_food', $data);
    }
    public function retreats()
    {
        $data['page_name'] = 'Retreats';
        return view('retreat.retreats', $data);
    }
    public function events(Request $request)
    {
        $data['page_name'] = 'Events';
        $data['event_types'] = EventTypes::get();
        $events = Events::query();
        $data['selected_event_type'] = 'All';
        if (!empty($request->input('event_type'))) {
            $events->where('type_id', $request->input('event_type'));
            $data['selected_event_type'] = EventTypes::find($request->input('event_type'))->title;
        } elseif (!empty($request->input('month'))) {
            $currentYear = Carbon::now()->format('Y');
            $currentMonth = $request->month;
            $events = $events->whereYear('start_at', '=', $currentYear)
               ->whereMonth('start_at', '=', $currentMonth)
               ->orWhere(function ($query) use ($currentMonth, $currentYear) {
                   $query->whereYear('end_at', '=', $currentYear)
                         ->whereMonth('end_at', '=', $currentMonth);
               });
        }
        $data['events'] = $events->get();
        return view('retreat.events', $data);
    }
    public function event($id, Request $request)
    {
        $data['page_name'] = 'Event';
        $data['event'] = Events::findOrFail($id);
        return view('retreat.single_event', $data);
    }
    public function event_booking($id, Request $request)
    {
        $data['page_name'] = 'Event Booking';
        $data['event'] = Events::findOrFail($id);
        return view('retreat.event_booking', $data);
    }
    public function contact_us()
    {
        $data['page_name'] = 'Contact Us';
        return view('retreat.contact_us', $data);
    }
    public function contact_us_send()
    {
        return redirect()->back();
    }
}
