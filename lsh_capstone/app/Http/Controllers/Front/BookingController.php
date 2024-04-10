<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\BookedRoom;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe;

class BookingController extends Controller
{
    public function cart_submit(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'room_id' => 'required',
        'checkin_checkout' => 'required',
        'adult' => 'required'
    ]);

    // Split the check-in and check-out dates
    $dates = explode(' - ', $request->checkin_checkout);
    $checkin_date = $dates[0];
    $checkout_date = $dates[1];

    // Convert check-in and check-out dates to standard format
    $d1 = explode('/', $checkin_date);
    $d2 = explode('/', $checkout_date);
    $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
    $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];
    $t1 = strtotime($d1_new);
    $t2 = strtotime($d2_new);

    // Loop to check availability for each date between check-in and check-out
    $cnt = 1;
    while (1) {
        // Check if check-in date exceeds check-out date
        if ($t1 >= $t2) {
            break;
        }
        $single_date = date('d/m/Y', $t1);
        
        // Count the number of rooms already booked for the selected date
        $total_already_booked_rooms = BookedRoom::where('booking_date', $single_date)->where('room_id', $request->room_id)->count();

        // Retrieve total allowed rooms for the selected room
        $arr = Room::where('id', $request->room_id)->first();
        $total_allowed_rooms = $arr->total_rooms;

        // Check if maximum rooms for the date are already booked
        if ($total_already_booked_rooms == $total_allowed_rooms) {
            $cnt = 0;
            break;
        }
        $t1 = strtotime('+1 day', $t1);
    }

    // If maximum rooms are already booked, redirect with error message
    if ($cnt == 0) {
        return redirect()->back()->with('error', 'Maximum number of this room is already booked');
    }

    // If room is available, add it to the cart session
    session()->push('cart_room_id', $request->room_id);
    session()->push('cart_checkin_date', $checkin_date);
    session()->push('cart_checkout_date', $checkout_date);
    session()->push('cart_adult', $request->adult);
    session()->push('cart_children', $request->children);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Room is added to the cart successfully.');
}


public function cart_view()
{
    // Render the view for the cart page
    return view('front.cart');
}

