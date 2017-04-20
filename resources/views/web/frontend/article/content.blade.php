@extends('web.layouts.frontend.main')

@section('nav')
    <div class="post-header"><label class="navi-button light" for="navi">MENU</label><img class="background"
                                                                                          src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1492593499139&di=679ce42ec48b0d76ba2bd044fb536c19&imgtype=0&src=http%3A%2F%2Fimg.zcool.cn%2Fcommunity%2F01ee5e57d908280000012e7e33d166.jpg%40900w_1l_2o_100sh.jpg">
        <div class="post-title"><h1 class="title">{{ $content['title'] }}</h1>
            <ul class="meta">
                <li><i class="icon icon-author"></i>{{ $content['name'] }}</li>
                <li><i class="icon icon-clock"></i>{{ $content['markTime'] }}</li>
                <li><i class="icon icon-calendar"></i>{{ $content['create_time'] }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="article-content" style="max-width:800px">
        <div>{!! $content['content'] !!}</div>
    </div>


    <style>
        .languages:before {
            position: absolute;
            /*top: 0;*/
            right: 4%;
            color: #bdc3c7;
            text-align: right;
            font-size: 0.75em;
            padding: 5px 10px 0;
            line-height: 15px;
            height: 15px;
            font-weight: 600;
            font-family: 'Roboto Mono', 'Monaco, courier', 'monospace';
        }
    </style>
    <script>
        $(document).ready(function () {
            var leonLanguage = $('code').attr('class');
            var arrLeonLanguage = leonLanguage.split(' ');
            if (arrLeonLanguage) {
                var codeCss = arrLeonLanguage[0].toUpperCase();
                if (codeCss) {
                    $("<style>.languages:before{content:'" + codeCss + "'}</style>").appendTo('pre');
                    $('pre').addClass('languages');
                }
            }
        })
    </script>

@endsection