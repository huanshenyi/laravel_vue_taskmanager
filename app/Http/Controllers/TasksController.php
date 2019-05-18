<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTask;
use App\Repositories\TasksRepository;
use App\Task;
use foo\bar;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    protected $repository;

    public function __construct(TasksRepository $tasksRepository)
    {
       $this->repository = $tasksRepository;
       $this->middleware('auth');

    }

    public function index()
    {
        $todos = $this->repository->todos();
        $dones = $this->repository->dones();
        $projects = auth()->user()->projects()->pluck('name','id');
        return view('tasks.index',compact('todos','dones','projects'));
    }

    public function search()
    {
        return response()->json([
            "tasks"=> $this->repository->all()
        ],200);
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
    public function store(CreateTask $request)
    {
        $this->repository->create($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

    }

    public function check($id)
    {
        $this->repository->check($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, $id)
    {
        $this->repository->update($request,$id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->repository->destroy($id);
       return back();
    }
}
