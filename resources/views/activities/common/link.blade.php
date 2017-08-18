<h3>
	Submission
</h3>

<blockquote>
    {!! $link->text !!}
	<footer>
	    <em>This
	    {{ strtolower($link->type_str) }}
		was submitted by
		@if ($link->link_type >= 3)
		    @if ($link->user->id == 3 || $link->user->fname == 'Guest')
			    a <strong>{{ strtolower($link->user->fname) }}</strong>.
			@else
			    <strong>{{ $link->user->fname }}</strong>.
			@endif
		    </em><!-- 
		     -->{{--@if ($link->text2) 
		        <!-- <p><em>Here's what they said about how it relates,</em> "{{ $link->text2 }}".</p> -->
		        <em>because,</em> "{{ $link->text2 }}".
		    @else<!-- 
		         -->.
		    @endif--}}
		{{--@else
		    <p><em>Here's a reference related to this idea.</em></p>--}}
		@else
			a <strong>project organizer</strong>.
		@endif
	</footer>
</blockquote>