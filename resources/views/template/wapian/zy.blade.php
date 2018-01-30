@extends('template.wapian.layout')
@section('body','vod-type apptop')
@section('title','火爆综艺')
@section('content')
    <div class="container">
        <div class="row">
            <div class="hy-cascade clearfix">
                <div class="left-head hidden-sm hidden-xs">
                    <ul class="clearfix">
                        <li class="text"><span class="text-muted">当前频道</span></li>
                        <li><a href="/zylist/all/1.html"  class="active">综艺</a></li></ul>
                </div>
                <div class="content-meun clearfix">
                    <a class="head" href="javascript:;" data-toggle="collapse" data-target="#collapse">
                        <span class="text">综艺分类</span></a>
                    <div class="item collapse in" id="collapse">
                        <ul class="visible-sm visible-xs clearfix">
                            <li class="text"><span class="text-muted">按频道</span></li>
                            <li><a href="/zylist/all/1.html" id="idc4ca4238a0b923820dcc509a6f75849b">综艺</a></li>					</ul>

                        <ul class="clearfix">
                            <li><a href="/zylist/all/1.html" class="acat" style="white-space: pre-wrap;">全部</a></li>
                            @foreach($zytype as $key=>$v)
                                <li><a href='/zylist/{{$v}}/1.html' class='acat' style='white-space: pre-wrap;margin-bottom: 4px;'>{{$key}}</a></li>
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
                        <li class="active"><a href="#">最新综艺</a></li>
                    </ul>
                </div>
                <div class="hy-video-list">
                    <div class="item">
                        <ul class="clearfix">
                            @foreach($zys as $zy)
                                <div class="col-md-2 col-sm-3 col-xs-4">
                                    <a target="_blank" class="videopic lazy xwcms" href="/play/{{$zy['url']}}.html" title="{{$zy['title']}}" src="{{$zy['img']}}" onclick="jilu(this)" style="background: url({{$zy['img']}}) no-repeat; background-position:50% 50%; background-size: cover;border-radius: 5px;"><span class="play hidden-xs"></span><span class="score">{{$zy['js']}}</span></a>
                                    <div class="title">
                                        <h5 class="text-overflow"><a href="/play/{{$zy['url']}}.html" title="{{$zy['title']}}" src="{{$zy['img']}}" onclick="jilu(this)">{{$zy['title']}}</a></h5>
                                    </div>
                                    <div class="subtitle text-muted text-muted text-overflow hidden-xs"></div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="hy-page clearfix">
                    <ul class="cleafix">
                        {!! $pagehtml !!}
                        <li><a>共24页</a></li></ul>
                </div>		</div>
        </div>
    </div>
@endsection