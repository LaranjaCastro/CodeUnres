@include('web.layouts.backend.header')

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <h2>文章列表</h2>

    <div class="row">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分组列表</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="typography.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="typography.html#">选项1</a>
                            </li>
                            <li><a href="typography.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content no-padding width 800">
                    <ul class="list-group">
                        @foreach($data['list'] as $k => $v)
                        <li class="list-group-item" data-id="{{ $v['id'] }}"><span class="badge badge-primary">16</span>{{ $v['title'] }}<span class="text-right mail-date" style="float: right">{{ $v['create_time'] }}　</span>
                            <button type="button" class="btn btn-outline btn-info">{{ $v['menu'] }}</button>
                            <button type="button" class="btn btn-outline btn-info" value="{{ $v['recommend'] }}" name="recommend">{{ $v['recommendMark'] }}</button>
                            <button type="button" class="btn btn-outline btn-info"><a href="{{ $v['url'] }}">查看</a></button>
                            <div class="btn-group" style="">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="true">操作 <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="buttons.html#">置顶</a>
                                    </li>
                                    <li><a href="/book/{{ $v['id'] }}" class="font-bold">修改</a>
                                    </li>
                                    <li><a href="buttons.html#">禁用</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#" name="del" data-id="{{ $v['id'] }}">删除</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</body>
</html>
@include('web.layouts.backend.footer')
<script>

    // =====================> 删除文章

    $('a[name=del]').on('click', function () {
        var id = $(this).data('id');
        var _token = $("input[name=_token]").val();
        layer.confirm('您确定要删除吗？', {
            btn: ['确定','取消'], //按钮
            shade: false //不显示遮罩
        }, function(index){

            $.ajax({
                type: 'post',
                url: '/book/del',
                data: {id:id, _token:_token},
                beforeSend: function () { // 请求前加载动画
                    layer.load();
                },
                complete: function () { // 请求后操作
                    layer.closeAll('loading');
                },
                success: function (data) {
                    data= JSON.parse(data);
                    layer.msg(data.msg);
                    if (data.status == 200) {
                        location.reload();
                    }
                }
            });
        });
    })


    // =================> 设置推荐

    $("button[name=recommend]").on('click', function () {
        var _token = $("input[name=_token]").val();
        var bookId = $(this).parent().data('id');
        var state = $(this).val();

        $.ajax({
            type: 'post',
            url: '/book/recommend',
            data: {bookId: bookId, state: state, _token:_token},
            beforeSend: function () { // 请求前加载动画
                layer.load();
            },
            complete: function () { // 请求后操作
                layer.closeAll('loading');
            },
            success: function (data) {
                data= JSON.parse(data);
                if (data.status == 200) {
//                    $(this).html(data.msg);
//                    if (state == 0) {
//                        $(this).val(1);
//                    } else if (state == 1) {
//                        $(this).val(0);
//                    }
                } else {
                    layer.msg(data.msg);
                }
            }
        });
    })

    </script>

