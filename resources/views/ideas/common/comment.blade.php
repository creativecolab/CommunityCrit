<ul class="list-group">
    <li class="list-group-item dark" id="question">
        <h3>
            Share Your Thoughts on This Idea
        </h3>
    </li>
    <li class="list-group-item" id="detail">
        <div id="response">
            {!! Form::open(['action' => ['IdeaController@submitComment', $idea->id]]) !!}
            <div class="form-group">
                {{ Form::textarea('text', '', ['class' => 'form-control', 'id' => 'submissionText', 'rows' => '3', 'placeholder' => "Please enter your response here."]) }}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right']) !!}
            </div>
            <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </li>
</ul>