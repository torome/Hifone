@extends('layouts.default')

@section('title')
{{{ $user->username }}} {{ trans('hifone.users.info') }}_@parent
@stop

@section('content')

<div class="users-show">

  <div class="col-md-3 box">
    @include('users.partials.basicinfo')
  </div>

  <div class="col-md-9 left-col">

    @if ($user->is_banned)
      <div class="text-center alert alert-info"><b>{{ trans('hifone.users.is_banned') }}</b></div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
      @include('users.partials.infonav')
        
            <div class="user-card">
                <div class="header">
                  <a class="avatar" href="{{ $user->url }}" target="_blank"><img src="{{ $user->avatar }}"><strong><span>{{ '@'.$user->username }}</span></strong></a>
                  @if($current_user && $current_user->id != $user->id)
                  <a class="button" data-method="post" data-url="{{ route('follow.user',$user->id) }}" target="_blank">
                    @if (Auth::check() && $user->follows()->byWhom(Auth::user()->id)->count())
                      <i class="fa fa-minus"></i> {!! trans('forms.cancel') !!}
                    @else
                      <i class="fa fa-plus"></i> {!! trans('hifone.follow') !!}
                    @endif
                  </a>
                  @endif
                </div>
                <ul class="status">
                  <li><a href="{!! route('user.threads', $user->id) !!}"><strong>{{ $user->thread_count }}</strong>{{ trans('hifone.threads.threads') }}</a></li>
                  <li><a href="{!! route('user.replies', $user->id) !!}"><strong>{{ $user->reply_count }}</strong>{{ trans('hifone.replies.replies') }}</a></li>
                  <li><a href="#"><strong>0</strong>{{ trans('hifone.users.followers') }}</a></li>
                </ul>
                <div class="footer">
                {{ $user->bio }}
                </div>
          </div>
          </div>
</div>
</div>
</div>
@stop
