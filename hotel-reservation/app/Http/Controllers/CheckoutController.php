<?php

namespace App\Http\Controllers;

use App\Models\Reserves;
use App\Models\Rooms;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {

        $room = Rooms::find($id);

        return view('checkout', compact('room'));

    }

    public function book(Request $req, $id)
    {

        $checkinDate = $req['checkin'];
        $checkoutDate = $req['checkout']; 
        $room = Rooms::with('reserves')->find($id);

        $checkin = Carbon::parse($checkinDate);
        $checkout = Carbon::parse($checkoutDate);

        $isAvailable = true;
        foreach ($room->reserves as $reserve) {
            $reserveCheckin = $reserve->checkin;
            $reserveCheckout = $reserve->checkout;

            
            if (($checkin->gte($reserveCheckin) && $checkin->lt($reserveCheckout))
                || ($checkout->gt($reserveCheckin) && $checkout->lte($reserveCheckout))
                || ($checkin->lte($reserveCheckin) && $checkout->gte($reserveCheckout))) {
                $isAvailable = false;
                break;
            }
        }

        if ($isAvailable) {

            $reserve = new Reserves();

            $reserve['user'] = Auth::id();
            $reserve['checkin'] = $req['checkin'];
            $reserve['checkout'] = $req['checkout'];

            $start = new DateTime($req['checkin']);
            $end = new DateTime($req['checkout']);

            $diff = $start->diff($end);

            $reserve['room'] = $id;

            
            $reserve['cost'] = $diff->days * $room['price'];

            $reserve->save();

            return redirect()->route('dashboard');

        } else {

            return redirect()->back()->withErrors('Room is not available');

        }

    }

}
