@extends('public.admin')
@section('bannner','active opened active')
@section('bannerlist','active')
@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑轮播</h3>
                    <div class="panel-options">

                    </div>
                </div>
                <div class="panel-body">

                    <form role="form" class="form-horizontal" id="myform" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-1">轮播名称</label>

                            <div class="col-sm-10">
                                <input type="hidden" value="{{$id}}" name="bannerid">
                                <input type="text" class="form-control" id="field-1" value="{{$banner['bannername']}}" name="bannername" placeholder="请输入轮播名称" required>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-2">轮播图片地址</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-2" value="{{$banner['bannerimg']}}" name="bannerimg" placeholder="请输入轮播图片地址" required>
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-3">轮播链接地址</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="field-3" name="bannerlink" value="{{$banner['bannerlink']}}" placeholder="请输入轮播链接地址" required>
                            </div>
                        </div>
                        <div class="form-group-separator"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="field-5"></label>
                            <button type="button" class="btn btn-info btn-single" id="submit">更新</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
    <script>
        $(function () {
            $('#submit').click(function () {
                var bannername = $('#field-1').val();
                var bannerimg = $('#field-2').val();
                var bannerlink = $('#field-3').val();
                if(bannername==''||bannerlink==''||bannerimg==''){
                    layer.msg('请填写完整信息')
                    return false;
                }
                var fm = new FormData($('#myform')[0]);
                $.ajax({
                    type:"post",
                    url:"/action/editbanner",
                    dataType:"json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: fm,
                    processData: false,
                    contentType: false,
                    success: function (resp){
                        if(resp.status==200){
                            layer.msg(resp.msg);
                            window.location = '/{{$webset['webdir']}}/bannerlist'
                        }
                        else {
                            layer.msg(resp.msg)
                        }
                    }
                })
            })
        })
    </script>
@endsection