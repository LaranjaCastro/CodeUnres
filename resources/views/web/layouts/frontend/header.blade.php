<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="renderer" content="webkit">
    <meta name="referrer" content="always">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="旅行、文艺、音乐、艺术、生活大爆炸"/>
    <meta name="description" content="生活旅行" />
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ url('/static/web/frontend/css/main_style.min.css') }}">
    <link rel="stylesheet" href="{{ url('/static/web/frontend/css/hightlight.css') }}">
    <link rel="shortcut icon" href="http://static.hdslb.com/images/favicon.ico">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
@yield('link')
    <title>
        @yield('title')
    </title>
</head>

