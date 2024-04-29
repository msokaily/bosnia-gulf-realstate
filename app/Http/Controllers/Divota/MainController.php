<?php
namespace App\Http\Controllers\Divota;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\BookingProducts;
use App\Models\Service;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        if ($slug) {
            $accommodation = Accommodation::where('slug', $slug)->where('status', 1)->firstOrFail();
            $page_name = $accommodation->title;

            $features = [
                'Balcony' => $accommodation->balcony,
                'Terrace' => $accommodation->terrace,
                'Ground Floor' => $accommodation->ground_floor,
                'Washing Machine' => $accommodation->washing_machine,
                'Baby Cot' => $accommodation->baby_cot,
                'Twin Bed' => $accommodation->twin_bed,
            ];

            $services = Service::where(['status' => 1, 'is_class' => 0])
            ->whereHas('service_durations')->limit(6)->get();
            return view('divota.single_accommodation', [
                'item' => $accommodation,
                'page_name' => $page_name,
                'features' => $features,
                'services' => $services,
            ]);
        } else {
            $items = Accommodation::where('status', 1);
            if (request()->routeIs('rooms')) {
                $type = 'rooms';
                $page_name = 'Rooms';
                $items->where('type', $type);
            } elseif (request()->routeIs('apartments')) {
                $type = 'apartments';
                $page_name = 'Apartments';
                $items->where('type', $type);
            } elseif (request()->routeIs('villas')) {
                $type = 'villas';
                $page_name = 'Villas';
                $items->where('type', $type);
            } else {
                $page_name = 'Accommodations';
                $type = false;
            }

            if ($request->input('price_order') == 'asc') {
                $items->orderBy('price', 'asc');
            } else if ($request->input('price_order') == 'desc') {
                $items->orderBy('price', 'desc');
            } else {
                $items->orderBy('id', 'desc');
            }
            $options = $request->input('features', []);
            $features = [
                'balcony' => 'Balcony',
                'terrace' => 'Terrace',
                'ground_floor' => 'Ground Floor',
                'washing_machine' => 'Washing Machine',
                'baby_cot' => 'Baby Cot',
                'twin_bed' => 'Twin Bed'
            ];
            if ($request->input('location')) {
                $items->where('location_id', $request->input('location'));
            }

            $bookedDays =  BookingProducts::where(['type' => 'accommodation'])->whereHas('booking', function ($q) {
                $q->where('status', 'Confirmed');
            })->whereHas('product', function($q) use ($type) {
                if ($type) {
                    $q->where('type', $type);
                }
            });
            
            $from = $request->input('date_from');
            $to = $request->input('date_to');
            if ($from && $to) {
                $booked_dates = $bookedDays->get(['start_date', 'end_date', 'entity_id as id'])->toArray();
                $accomm_ids = [];
                $s = new \DateTime($from);
                $e = new \DateTime($to);
                $aa = [];
                // dd($booked_dates);
                foreach ($booked_dates as $key => $value) {
                    $tt = $value;
                    $tt['s'] = $s;
                    $tt['e'] = $e;
                    $aa[] = $tt;
                    $start_date = new \DateTime($value['start_date']);
                    $end_date = new \DateTime($value['end_date']);
                    if (($s >= $start_date && $s <= $end_date) || ($e >= $start_date && $e <= $end_date)) {
                    } else {
                        if (!in_array($value['id'], $accomm_ids)) {
                            $accomm_ids[] = $value['id'];
                        }
                    }
                }
                // dd($aa);
                $items->whereIn('id', $accomm_ids);
            }

            foreach ($options as $value) {
                if (in_array($value, array_keys($features))) {
                    $items->where($value, 1);
                }
            }

            return view('divota.accommodations', [
                'items' => $items->get(),
                'type' => $type ?? false,
                'page_name' => $page_name,
                'features' => $features,
            ]);
        }
    }
    public function cart()
    {
        return view('divota.cart', [
            'page_name' => 'Cart',
        ]);
    }
    public function checkout()
    {
        return view('divota.checkout', [
            'page_name' => 'Checkout',
        ]);
    }
    public function checkout_success($id)
    {
        $data['order'] = Booking::findOrFail($id);
        $data['page_name'] = 'Checkout Success';
        return view('divota.checkout-success', $data);
    }
}

