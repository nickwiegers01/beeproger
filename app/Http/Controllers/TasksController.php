<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $tasks = Tasks::where('user_ID', $user_id)->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Het regelen voor het uploaden van een foto
        $file = $request->file('image');
        $folder = public_path().'/UPLOADS';
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid();

        if (empty($file)){
            $upload_name = "no-image.jpg";
        }else{
            $upload_name = $filename.'.'.$extension;
        }

        //Het uploaden van het bestand in de map UPLOADS met een uniqID;
        $file->move($folder, $filename.'.'.$extension);


        $user_id = Auth::user()->id;
        $addTask = new Tasks();
        $addTask->title = request('title');
        $addTask->extras = request('extras');
        $addTask->image = $upload_name;
        $addTask->user_ID = $user_id;
        $addTask->status = "0";

        if ($addTask->save()){
            return redirect()->back()->with('success', 'Uw taak is succesvol toegevoegd aan het systeem');
        }else{
            return redirect()->back()->with('error', 'Taak toevoegen mislukt. Er heeft zich een fout opgetreden');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        $task = $tasks;
        return view('tasks.show', compact('task'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        $edit = $tasks->update(['status' => "1"]);

        if ($edit){
            return redirect(route('task.index'))->with('success', 'U heeft uw taak succesvol afgerond');
        }else{
            return redirect(route('task.index'))->with('error', 'Er heeft zich een fout voorgedaan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks)
    {
        $update = $tasks->update($request->all());
        if ($update){
            return redirect(route('task.index'))->with('success', 'Uw taak is succesvol geupdated');
        }else{
            return redirect(route('task.index'))->with('error', 'Er heeft zich een fout voorgedaan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        $delete = $tasks->delete();
        if ($delete){
            return redirect(route('task.index'))->with('success', 'Uw taak is succesvol verwijderd');
        }else{
            return redirect(route('task.index'))->with('error', 'Er is een fout opgetreden');
        }
    }
}