public function cart_delete($id)
{
    // Create arrays to store cart session data
    $arr_cart_room_id = array();
    $i = 0;
    
    // Copy cart_room_id session data to an array
    foreach (session()->get('cart_room_id') as $value) {
        $arr_cart_room_id[$i] = $value;
        $i++;
    }

    // Similar process for other cart session data
    // Copy cart_checkin_date session data to an array
    $arr_cart_checkin_date = array();
    $i = 0;
    foreach (session()->get('cart_checkin_date') as $value) {
        $arr_cart_checkin_date[$i] = $value;
        $i++;
    }

    // Copy cart_checkout_date session data to an array
    $arr_cart_checkout_date = array();
    $i = 0;
    foreach (session()->get('cart_checkout_date') as $value) {
        $arr_cart_checkout_date[$i] = $value;
        $i++;
    }

    // Copy cart_adult session data to an array
    $arr_cart_adult = array();
    $i = 0;
    foreach (session()->get('cart_adult') as $value) {
        $arr_cart_adult[$i] = $value;
        $i++;
    }

    // Copy cart_children session data to an array
    $arr_cart_children = array();
    $i = 0;
    foreach (session()->get('cart_children') as $value) {
        $arr_cart_children[$i] = $value;
        $i++;
    }

    // Clear the cart session data
    session()->forget('cart_room_id');
    session()->forget('cart_checkin_date');
    session()->forget('cart_checkout_date');
    session()->forget('cart_adult');
    session()->forget('cart_children');

    // Re-add cart session data except for the deleted item
    for ($i = 0; $i < count($arr_cart_room_id); $i++) {
        if ($arr_cart_room_id[$i] == $id) {
            continue;
        } else {
            session()->push('cart_room_id', $arr_cart_room_id[$i]);
            session()->push('cart_checkin_date', $arr_cart_checkin_date[$i]);
            session()->push('cart_checkout_date', $arr_cart_checkout_date[$i]);
            session()->push('cart_adult', $arr_cart_adult[$i]);
            session()->push('cart_children', $arr_cart_children[$i]);
        }
    }

    // Redirect back to the cart page with success message
    return redirect()->back()->with('success', 'Cart item is deleted.');
}



    public function checkout()
    {
        if(!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'You must have to login in order to checkout');
        }

        if(!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'There is no item in the cart');
        }

        return view('front.checkout');
    }

    public function payment(Request $request)
    {
        if(!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'You must have to login in order to checkout');
        }

        if(!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'There is no item in the cart');
        }

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_phone' => 'required',
            'billing_country' => 'required',
            'billing_address' => 'required',
            'billing_province' => 'required',
            'billing_city' => 'required',
            'billing_zip' => 'required'
        ]);

        session()->put('billing_name',$request->billing_name);
        session()->put('billing_email',$request->billing_email);
        session()->put('billing_phone',$request->billing_phone);
        session()->put('billing_country',$request->billing_country);
        session()->put('billing_address',$request->billing_address);
        session()->put('billing_province',$request->billing_province);
        session()->put('billing_city',$request->billing_city);
        session()->put('billing_zip',$request->billing_zip);

        return view('front.payment');
    }


    public function stripe(Request $request,$final_price)
    {
        $stripe_secret_key = config('services.stripe.secret');
        $cents = $final_price*100;
        Stripe\Stripe::setApiKey($stripe_secret_key);
        $response = Stripe\Charge::create ([
            "amount" => $cents,
            "currency" => "php",
            "source" => $request->stripeToken,
            "description" => env('APP_NAME')
        ]);

        $responseJson = $response->jsonSerialize();
        $transaction_id = $responseJson['balance_transaction'];
        $last_4 = $responseJson['payment_method_details']['card']['last4'];

        $order_no = time();

        $statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $ai_id = $statement[0]->Auto_increment;

        $obj = new Order();
        $obj->customer_id = Auth::guard('customer')->user()->id;
        $obj->order_no = $order_no;
        $obj->transaction_id = $transaction_id;
        $obj->payment_method = 'Stripe';
        $obj->card_last_digit = $last_4;
        $obj->paid_amount = $final_price;
        $obj->booking_date = date('d/m/Y');
        $obj->status = 'Completed';
        $obj->save();
        
        $arr_cart_room_id = array();
        $i=0;
        foreach(session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i=0;
        foreach(session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i=0;
        foreach(session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i=0;
        foreach(session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i=0;
        foreach(session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

        for($i=0;$i<count($arr_cart_room_id);$i++)
        {
            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();
            $d1 = explode('/',$arr_cart_checkin_date[$i]);
            $d2 = explode('/',$arr_cart_checkout_date[$i]);
            $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
            $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
            $t1 = strtotime($d1_new);
            $t2 = strtotime($d2_new);
            $diff = ($t2-$t1)/60/60/24;
            $sub = $r_info->price*$diff;

            $obj = new OrderDetail();
            $obj->order_id = $ai_id;
            $obj->room_id = $arr_cart_room_id[$i];
            $obj->order_no = $order_no;
            $obj->checkin_date = $arr_cart_checkin_date[$i];
            $obj->checkout_date = $arr_cart_checkout_date[$i];
            $obj->adult = $arr_cart_adult[$i];
            $obj->children = $arr_cart_children[$i];
            $obj->subtotal = $sub;
            $obj->save();

            while(1) {
                if($t1>=$t2) {
                    break;
                }

                $obj = new BookedRoom();
                $obj->booking_date = date('d/m/Y',$t1);
                $obj->order_no = $order_no;
                $obj->room_id = $arr_cart_room_id[$i];
                $obj->save();

                $t1 = strtotime('+1 day',$t1);
            }

        }

        $subject = 'Thank You for Your Booking with Labason Safe Haven';
        $message = '<p>Dear <strong>'.Auth::guard('customer')->user()->name. '</strong>,</p>';
        $message .= '<p>Thank you for choosing Labason Safe Haven for your upcoming stay. We appreciate your trust in us and are excited to welcome you to our establishment. The booking information is given below: </p>';

        $message .= '<strong>Order No</strong>: '.$order_no;
        $message .= '<br><strong>Transaction Id</strong>: '.$transaction_id;
        $message .= '<br><strong>Payment Method</strong>: Stripe';
        $message .= '<br><strong>Paid Amount</strong>: ₱'.number_format($final_price, 2);
        $message .= '<br><strong>Booking Date</strong>: '.date('d/m/Y').'<br>';

        for($i=0;$i<count($arr_cart_room_id);$i++) {

            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();

            $message .= '<br><strong>Room Name</strong>: '.$r_info->name;
            $message .= '<br><strong>Price Per Night</strong>: ₱'.number_format($r_info->price, 2);
            $message .= '<br><strong>Checkin Date</strong>: '.$arr_cart_checkin_date[$i];
            $message .= '<br><strong>Checkout Date</strong>: '.$arr_cart_checkout_date[$i];
            $message .= '<br><strong>Adult</strong>: '.$arr_cart_adult[$i];
            $message .= '<br><strong>Children</strong>: '.$arr_cart_children[$i].'<br>';
        }            
        $message .= '<p>At Labason Safe Haven, we are committed to providing you with a comfortable and memorable experience. Our team is dedicated to ensuring that your stay exceeds your expectations. </p>';
        $message .= '<p>If you have any special requests or requirements, please feel free to let us know, and we will do our best to accommodate them.</p>';
        $message .= '<p>Once again, thank you for choosing Labason Safe Haven. We look forward to welcoming you and providing you with exceptional hospitality.</p>';
        $message .= 'Warm regards, <br>';
        $message .= '<strong>Celine Lerios</strong> <br>';
        $message .= '<strong>Chief Operating Officer</strong><br>';
        $message .= '<strong>Labason Safe Haven</strong><br>';

        $customer_email = Auth::guard('customer')->user()->email;

        Mail::to($customer_email)->send(new WebsiteMail($subject,$message));

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');
        session()->forget('billing_name');
        session()->forget('billing_email');
        session()->forget('billing_phone');
        session()->forget('billing_country');
        session()->forget('billing_address');
        session()->forget('billing_state');
        session()->forget('billing_city');
        session()->forget('billing_zip');

        return redirect()->route('home')->with('success', 'Payment is successful');

    }
}
