<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  var myID = '', admin = 0, type = 0, created_at = '';
  @if (!(Auth::guest()))
	myID = '{{ Auth::user()->id }}';
  admin = {{ Auth::user()->admin }};
  type = {{ Auth::user()->type }};
  created_at = '{{ Auth::user()->created_at }}';
  @endif

  ga('create', 'UA-104110133-1', 'auto', {
  	userId: myID,
    dimension1: myID,
    dimension2: admin,
    dimension3: type,
    dimension4: created_at
  });
  ga('send', 'pageview');

  // ga('create', 'UA-104110133-1', 'auto');
  // ga('send', 'pageview');
  {{--@if (!(Auth::guest()))--}}
  	{{--// ga('set', 'userId', '{{ Auth::user()->id }}'); // Set the user ID using signed-in user_id.--}}
  {{--@endif--}}

</script>