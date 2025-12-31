<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public $class = 'sub_page';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $edit = null;
        if ($request->has('edit')) {
            $edit = $request->get('edit');
        }
        $reservations = Reservation::where('user_id', auth()->id())->orderBy('reservation_date')->get();
        return view('user.reservations', ['edit' => $edit])
            ->with('class', $this->class)
            ->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email',
                'phone' => 'required|string|size:10|regex:/^[0-9]{10}$/',
                'people' => 'required',
                'reservation_date' => 'required|date'
            ]);
            $reservation = Reservation::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'people' => $request->people,
                'reservation_date' => $request->reservation_date,
            ]);

            return redirect()
                ->route('reservation.index')
                ->with('msg', 'Reservation has been updated successfully')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('user.book-table')
            ->with('class', $this->class)
            ->with('reservation', $reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            // update quantity
            $reservation->people = $request->people ?? $reservation->people;
            $reservation->reservation_date = $request->reservation_date ?? $reservation->reservation_date;
            $reservation->updated_at = now();
            $reservation->update();

            return redirect()
                ->route('reservation.index')
                ->with('msg', 'Reservation has been updated successfully')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return redirect()->route('reservation.index')
                ->with('class', 'Reservation has been canceled successfully')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()->route('reservation.index')
                ->with('class', $ex->getMessage())
                ->with('msg_cls', 'warning');
        }
    }
}