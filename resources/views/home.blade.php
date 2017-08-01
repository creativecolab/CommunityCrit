@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    CommunityCrit allows for the public to learn about urban design proposals and give feedback.
                </div>
                
                <div class="panel-footer text-right">
                    <a href="{{ action('TaskController@allActivities') }}" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </div>
@endsection
