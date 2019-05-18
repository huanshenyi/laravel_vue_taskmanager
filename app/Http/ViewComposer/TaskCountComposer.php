<?php
namespace App\Http\ViewComposer;

use App\Repositories\TasksRepository;
use Illuminate\Contracts\View\View;

class TaskCountComposer
{
    protected $task;

    public function __construct(TasksRepository $repository)
    {
       $this->task = $repository;
    }

    public function compose(View $view)
    {
        if(auth()->user()){
            $view->with([
                'total'=>$this->task->totalCount(),
                'todo'=>$this->task->todoCount(),
                'doneCount'=>$this->task->donesCount()
            ]);
        }
    }
}