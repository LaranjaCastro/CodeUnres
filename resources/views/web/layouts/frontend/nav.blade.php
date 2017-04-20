{{--<nav class="navbar navbar-inverse " style="background-color: #24292E; border-bottom: 1px solid #24292E; margin-bottom:0px">--}}
    {{--<div style="height: 30px; margin-top: 2%; text-align: center; border-bottom: 1px solid #E8E8E8" >--}}
        {{--<spna>时下流行</spna>--}}
        {{--<spna>最新文章</spna>--}}
        {{--<spna>最新文章</spna>--}}
    {{--navbar-fixed-top--}}
    {{--</div>--}}
{{--</nav>--}}
{{--<div style="background-color: #FAFBFC; width: 100%; line-height: 45px;" class="customize">--}}
    {{--<div style="width: 80%; font-size: 16px">--}}
        {{--@foreach(Session::get('menu') as $key=>$item)--}}
            {{--<span><a style="color:#24292E; font-weight: bold" href="{{ $item['url'] }}"> @if($item['id'] != 1)/ @endif{{ $item['name'] }}</a></span>--}}
        {{--@endforeach--}}
    {{--</div>--}}
{{--</div>--}}

{{--<style>--}}
    {{--.customize div{--}}
        {{--margin: auto;--}}
        {{--text-align: center;--}}
    {{--}--}}
{{--body {--}}
    {{--font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";--}}
{{--}--}}
    {{--</style>--}}
@yield('nav','<div class="page-header"><label class="navi-button" for="navi">MENU</label>
    <div class="background"><img src="http://callfiles.ueibo.com/hexo-theme-laughing/page_background.jpg"></div>
    <div class="author">
        <div class="head"><img src="http://www.leon.com/static/web/frontend/images/80153.jpg"></div>
        <h3 class="name">John Doe</h3>
        <p class="signature">Only when you plant the flowers can you really smell their fragrance.</p></div>
</div>')