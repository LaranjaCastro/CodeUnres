@include('web.layouts.backend.header')

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">H+</h1>

        </div>
        <h3>欢迎使用 H+</h3>

        <div class="m-t" role="form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="用户名" required="" name="name">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="密码" required="" name="passwd">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


            <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
            </p>

        </div>
    </div>
</div>
@include('web.layouts.backend.footer')
{{--<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>--}}
</body>
<script>
    $('.m-b').on('click', function () {
        var name = $("input[name=name]").val();
        var passwd = $("input[name=passwd]").val();
        var _token = $("input[name=_token]").val();

        if (! name) {
            layer.msg('用户名不能为空'); return false;
        } else if (! passwd){
            layer.msg('密码不能为空'); return false;
        }

        $.ajax({
            type: 'post',
            url: '/signin',
            data: {name:name, passwd:passwd, _token:_token},
            beforeSend: function () { // 请求前加载动画
                layer.load();
            },
            complete: function () { // 请求后操作
                layer.closeAll('loading');
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 200) {
                    location.href = '/';
                } else {
                    layer.msg(data.msg);
                }
            }
            
        });

        return false;
    })



</script>
</html>
