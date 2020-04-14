<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php $direction = in_array(app()->getLocale(), ['ug']) ? 'rtl' : ''; $isRtl = in_array(app()->getLocale(), ['ug']) ? true : false;?>
<head>
    <meta charset="utf-8">
    <title>{{ Arr::get($setting, 'site_name', config('app.name', 'Ulinix')) }}</title>
    <meta name="keywords" content="{{ Arr::get($setting, 'keywords', '') }}">
    <meta name="description" content="{{ Arr::get($setting, 'description', '') }}">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('lib/layui-v2.5.5/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome-4.7.0/css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/layuimini.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all">
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style id="layuimini-bg-color"></style>
</head>
<body class="layui-layout-body layuimini-all {{ $direction }}">
<div class="layui-layout layui-layout-admin">
    {{--  顶部菜单栏  --}}
    <div class="layui-header header">
        <div class="layui-logo layuimini-logo layuimini-back-home"></div>

        <div class="layuimini-header-content">
            <a>
                <div class="layuimini-tool"><i title="展开" class="fa fa-outdent" data-side-fold="1"></i></div>
            </a>

            {{--  电脑端头部菜单  --}}
            <ul class="layui-nav {{ $isRtl ? 'layui-layout-right' : 'layui-layout-left' }} layuimini-header-menu mobile layui-hide-xs layuimini-menu-header-pc">
            </ul>

            <ul class="layui-nav {{ $isRtl ? 'layui-layout-left' : 'layui-layout-right' }}">
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;"><i class="fa fa-globe"></i></a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a class="change-locale" href="javascript:;" data-url="{{ route('admin.changeLocale', ['locale' => 'ug']) }}" data-title="ئۇيغۇرچە" data-icon="fa fa-gears">ئۇيغۇرچە</a>
                        </dd>
                        <dd>
                            <a class="change-locale" href="javascript:;" data-url="{{ route('admin.changeLocale', ['locale' => 'zh-CN']) }}" data-title="中文" data-icon="fa fa-gears">中文</a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" data-refresh="刷新"><i class="fa fa-refresh"></i></a>
                </li>
{{--                <li class="layui-nav-item" lay-unselect>--}}
{{--                    <a href="javascript:;" data-clear="清理" class="layuimini-clear"><i class="fa fa-trash-o"></i></a>--}}
{{--                </li>--}}
                <li class="layui-nav-item mobile layui-hide-xs" lay-unselect>
                    <a href="javascript:;" data-check-screen="full"><i class="fa fa-arrows-alt"></i></a>
                </li>
                <li class="layui-nav-item layuimini-setting">
                    <a href="javascript:;">{{ Auth::user()->name ?? '' }}</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" class="login-out">{{ __('auth.logout') }}</a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item layuimini-select-bgcolor mobile layui-hide-xs" lay-unselect>
                    <a href="javascript:;" data-bgcolor="配色方案"><i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
    </div>

    {{--  左侧菜单栏  --}}
    <div class="layui-side layui-bg-black layuimini-menu-left">
    </div>

    {{--  初始化加载层  --}}
    <div class="layuimini-loader">
        <div class="layuimini-loader-inner"></div>
    </div>

    {{--  手机端遮罩层  --}}
    <div class="layuimini-make"></div>

    <div class="layui-body">

        <div class="layui-card layuimini-page-header layui-hide">
            <div class="layui-breadcrumb layuimini-page-title">

            </div>
        </div>

        <div class="layuimini-content-page">
        </div>

    </div>

</div>

<script src="{{ asset('lib/jquery-3.4.1/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('lib/layui-v2.5.5/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('lib/uyghur-input.js') }}" charset="utf-8"></script>
<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    window.rootPath = (function (src) {
        src = document.scripts[document.scripts.length - 1].src;
        return src.substring(0, src.lastIndexOf("/") + 1);
    })();

    layui.config({
        base: rootPath + "/js/lay-module/",
        version: true
    }).extend({
        miniAdmin: "layuimini/miniAdmin", // layuimini后台扩展
        miniMenu: "layuimini/miniMenu", // layuimini菜单扩展
        miniPage: "layuimini/miniPage", // layuimini 单页扩展
        miniTheme: "layuimini/miniTheme", // layuimini 主题扩展
        miniTongji: "layuimini/miniTongji", // layuimini 统计扩展
        step: 'step-lay/step', // 分步表单扩展
        treetable: 'treetable-lay/treetable', //table树形扩展
        tableSelect: 'tableSelect/tableSelect', // table选择扩展
        iconPickerFa: 'iconPicker/iconPickerFa', // fa图标选择扩展
        echarts: 'echarts/echarts', // echarts图表扩展
        echartsTheme: 'echarts/echartsTheme', // echarts图表主题扩展
        wangEditor: 'wangEditor/wangEditor', // wangEditor富文本扩展
        layarea: 'layarea/layarea', //  省市县区三级联动下拉选择器
    });

    layui.use(['jquery', 'layer', 'miniAdmin', 'miniTongji'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniAdmin = layui.miniAdmin,
            miniTongji = layui.miniTongji;

        let lang = `{{ app()->getLocale() }}`;
        if (lang === 'zh-CN') {
            lang = 'cn';
        }

        var options = {
            lang: lang,
            iniUrl: `{{ route('admin.getSystemInit') }}`,    // 初始化接口
            clearUrl: "api/clear.json", // 缓存清理接口
            renderPageVersion: true,    // 初始化页面是否加版本号
            bgColorDefault: 0,          // 主题默认配置
            multiModule: true,          // 是否开启多模块
            menuChildOpen: false,       // 是否默认展开菜单
            loadingTime: 0,             // 初始化加载时间
            pageAnim: true,             // 切换菜单动画
        };
        miniAdmin.render(options);

        $('.login-out').on("click", function () {
            let url = `{{ route('admin.logout') }}`;

            $.post(url, res => {
                window.location = `{{ route('admin.login') }}`;
            })
        });

        $('.change-locale').on('click', function () {
            let $this = $(this);

            $.post($this.data('url') , res => {
                window.location.reload();
            })
        });
    });
</script>

<script>
    let d = $('<div>').addClass('input-mode layui-bg-green').html('<i class="fa fa-window-close js-input-mode-close"></i> <i class="fa fa-text-width js-switch-direction"></i> <i class="fa js-switch-input-mode">A</i>'),
        $html = $('html');

    $html.on('focus', 'input:not(".disable-input-mode, .layui-unselect")', function () {
        let $this = $(this);
        $this.after(d);
    });

    $html.on('click', '.input-mode .js-switch-direction', function () {
        let $this = $(this),
            $input = $this.parent('.input-mode').prev('input'),
            direction = $input.css('direction');

        if (direction === 'rtl') {
            direction = 'ltr'
        } else {
            direction = 'rtl'
        }

        $input.css('direction', direction);
    });

    $html.on('click', '.input-mode .js-input-mode-close', function () {
        d.remove();
    });

    $html.on('click', '.input-mode .js-switch-input-mode', function () {
        let $this = $(this),
            $input = $this.parent('.input-mode').prev('input');

        if ($input.hasClass('input-ug')) {
            $this.html('A');
            $input.removeAttr('onkeypress').removeClass('input-ug');
        } else {
            $this.html('ئۇ');
            $input.attr('onkeypress', 'return addchar(this, event);').addClass('input-ug');
        }
    });
</script>

</body>
</html>
