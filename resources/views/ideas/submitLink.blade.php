@extends('layouts.app')

@section('title', 'Submit Link')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$idea->text}}
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => ['IdeaController@submitLink', $idea->id]]) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Submit a Link</label>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select required id="types" name="dropdown" class="form-control" onchange="showTypes()">
{{--                                        @foreach($options as $option)--}}
                                        <option value="">(select one)</option>
                                        <option>Image</option>
                                        <option>Text</option>
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{--Image Submission--}}
                        <div class="form-group" id="type-image" style="display:none">
                            <label>Choose an image to upload</label>
                            {!! Form::file('photo', ['text-align' => 'left']) !!}

                            <label>Caption your image</label>
                            {!! Form::textarea('caption', '', ['value' => 'caption', 'class' => 'form-control', 'rows' => 1]) !!}
                        </div>

                        {{--Text Submission--}}
                        <div class="form-group" id="type-text" style="display:none">
                            <label>Write text here</label>
                            {!! Form::textarea('text', '', ['value' => 'text', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                {{--                                    <a type="submit" class="btn btn-primary" href="{{ action('SurveyController@index', $page+1) }}">Next</a>--}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <a type="button" class="btn btn-primary" href="#">Skip</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showTypes() {
            var selectVal = document.getElementById("types").value;
            var $typeImage = $('#type-image');
            var $typeText = $('#type-text');
            if (selectVal == "Image") {
                $($typeImage).show();
                $($typeText).hide();
            } else if (selectVal == "Text") {
                $($typeText).show();
                $($typeImage).hide();
            } else {
                $($typeImage).hide();
                $($typeText).hide();
            }
        }
    </script>
@endsection
