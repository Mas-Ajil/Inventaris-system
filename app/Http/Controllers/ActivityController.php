<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    

        public function index()
        {
            $activities = Activity::latest()->paginate(10); // Sesuaikan jumlah pagination
            return view('activity_logs.index', compact('activities'));
        }

}
