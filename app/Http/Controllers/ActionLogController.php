<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;



class ActionLogController extends Controller
{
    public function actionLogs()
    {
        $query = ActionLog::with(['user','product'])->latest();

        // filters (if you use them)
        if(request('type') == 'created'){
            $query->where('action','created');
        }elseif(request('type') == 'purchased'){
            $query->where('action','purchased');
        }

        $totalLogs = $query->count();   // total count before pagination
        $actionLogs = $query->paginate(10);

        return view('admin.actionLogs.actionLogs',compact('actionLogs','totalLogs'));
    }

    }

