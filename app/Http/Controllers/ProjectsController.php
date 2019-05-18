<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use App\Repositories\ProjectsRepository;
use Carbon\Carbon;

class ProjectsController extends Controller
{

    protected $repository;


    public function __construct(ProjectsRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    public function index()
    {
//        $projects = \request()->user()->projects()->get();
        $projects = $this->repository->list();
        return view('welcome',compact('projects'));
    }

    //増(create)
    public function create()
    {
        //show create from view
    }

    public function store(CreateProjectRequest $request)
    {
         $this->repository->create($request);
         return back();
    }

    //削除(destroy)
    public function destroy($id)
    {
        $this->repository->delete($id);
        return back();
    }

   //修正(update)
    public function edit()
    {
        //show update from view
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $this->repository->update($request,$id);
        return back();
    }

    //(show/read)
    public function show(Project $project)
    {
//        return Carbon::createFromDate(2019)->addYears(1);
//        return Carbon::createFromDate(1988,9,1)->age;
//        return Carbon::now()->subMinutes(8)->diffForHumans();
//        $project = $this->repository->find($id);

        $todos = $this->repository->todos($project);
        $dones = $this->repository->dones($project);
        $projects = auth()->user()->projects()->pluck('name','id');

        return view('projects.show',compact('project','todos','dones','projects'));
    }





}
