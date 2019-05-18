@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <h3>{{$task->name}}</h3>
        <steps
                route="{{route('tasks.steps.index',$task->id)}}"
                :initial-steps="{{$steps}}"
                :todos="{{$todos}}"
                :dones="{{$dones}}"
        ></steps>

    </div>
@endsection