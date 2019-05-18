<div class="modal fade" id="editProjectModal-{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="editProjectModal-{{$project->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModal-{{$project->id}}">プロジェクト編集:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($project,['route'=>['projects.update',$project->id],'method'=>'PATCH','files'=>true]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name','Project Name:') !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                    {!! $errors->getBag('update-'.$project->id)->first('name','<div class="alert alert-danger">:message</div>') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('thumbnail','Project Image:') !!}
                    {!! Form::file('thumbnail',['class'=>'form-control-file']) !!}
                    {!! $errors->getBag('update-'.$project->id)->first('thumbnail','<div class="alert alert-danger">:message</div>') !!}
                </div>
                {{--@if($errors->getBag('update-'.$project->id)->any())--}}
                    {{--<ul class="alert alert-danger">--}}
                        {{--@foreach($errors->getBag('update-'.$project->id)->all() as $error)--}}
                            {{--<li>{{$error}}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--@endif--}}
            </div>
            <div class="modal-footer">
                {!! Form::submit('Edit',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>