<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class TrackController extends Controller
{
    public function index() {
        $limit_date = date('Y-m-d', strtotime('-1 year'));

        $old_data = Log::whereDate('time_id', '<', $limit_date)->get();
        foreach($old_data as $data) {
            $data->delete();
        }

        $this->data['items'] = Log::getAll();
        return view('track.index', $this->data);
    }
}
