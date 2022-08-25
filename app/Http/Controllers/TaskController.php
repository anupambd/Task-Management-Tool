<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $todo = Task::where('status_id',1)->get();
        $inProgress = Task::where('status_id',2)->get();
        $done = Task::where('status_id',3)->get();
        $totalData = Task::get();
        $allData = ['todo'=>$todo,'inProgress'=>$inProgress,'done'=>$done ];

        return view('task',compact('allData','totalData'));
    }

    public function store(Request $request){
        $request->validate([
            'task_detail' => 'required',
        ]);

        $task = new Task();
        $task->task_detail = $request->task_detail;
        $task->status_id = 1;
        $task->save();
        $allData = Task::get();
        return redirect('/');
//        return view('task',compact('allData'));
    }

    public function update(Request $request){
        $task = new Task();
        $task = Task::find($request->task_id);
        $task->status_id = $request->status_id;
        $task->save();
        return $task;
//        return view('task',compact('allData'));
    }

}
