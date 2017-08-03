@if ($link->link_type >= 3)
    <p><em>
    @if ($link->user->id == 3)
    	A <strong>{{ strtolower($link->user->fname) }}</strong>
    @else
    	<strong>{{ $link->user->fname }}</strong>
    @endif
    submitted the reference below to improve this idea</em><!-- 
     -->@if ($link->text2) 
        <!-- <p><em>Here's what they said about how it relates,</em> "{{ $link->text2 }}".</p> -->
        <em>because,</em> "{{ $link->text2 }}".
    @else<!-- 
         -->.
    @endif
    </p>
@else
    <p><em>Here's a reference related to this idea.</em></p>
@endif
<blockquote>
    {!! $link->text !!}
</blockquote>