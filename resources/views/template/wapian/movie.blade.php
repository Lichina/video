@extends('template.wapian.layout')
@section('body','vod-type apptop')
@section('title','高清电影')
@section('content')
    <div class="container">
        <div class="row">
            <div class="hy-cascade clearfix">
                <div class="left-head hidden-sm hidden-xs">
                    <ul class="clearfix">
                        <li class="text"><span class="text-muted">当前频道</span></li>
                        <li><a href="/movielist/all/1.html"  class="active">电影</a></li></ul>
                </div>
                <div class="content-meun clearfix">
                    <a class="head" href="javascript:;" data-toggle="collapse" data-target="#collapse">
                        <span class="text">电影分类</span></a>
                    <div class="item collapse in" id="collapse">
                        <ul class="visible-sm visible-xs clearfix">
                            <li class="text"><span class="text-muted">按频道</span></li>
                            <li><a href="/movielist/all/1.html" id="idc4ca4238a0b923820dcc509a6f75849b">电影</a></li>					</ul>

                        <ul class="clearfix">
                            <li><a href="/movielist/all/1.html" class="acat" style="white-space: pre-wrap;">全部</a></li>
                            @foreach($dytype as $key=>$v)
                            <li><a class='acat' style='white-space: pre-wrap;margin-bottom: 4px;' href='/movielist/{{$v}}/1.html' target='_self'>{{$key}}</a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="hy-layout clearfix">
                {!! config('adconfig.list_top') !!}
            </div>
            <div class="hy-layout clearfix" style="margin-top: 0;">
                <div class="hy-switch-tabs active clearfix">
                    <span class="text-muted pull-right hidden-xs">如果您喜欢本站请动动小手分享给您的朋友！</span>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#">最新电影</a></li>
                    </ul>
                </div>
                <div class="hy-video-list">
                    <div class="item">
                        <ul class="clearfix">
                            @foreach($dys as $dy)
                         <div class="col-md-2 col-sm-3 col-xs-4">
							<a target="_blank" class="videopic lazy xwcms" href="/play/{{$dy['url']}}.html" title="{{$dy['title']}}" src="{{$dy['img']}}" onclick="jilu(this)" style="background: url({{$dy['img']}}) no-repeat; background-position:50% 50%; background-size: cover;border-radius: 5px;">
                                <span class="play hidden-xs"></span><span class="score">{{$dy['pf']}}</span></a>
							<div class="title">
								<h5 class="text-overflow"><a href="/play/{{$dy['url']}}.html" title="{{$dy['title']}}" src="{{$dy['img']}}" onclick="jilu(this)">{{$dy['title']}}</a></h5>
							</div>
							<div class="subtitle text-muted text-muted text-overflow hidden-xs">{{$dy['star']}}</div>
						</div>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="hy-page clearfix">
                    <ul class="cleafix">
                        {!! $pagehtml !!}
                        <li><a>共24</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
