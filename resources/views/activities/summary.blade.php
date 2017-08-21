@extends('layouts.app')

@section('title', 'Summary')

@section('content')
    <div id="main-menu" class="activity">
        <a type="button" class="btn btn-default" id="back" href="{{ route('main-menu')}}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Do An Activity</a>

        <ul class="list-group">
            <li class="list-group-item" id="idea">
                <h2>
                    Idea<!-- 
                    -->@if ($idea->name)<!-- 
                         -->: {!! $idea->name !!}
                    @endif
                </h2>
                <p><em>Submitted by 
                @if ($idea->user->id == 3)
                    a <strong>{{ strtolower($idea->user->fname) }}.</strong>
                @else
                    <strong>{{ $idea->user->fname }}.</strong>
                @endif
                </em></p>
                <p>{!! $idea->text !!}</p>
            </li>

            <li class="list-group-item dark" id="question" style="opacity: 0;">
                @if($num_responses > 1)
                    <h1>Great work!</h1>
                    <h4>Thank you for your {{$num_responses}} contributions.</h4>
                @elseif($num_responses == 1)
                    <h1>Great work!</h1>
                    <h4>Thank you for your {{$num_responses}} contribution.</h4>
                @else
                    <h1>Try Another Idea</h1>
                    <h4>If these activities did not interest you, try some other ones by picking a different idea.</h4>
                @endif
            </li>

            <li class="list-group-item" id="detail" style="opacity: 0;">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
                        Continue With Activities
                    </a>

                    {{--@if ((count(auth()->user()->feedback) + count(auth()->user()->ideas) + count(auth()->user()->links) + intval(count(auth()->user()->ratings) / 3)) >= 5)--}}
                        {{--<a class="btn btn-primary" href="{{ route( 'exit') }}">--}}
                            {{--Go to Exit Survey--}}
                        {{--</a>--}}
                    @if (auth()->user()->submitted < 1)
                        <a class="btn btn-primary disabled" data-toggle="tooltip" data-placement="bottom" title="You must complete one activity before taking the exit survey.">Go to Exit Survey</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('exit') }}">Go to Exit Survey</a>
                    @endif
                    {{--@endif--}}
                </div>
                <div class="clearfix"></div>
            </li>
        </ul>
    </div>

@endsection

@section('custom-script')
    <script>
    @if (auth()->user()->submitted < 1)
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
    @endif
    </script>
@endsection