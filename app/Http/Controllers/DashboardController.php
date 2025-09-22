<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $organiserId = $request->user()->id;

        // Raw SQL with whtever is the match to count bookings per event 
        $sql = <<<SQL
            SELECT
                e.id,
                e.title      AS event_title,
                e.starts_at  AS event_date,
                e.capacity   AS total_capacity,
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

        $report = DB::select($sql, [$organiserId]);

        return view('dashboard', ['report' => $report]);
    }
}
