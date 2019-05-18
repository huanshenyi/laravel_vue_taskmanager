<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo" role="tab" aria-controls="todo" aria-selected="true">
            進行中
            <span class="badge badge-pill badge-danger">{{count($todos)}}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">
            完成
            <span  class="badge badge-pill badge-success">{{count($dones)}}</span>
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="todo" role="tabpanel" aria-labelledby="todo-tab">
            <table class="table table-striped">
                <tr>
                      <td colspan="4"> @include('tasks._createForm')</td>
                </tr>
                @if(count($todos))
                @foreach($todos as $task)
                   <tr>
                       <td class="col-9">
                           <span class="badge badge-secondary mr-3">{{$task->updated_at->diffForHumans()}}</span>
                           <a href="{{route('tasks.steps.index',$task->id)}}">{{$task->name}}</a>
                       </td>
                       <td>@include('tasks._checkForm')</td>
                       <td>@include('tasks._editModel')</td>
                       <td>@include('tasks._deleteForm')</td>
                   </tr>
                @endforeach
                @else
                    @include('tasks._todoNothing')
                @endif
            </table>

    </div>
    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
        <table class="table table-striped">
            @each('tasks._todoContent',$dones,'task','tasks._todoNothing')
        </table>
    </div>
</div>