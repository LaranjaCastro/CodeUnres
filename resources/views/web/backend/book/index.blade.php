
@include('web.layouts.backend.header')
<body class="gray-bg">
<!--引入wangEditor.css-->
<link rel="stylesheet" type="text/css" href="{{ url('/static/editor/wangEditor/dist/css/wangEditor.min.css') }}">
<div class="wrapper wrapper-content animated fadeInRight">

    <h2>发布文章</h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form class="form-horizontal">

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题：</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" placeholder="" class="form-control" name="title" value="{{ $content['title']}}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">类别：</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control m-b" id="sel">
                                            @foreach($menu as $k=>$v)
                                            <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">内容：</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-10">
                        <textarea id="textarea1" style="height:600px; width: 800px">
                            {{ $content['content']}}
                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary"  value="{{ $signal }}" data-id="{{ $content['id'] }}" name="save">保存内容</button>
                                <button class="btn btn-white" type="submit">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="category" value="{{ $content['category'] }}">
</body>
</html>
@include('web.layouts.backend.footer')
<!--引入jquery和wangEditor.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
<script type="text/javascript" src="{{ url('/static/editor/wangEditor/dist/js/wangEditor.js') }}"></script>
<!--这里引用jquery和wangEditor.js-->
<script type="text/javascript">
    var editor = new wangEditor('textarea1');
    editor.create();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ==========================> 添加文章 || 更新文章

    $("button[name=save]").click('on', function () {
        var title = $("input[name=title]").val();
        var _token = $("input[name=_token]").val();
        var menu = $(".m-b option:selected").val();
        var content = editor.$txt.html();
        var check_content = editor.$txt.text();
        var operating = $(this).val();
        var book_id = $(this).data('id');
        if (operating == 'save') {
            new_url = 'news';
        } else if (operating == 'update') {
            new_url = 'up';
        }

        if (! title) {
            layer.msg('标题不能为空'); return false;
        } else if (! menu) {
            layer.msg('类别没有填写'); return false;
        } else if ($.trim(check_content) == '') {
            layer.msg('内容还没填写哦'); return false;
        }
            $.ajax({
                type: 'post',
                url: '/book/'+ new_url,
                data: {title:title, menu:menu, content:content, _token:_token, signal: operating, bookId:book_id},
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
                        setTimeout('locations()', 1500);
                    }
                }
            });
        return false;
    })


    $(document).ready(function () {
        var options = $('input[name=category]').val();
        if (options) {
            $("#sel option[value="+ options +"]").attr('selected', 'selected');
            $("#save").prop('name', 'update');
        }
    })

    function locations() {
        location.href='/book/list';
    }
</script>

