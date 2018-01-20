<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Ticket;
use App\Booking;
use App\Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $tickets = $request->session()->get('cart.tickets');
        $sessions = Session::with(['movie', 'cinema']);

        return view('cart.index', compact('tickets', 'sessions'));
    }

    public function store(Request $request)
    {
        $tickets = array();

        // Only has to cart tickets with amounts greater than 0
        if ($request->get('adult-tickets-amount') > 0) {
            array_push($tickets, new Ticket(array('type' => 'adult', 'amount' => $request->get('adult-tickets-amount'), 'session_id' => $request->get('session'))));
        }
        if ($request->get('child-tickets-amount') > 0) {
            array_push($tickets, new Ticket(array('type' => 'child', 'amount' => $request->get('child-tickets-amount'), 'session_id' => $request->get('session'))));
        }
        if ($request->get('concession-tickets-amount') > 0) {
            array_push($tickets, new Ticket(array('type' => 'concession', 'amount' => $request->get('concession-tickets-amount'), 'session_id' => $request->get('session'))));
        }
        if ($request->get('student-tickets-amount') > 0) {
            array_push($tickets, new Ticket(array('type' => 'student', 'amount' => $request->get('student-tickets-amount'), 'session_id' => $request->get('session'))));
        }

        // User has to be logged in
        if ($request->user != null) {
            foreach ($tickets as $ticket) {
                $request->session()->push('cart.tickets', $ticket);
            }

            return redirect('cart');
        } else {
            return redirect('login');
        }
    }

    public function update(Request $request)
    {
        $tickets = $request->session()->get('cart.tickets');
        $ticketNo = $request->get('ticket-no');
        $ticketAmount = $request->get('ticket-amount');

        // Update tickets with amount > 0 otherwise delete from cart
        if ($ticketAmount > 0) {
            $tickets[$ticketNo]->amount = $ticketAmount;
        } else {
            unset($tickets[$ticketNo]);
        }

        // Reassign cart sesion, pushing each ticket to ensure proper indexes
        $request->session()->forget('cart.tickets');
        foreach ($tickets as $ticket) {
            $request->session()->push('cart.tickets', $ticket);
        }

        return redirect('cart');
    }

    public function delete(Request $request)
    {
        $tickets = $request->session()->get('cart.tickets');

        unset($tickets[$request->get('ticket-no')]);

        // Reassign cart sesion, pushing each ticket to ensure proper indexes
        $request->session()->forget('cart.tickets');
        foreach ($tickets as $ticket) {
            $request->session()->push('cart.tickets', $ticket);
        }

        return redirect('cart');
    }

    public function checkout(Request $request)
    {
        $tickets = $request->session()->get('cart.tickets');

        return view('cart.checkout', compact('tickets'));
    }

    public function checkoutStore(CheckoutFormRequest $request)
    {
        $booking = new Booking();
        $booking->user_id = Auth::user()->id;
        $booking->name = $request->get('name');
        $booking->address = $request->get('address');
        $booking->suburb = $request->get('suburb');
        $booking->state = $request->get('state');
        $booking->postcode = $request->get('postcode');
        $booking->mobile_number = $request->get('mobile-number');
        $booking->save();

        $tickets = $request->session()->get('cart.tickets');
        foreach ($tickets as $ticket) {
            $dbTicket = new Ticket();
            $dbTicket->type = $ticket->type;
            $dbTicket->amount = $ticket->amount;
            $dbTicket->booking_id = $booking->id;
            $dbTicket->session_id = $ticket->session_id;
            $dbTicket->save();
        }

        // Clean cart after checkout
        $request->session()->forget('cart.tickets');

        return redirect('account');
    }
}
