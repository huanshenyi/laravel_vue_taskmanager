<?php

namespace App\Http\Controllers;

use App\Http\Requests\createStep;
use App\Step;
use App\Task;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Task $task)
    {
        $steps = $task->steps;
        $todos = $steps->where('completion',0)->values();
        $dones = $steps->where('completion',1)->values();
        return view('steps.show',compact('task','steps','todos','dones'));

        //return $task->steps;
//        return response()->json([
//            'steps'=>$task->steps
//        ],200);
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
    public function store(Task $task, createStep $request)
    {
        //$step->refresh();
        return response()->json([
           'step'=> $task->steps()->create($request->only('name'))->refresh()
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request,Task $task, Step $step)
    {
        $step->update([
           'completion'=>$request->completion
        ]);
    }

    public function update(Request $request,Task $task, Step $step)
    {
        $step->update($request->only('name'));
    }

    public function completeAll(Task $task)
    {
           $task->steps()->update([
               'completion'=>1
           ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task,Step $step)
    {
        $step->delete();
        return response()->json([
            'message'=>'削除しました'
        ],201);
    }

    public function clear(Task $task)
    {
        $task->steps()->where('completion',1)->delete();
    }

}
