<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todo = \DB::table('todo')->where("user_id", \Auth::user()->id)->paginate(15);
        return view('home')->with("todo", $todo);
    }

    public function addtask(Request $request){
        $request->validate([
            "name"=>"required",
            "description"=>"required",
        ]);
        if($request->id == 0){
            if(\DB::table('todo')->insert(["name"=>$request->name, "description"=>$request->description, "status"=>0, "user_id"=>\Auth::user()->id, "task_date"=>\Carbon\Carbon::now()])){
                return redirect()->back()->with("success", "Task Created Successfully");
            }else{
                return redirect()->back()->with("error", "Error saving data!");
            }
        }else{
            if(\DB::table('todo')->where("id", $request->id)->update(["name"=>$request->name, "description"=>$request->description, "status"=>0, "user_id"=>\Auth::user()->id, "task_date"=>\Carbon\Carbon::now()])){
                return redirect()->back()->with("success", "Task Updated Successfully");
            }else{
                return redirect()->back()->with("error", "Error saving data!");
            }
        }
    }

    public function complete(Request $request){
        if(\DB::table("todo")->where("id", $request->id)->update(["status"=>1])){
            return redirect()->back()->with("success", "Task Updated Successfully");
        }else{
            return redirect()->back()->with("error", "Unable to update");
        }
    }

    public function remove(Request $request){
        if(\DB::table("todo")->where("id", $request->id)->delete()){
            return redirect()->back()->with("success", "Task removed successfully!");
        }else{
            return redirect()->back()->with("error", "Unable to update");
        }
    }

    public function task(Request $request){
        $task = \DB::table("todo")->where("id", $request->id)->first();
        if($task == null){
            return redirect()->to("home")->with("error", "Invalid task id");
        }
        return view("task")->with("task", $task);
    }
}
