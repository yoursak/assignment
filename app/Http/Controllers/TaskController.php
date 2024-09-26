<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index(){
        $Users = User::where('USER_TYPE',2)->when(Session('type') == 2,function($query){
            return $query->where('USER_ID',Session::get('id'));
        })->get();
        $Tasks = Task::join('users', 'tasks.ASSIGNED_TO', '=', 'users.USER_ID')->get();
        // dd($Tasks);
        return view('pages.task-management',compact('Users','Tasks'));
    }

    public function dashboard(){
        $UserCount = User::where('USER_TYPE',2)->count();
        return view('pages.dashboard',compact('UserCount'));
    }

    public function createTask(Request $request){
        // dd($request->all());

        $Task = new Task();
        $Task->TITLE = $request->taskName;
        $Task->DESCRIPTION = $request->taskDetails;
        $Task->PRIORITY = $request->taskPriority;
        $Task->DATE = $request->taskDate;
        $Task->PROGRESS = $request->taskStatus;
        $Task->ASSIGNED_TO = $request->asignTo;
        $Task->CREATED_BY = Session::get('id');
        $Task->CREATED_AT = now();
        $Task->save();

        if($Task){
            return redirect()->back()->with('success','Task created successfully');
        }else{
            return redirect()->back()->with('error','Task create Failed');
        }
    }

    public function deleteTask(Request $request){
        // dd($request->all());

        $Task = Task::where('TASK_ID',$request->id)->delete();

        if( $Task ){
            return redirect()->back()->with('success','Task deleted successfully');
        }else{
            return redirect()->back()->with('error','failed');
        }
    }
}
