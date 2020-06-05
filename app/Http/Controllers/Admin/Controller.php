<?php

namespace App\Http\Controllers\Admin;

use App\LogGoalsRecord;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $goalsStats = $this->goalsStats();

        return view('home', ['goalsStats' => $goalsStats]);
    }

    private function goalsStats()
    {
        $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $logGoalsRecords = LogGoalsRecord::selectRaw("extract(month from created_at) AS log_month, count(*)")
            ->where('created_at', '>', DB::raw("'now'::timestamp - '6 month'::interval"))
            ->groupBy('log_month')
            ->orderBy('log_month')
            ->get();

        return ['month' => array_map(function ($record) use ($months) {return $months[$record - 1];}, $logGoalsRecords->pluck('log_month')->toArray()), 'count' => $logGoalsRecords->pluck('count')];
    }
}
