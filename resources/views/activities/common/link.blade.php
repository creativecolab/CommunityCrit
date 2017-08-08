<h4>
	@component('utilities.link_type_name', ['link_type' => $link->link_type])
	@endcomponent
</h4>

<blockquote style="margin-bottom: 0;">
    {!! $link->text !!}
    <footer>
    	@if ($link->link_type >= 3)
		    <em>Submitted by
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
		@endif
    </footer>
</blockquote>