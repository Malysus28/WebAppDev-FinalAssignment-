<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // to pull the logged in users id if a they hit this without auth it would be null and get
        $organiserId = $request->user()->id;

        // Raw SQL with whtever is the match to count bookings per event 
        //e.id PK of event // select and count all the rows that match event_id
        //coalesence to handle null values. if the total number of spots for the event null replace null with 0. so minus numbers dont happen. 
        $sql = <<<SQL
            SELECT
                e.id,
                e.title  AS event_title,
                e.starts_at AS event_date,
                e.capacity AS total_capacity,
                (
                    SELECT COUNT(*) 
                    FROM bookings bk
                    WHERE bk.event_id = e.id
                ) AS current_bookings,
                (
                    COALESCE(e.capacity, 0) - (
                        SELECT COUNT(*) 
                        FROM bookings bk
                        WHERE bk.event_id = e.id
                    )
                ) AS remaining_spots
            FROM events e
            WHERE e.organiser_id = ?
            ORDER BY e.starts_at DESC
        SQL;
        
        //
        $report = DB::select($sql, [$organiserId]);
        //load the dashboard view page and sent it to the report data. pass the data to view. 
        return view('dashboard', ['report' => $report]);
    }
}
