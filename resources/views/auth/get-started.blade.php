@extends('layouts.app')

@section('title', 'Get Started')

@section('content')
<section id="register">
  <div id="options">
      <ul class="nav nav-pills">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
      </ul>

      <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="register">
        @component('auth.register')
        @endcomponent
      </div>
      <div role="tabpanel" class="tab-pane" id="guest">
        @component('auth.register', [ 'title' => 'Continue as Guest', 'guest' => true ])
        @endcomponent
      </div>
      <div role="tabpanel" class="tab-pane" id="login">
        @component('auth.login')
        @endcomponent
      </div>
    </div>
  </div>
</section>
@endsection