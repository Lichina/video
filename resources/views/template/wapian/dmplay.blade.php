@extends('template.wapian.layout')
@section('title','')
@section('content')
<div class="container">
    <div class="row">
        <div class="hy-player clearfix">
            <div class="item">
                <div class="col-md-9 col-sm-12 padding-0">
                    <div class="info embed-responsive embed-responsive-4by3 bofangdiv" id="cms_player">
                        <img id="addid" src="" style="display: none;width:100%;border: 0px solid #FF6651">
                        <iframe id="video" src="/jzad" allowfullscreen="true" allowtransparency="true"
                                style="width:100%;border:none;z-index:9999999;"></iframe>
                        <a style="display:none" id="videourlgo" href=""></a>


                    </div>
                    <div class="footer clearfix">
                        <span class="text-muted" id="xuji">战狼影院-正在播放《{{$pm}}》-ZLFLV.COM<span class="js"></span></span>

                    </div>
                    <!--<div class="footer clearfix" id="xlu" style="display:inline-block; height:auto">
                        <span class="text-muted" id="xlus">
                            @foreach($jk as $key=>$v)
                                <a onclick="xldata(this)" data-jk="{{$v}}"   class="btn btn-sm btn-default">{{$key}}</a>
                            @endforeach
                        </span>
                    </div>-->
                </div>
                <div class="col-md-3 col-sm-12 padding-0">
                    <div class="sidebar">
						<div class="hy-play-list play">
								<div class="item tyui" id="dianshijuid">
									<div class="panel clearfix">
										<a class="option collapsed" data-toggle="collapse" data-parent="#playlist"
										   href="#playlist1">播放线路列表<span class="text-muted pull-right"><i
														class="icon iconfont icon-right"></i></span></a>
										<div id="playlist1 xlu" class="playlist collapse in dianshijua">
											<ul class="playlistlink-1 list-15256 clearfix" id="xlus">
												@foreach($jk as $key=>$v)
												<li><a onclick="xldata(this)" data-jk="{{$v}}"   class="btn btn-sm btn-default">{{$key}}</a></li>
												@endforeach
											</ul>

										</div>
									</div>
								</div>
							</div>
                        <div class="hy-play-list play">
                            <div class="item tyui" id="dianshijuid">

                                <div class="panel clearfix">
                                    @foreach($js as $v)
                                    <a class="option collapsed" data-toggle="collapse" data-parent="#playlist" href="#playlist1">{{$v['name']}}<span class="text-muted pull-right"><i class="icon iconfont icon-right"></i></span></a>
                                    <div id="playlist1" class="playlist collapse in dianshijua">
                                        <ul class="playlistlink-1 list-15256 clearfix">
                                            {!! isset($v['data'])?$v['data']:'暂无可用播放源' !!}
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12 hy-main-content">
                    <div class="hy-layout clearfix">
                        <div class="hy-switch-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#list3" data-toggle="tab">剧情介绍</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="hy-play-list tab-pane fade in active" id="list3">
                                <div class="item">
                                    <div class="plot">
                                        <span>简介：</span>{{$desc}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hy-layout clearfix">
                        <div class="hy-video-head">
                            <h3 class="margin-0">影片评论</h3>
                        </div>
                        <div class="ff-forum" id="ff-forum" data-id="37432" data-sid="1">
                            <!-- UY BEGIN -->
                            {!! config('webset.cy') !!}
                            <!-- UY END --></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 hy-main-side hidden-sm hidden-xs">
                    <div class="hy-layout clearfix">
                        <div class="hy-details-qrcode side clearfix">
                            <div class="item">
                                <h5 class="text-muted">扫一扫用手机观看</h5>
                                <p>
                                    <img src="http://qr.liantu.com/api.php?fg=EE1D24&el=l&w=260&m=10&text=<?php  echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" alt="...">.">
                                </p>
                                <p class="text-muted">
                                    分享到朋友圈
                                </p>
                            </div>
                        </div>
                        <div class="hy-video-ranking side clearfix">
                            <div class="head">
                                <a class="text-muted pull-right" href="#"><i class="icon iconfont icon-right"></i></a>
                                <h4>您的播放历史记录</h4>
                            </div>
                            <div class="item">
                                <ul class="clearfix">

                                    @if($history)
                                    @foreach($history as $v)
                                    <li class="text-overflow">
                                        <span class="pull-right text-color">-&gt;&gt;</span>
                                        <a href="{{$v['url']}}" title="{{$v['title']}}">{{$v['title']}}</a>
                                    </li>
                                    @endforeach
                                    @else
                                    <li class="text-overflow">
                                        <span class="pull-right text-color">-&gt;&gt;</span>
                                        <a href="#" title="暂无播放记录"><em class="number active "></em>暂无播放记录</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="ff-hits" id="ff-hits-insert" data-id="37432" data-sid="vod" data-type="insert"></span>
		<style>
			#yss{
				background: deepskyblue;
				color: black;
			}
			</style>
        <script>
            var swiper = new Swiper('.hy-switch', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                slidesPerView: 5,
                spaceBetween: 0,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                breakpoints: {
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 0
                    },
                    767: {
                        slidesPerView: 3,
                        spaceBetween: 0
                    }
                }
            });
        </script>
        <script>
            $(function () {
                $('.title.g-clear').remove();
                $('.all.js-show-init').remove();
                $('.js-tab-wrapper').remove();
                $.each($('.num-tab.js-tabs'),function () {
                    if($(this).children('.num-tab-main').length>1){
                        $(this).children('.num-tab-main:eq(0)').remove();
                    }
                    $(this).children('.num-tab-main').show();
                    $(this).children('.num-tab-main').children('a').addClass('am-btn am-btn-default lipbtn');

                });
                $('.ji-tab-content.js-tab-content').css('opacity',1)
                $.each($('.lipbtn'),function () {
                    var url = $(this).attr('href');
                    $(this).attr('data-href',url);
                    $(this).attr('href','javascript:;');
                    $(this).attr('onclick','bofang(this)');
                });
                var biaoti = $('#xuji').text();
                $('title').text(biaoti);
                $('#xlus li').children('a:eq(0)').attr('id','yss');
                var autourl = $('.lipbtn:eq(0)').attr('data-href');
                $('.lipbtn:eq(0)').attr('id','ys');
                var text = $('.lipbtn:eq(0)').text();
                $('.js').text('--第'+text+'集');
                var jiekou = $('#xlus li').children('a:eq(0)').attr('data-jk');
                if(autourl!=''||autourl!=null){
                    setTimeout(function () {
                        $('#video').attr('src', jiekou + autourl);
                    },3000)
                }
            })
        </script>
        <script>
            function bofang(obj) {
                var href = $(obj).attr('data-href');
                var text = $(obj).text();
                $('.js').text('-第' + text+'集');
                $.each($('.lipbtn'), function () {
                    $(this).attr('id','');
                });
                $(obj).attr('id','ys');
                var jiekou = $('#yss').attr('data-jk');
                if (href != '' || href != null) {
                    $('#video').attr('src', '/jzad');
                    setTimeout(function () {
                        $('#video').attr('src', jiekou + href);
                    },3000)
                }
            }
            function xldata(obj) {
                var url = $(obj).attr('data-jk');
                $.each($('#yss'), function () {
                    //$(this).removeClass('jkbtn');
						$(this).attr('id','');
                });
                //$(obj).addClass('jkbtn');
				$(obj).attr('id','yss');
                var src = $('#ys').attr('data-href');
                $('#video').attr('src', url + src);
            }
        </script>
        <span class="ff-record-set" data-sid="1" data-id="37432" data-id-sid="1" data-id-pid="1">
</span>

        @endsection