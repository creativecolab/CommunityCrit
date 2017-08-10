<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Return to Do An Activity</h4>
            </div>
            <div class="modal-body">
                Thanks for your help. Are you sure you want to stop working on this idea?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, continue</button>
                @if ($submit)
                    {!! Form::submit("Yes, I'm done", ['class' => 'btn btn-primary', 'name' => 'exit']) !!}
                @else 
                    <a class="btn btn-primary" href="{{ route( 'main-menu') }}">
                        Yes, I'm done
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>