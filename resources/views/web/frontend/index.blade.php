@extends('web.layouts.frontend.main')


@section('content')
    <link rel="stylesheet" href="{{ url('/static/web/frontend/page/css/pager.css') }}">
    <script src="{{ url('/static/web/frontend/page/js/jquery.pager.js') }}"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $("#pager").pager({ pagenumber: {{ $content['current_page'] }}, pagecount: {{ $content['last_page'] }}, buttonClickCallback: PageClick });
        });

        PageClick = function(pageclickednumber) {
            location.href = '{{ $domain }}' + pageclickednumber;
        }
    </script>

    <ul class="post-list" style="max-width:800px">
        @foreach($content['list'] as $k => $item)
        <li><p class="date">{{ $item['create_time'] }}</p><h4 class="title"><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></h4>
            <div class="excerpt">{!! $item['content'] !!}</div>
            <ul class="meta">
                <li><i class="icon icon-author"></i>{{ $item['name'] }}</li>
                <li><i class="icon icon-clock"></i>{{ $item['time'] }}</li>
                <li><i class="icon icon-category"></i>{{ $item['category_name'] }}</li>
            </ul>
        </li>
            @endforeach
    </ul>

    <div id="pager" ></div>
@endsection
