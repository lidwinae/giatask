<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class KalenderController extends Controller
{
    public function getEvents()
    {
        $userId = Auth::id();

        $events = Tugas::where('user_id', $userId)
                       ->select('nomor', 'judul', 'status', 'tanggal_tenggat')
                       ->get();

        // Format data menjadi array untuk FullCalendar
        $calendarEvents = $events->map(function($event) {
            return [
                'title' => $event->nomor . '. ' .$event->judul,
                'start' => $event->tanggal_tenggat,
                'status' => $event->status,
            ];
        });

        // Kembalikan data dalam format JSON
        return response()->json($calendarEvents);
    }
}
