<h3>
	Submission
</h3>

<blockquote>
    {!! $link->text !!}
	@if ($link->link_type >= 3)
    	<footer>
		    <em>This
		    {{ strtolower($link->type_str) }}
			was submitted by
		    @if ($link->user->id == 3)
		    	 a <strong>{{ strtolower($link->user->fname) }}.</strong>
		    @else
		    	<strong>{{ $link->user->fname }}.</strong>
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
		</footer>
	@endif
</blockquote>