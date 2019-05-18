<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProjectModal">
    <i class="fas fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>route('projects.store'),'method'=>'POST','files'=>true]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name','Project Name:') !!}
                    {!! Form::text('name','',['class'=>'form-control']) !!}
                    {!! $errors->create->first('name','<div class="alert alert-danger">:message</div>') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('thumbnail','Project Image:') !!}
                    {!! Form::file('thumbnail',['class'=>'form-control-file']) !!}
                    {!! $errors->create->first('thumbnail','<div class="alert alert-danger">:message</div>') !!}
                </div>
                {{--@include('errors._errors')--}}
                {{--@if($errors->create->any())--}}
                    {{--<ul class="alert alert-danger">--}}
                        {{--@foreach($errors->create->all() as $error)--}}
                            {{--<li>{{$error}}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--@endif--}}
            </div>
            <div class="modal-footer">
                {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>