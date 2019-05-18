{!! Form::open(['route'=>['tasks.destroy',$task->id],'method'=>'DELETE']) !!}
 <button class="btn btn-danger btn-sm" type="submit">
     <i class="fas fa-times"></i>
 </button>
{!! Form::close() !!}