{!! Form::open(['route'=>['tasks.store','project'=>$project->id],'method'=>'POST']) !!}
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fa fa-plus"></i>
        </div>
    </div>
    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'ミッション内容は何でしょう']) !!}
    <input type="submit" class="btn btn-primary" value="提出">
    {{--{!! Form::hidden('project',$project->id) !!}--}}
</div>
{{--@if($errors->create->any())--}}
    {{--<div class="alert alert-danger" role="alert">--}}
        {{--<strong>{{$errors->create->first()}}</strong>--}}
    {{--</div>--}}
{{--@endif--}}
{!! $errors->create->first('name','<div class="alert alert-danger">:message</div>') !!}
{!! $errors->create->first('project','<div class="alert alert-danger">:message</div>') !!}
{!! Form::close() !!}