@extends('layouts.app')

@section('title', 'Dev')

@section('content')
    <div class="container">
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th></th>
                @foreach($cols as $col)
                    <th>{{$col->name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                    <tr>
                        <th scope="row">{{$row->name}}</th>
                        @foreach($cols as $col)
                            <td><a href="#" class="btn btn-default" role="button">Activities: 0</a></td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- .container -->
@endsection
