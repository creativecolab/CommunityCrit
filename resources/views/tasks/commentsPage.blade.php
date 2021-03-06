{{--@include('tasks.scripts')--}}

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#thoughts" aria-controls="home" role="tab" data-toggle="tab">Share Your Thoughts</a></li>
    <li role="presentation"><a href="#comments" aria-controls="profile" role="tab" data-toggle="tab">Comments</a></li>
</ul>


<!-- Tab panes -->
<div class="tab-content">
    {{--Old Commentform layout--}}
    {{--<div role="tabpanel" class="tab-pane active" id="thoughts">--}}
        {{--<h3>Share Your Thoughts</h3>--}}

        {{--<div class="row" id="shareBtns">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="btn-group">--}}
                    {{--<button class="btn btn-default" value="pro" onclick="createShareForm(value)">I <strong>like</strong>...</button>--}}
                    {{--<button class="btn btn-default" value="con" onclick="createShareForm(value)">I am <strong>concerned</strong> about...</button>--}}
                    {{--<button class="btn btn-default" value="suggestion" onclick="createShareForm(value)">I have a <strong>suggestion</strong>...</button>--}}
                    {{--<button class="btn btn-default" value="question" onclick="createShareForm(value)">I have a <strong>question</strong>...</button>--}}
                    {{--<button class="btn btn-default" value="story" onclick="createShareForm(value)">I have a <strong>story</strong> about...</button>--}}
                    {{--<button class="btn btn-default" value="reference" onclick="createShareForm(value)">This makes me <strong>think of</strong>...</button>--}}
                    {{--@include('tasks.scripts', ['test' => $task->id])--}}
                {{--</div>--}}
                {{--<button class="btn btn-default" value="custom" style="margin-left: 10px;" onclick="createShareForm(value)">(custom)</button>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row is-table-row" id="shareForms">--}}
            {{--<div class="col-sm-6" id="shareForms"></div>--}}
            {{--<!-- new forms go here -->--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--new commentform layout--}}

    <div role="tabpanel" class="tab-pane active" id="thoughts">

        <div class="row" id="shareBtns">
            <div class="col-md-3" style="margin-bottom: 11px;">
                <div class="btn-group-vertical btn-block">
                    <button class="btn btn-default force-text-left" value="pro" onclick="createShareForm(value)">I <strong>like</strong>...</button>
                    <button class="btn btn-default force-text-left" value="con" onclick="createShareForm(value)">I am <strong>concerned</strong> about...</button>
                    <button class="btn btn-default force-text-left" value="suggestion" onclick="createShareForm(value)">I have a <strong>suggestion</strong>...</button>
                    <button class="btn btn-default force-text-left" value="question" onclick="createShareForm(value)">I have a <strong>question</strong>...</button>
                    <button class="btn btn-default force-text-left" value="story" onclick="createShareForm(value)">I have a <strong>story</strong> about...</button>
                    <button class="btn btn-default force-text-left" value="reference" onclick="createShareForm(value)">This makes me <strong>think of</strong>...</button>
                    <button class="btn btn-default force-text-left" value="custom" onclick="createShareForm(value)">(something else)</button>
                    @include('tasks.scripts', ['test' => $task->id])
                </div> <!-- .btn-group-vertical -->
            </div> <!-- .col -->

            <div class="col-md-9">
                <div class="row is-table-row" id="shareFormWrapper">
                    <div id="shareForms"></div>
                </div>
            </div> <!-- .col -->

        </div> <!-- .row -->

        <div class="row" id="myComments">
        </div>
    </div>


        <div role="tabpanel" class="tab-pane" id="comments">
        <div class="row" style="margin-top: 22px;">

            <!-- comment -->
            @foreach($task->feedback as $feedback)
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><span class=@if($feedback->type == 'pro')"label label-success"
                                 @elseif($feedback->type == 'con')"label label-danger"
                                 @elseif($feedback->type == 'suggestion')"label label-default label-purple"
                                 @elseif($feedback->type == 'question')"label label-warning"
                                 @elseif($feedback->type == 'story')"label label-primary"
                                 @elseif($feedback->type == 'reference')"label label-info"
                                 @elseif($feedback->type == 'custom')"label label-default"
                                 @else "label"
                                 @endif>{{$feedback->type}}</span> {!! $feedback->comment !!}</p>
                    </div> <!-- .panel-body -->
                    <div class="panel-footer">
                        {{$feedback->user->fname}} {{$feedback->user->lname}}, {{ $feedback->updated_at->format('m-d-y') }}
                        <div class="likeComment pull-right">
                            <span class="glyphicon glyphicon-thumbs-up" data-state="off" aria-hidden="true"></span><span class="likeCount">{{ rand(1,10) }}</span>
                        </div>
                    </div> <!-- .panel-footer -->
                </div> <!-- .panel -->
            </div>
            @endforeach
        </div>
    </div>

</div>

