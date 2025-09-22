<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $uid = Auth::id();

        // Discover columns from SQLite 
        $eventCols = collect(DB::select('PRAGMA table_info(events)'))->pluck('name')->toArray();

        // Pick columns safely from known possibilities
        $titleCol = $this->pickColumn($eventCols, ['title', 'name']);
        $capCol   = $this->pickColumn($eventCols, ['capacity', 'cap', 'seats', 'total_capacity']);
        $dateCol  = $this->pickColumn($eventCols, ['date', 'event_date', 'starts_at', 'start_date', 'start_time']);
        $fkCol    = $this->pickColumn($eventCols, ['user_id', 'organiser_id', 'owner_id', 'creator_id']);

        // Build SELECT list 
        $selects = [
            "e.id AS id",
        ];
        if ($titleCol) $selects[] = "e.$titleCol AS event_title";
        if ($capCol)   $selects[] = "COALESCE(e.$capCol, 0) AS total_capacity";
        if ($dateCol)  $selects[] = "e.$dateCol AS event_date";

        
        $selectSql = implode(",\n            ", $selects);

        // WHERE 
        $whereSql = '';
        $bindings = [];
        if ($fkCol) {
            $whereSql = "WHERE e.$fkCol = ?";
            $bindings[] = $uid;
        }

        // ORDER BY
        $orderSql = $dateCol ? "ORDER BY e.$dateCol DESC" : "ORDER BY e.id DESC";

        // RAW SQL 
        $sql = <<<SQL
            SELECT
                $selectSql
            FROM events e
            $whereSql
            $orderSql
        SQL;

        $report = DB::select($sql, $bindings);

        // Also show which columns was found 
        $debug = [
            'events_columns' => $eventCols,
            'picked' => [
                'titleCol' => $titleCol,
                'capCol'   => $capCol,
                'dateCol'  => $dateCol,
                'fkCol'    => $fkCol,
            ],
            'sql' => $sql,
            'bindings' => $bindings,
        ];

        return view('dashboard', [
            'report' => $report,
            'debug'  => $debug,
        ]);
    }

    private function pickColumn(array $columns, array $candidates): ?string
    {
        foreach ($candidates as $c) {
            if (in_array($c, $columns, true)) return $c;
        }
        return null;
    }
}
