<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">
        <div class="layui-form layuimini-form">

            <script type="text/html" id="toolbar">
                <div class="layui-btn-container">
                    <button class="layui-btn data-add-btn" lay-event="create" data-url="{{ route('admin.configs.create') }}"><i class="fa fa-plus"></i> {{ __('admin.form.create') }} </button>
                </div>
            </script>

            <table class="layui-hide" id="configs" lay-filter="configs" data-url="{{ route('admin.configs') }}"></table>

            <fieldset class="layui-elem-field">
                <legend>{{ __('admin.cache.zone') }}</legend>
                <div class="layui-field-box">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-xs btn-post" data-url="{{ route('admin.putConfigsFile') }}">{{ __('admin.cache.put_file') }}</button>
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-xs btn-post" data-url="{{ route('admin.configCache') }}">{{ __('admin.cache.cache_config') }}</button>
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-xs btn-post" data-url="{{ route('admin.routeCache') }}">{{ __('admin.cache.cache_route') }}</button>
                    <hr>
                    <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-post" data-url="{{ route('admin.deleteConfigsFile') }}">{{ __('admin.cache.delete_file') }}</button>
                    <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-post" data-url="{{ route('admin.configClear') }}">{{ __('admin.cache.clear_config') }}</button>
                    <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-post" data-url="{{ route('admin.routeClear') }}">{{ __('admin.cache.clear_route') }}</button>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<script>
    var configs = @json($configs)

    layui.use('table', function(){
        var table = layui.table;

        table.render({
            elem: '#configs',
            data: configs,
            toolbar: '#toolbar',
            cols: [[
                {field:'id', align: 'center', width:80, title: 'ID'},
                {field:'name', align: 'center', title: '@lang('admin.configs_name')', event: 'name', style:'cursor: pointer;'},
                {field:'value', align: 'center', title: '@lang('admin.configs_value')', event: 'value', style:'cursor: pointer;'},
            ]],
            page: true
        });

        //监听单元格编辑
        {{--table.on('edit(configs)', function(obj){--}}
        {{--    var value = obj.value,--}}
        {{--        data = obj.data,--}}
        {{--        field = obj.field;--}}
        {{--    $.post($('#configs').data('url'), {id:data.id, field:field, value:value}, function (res) {--}}
        {{--        if (res) {--}}
        {{--            layer.msg(`{{ __('admin.form.success') }}`, {icon: 1});--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        table.on('toolbar(configs)', function (obj) {
            if (obj.event === 'create') {   // 监听添加操作
                let $this = $(this);

                $.get($this.data('url'), function(response){
                    var index = layer.open({
                        type: 1,
                        maxmin: true,
                        area: ['50%', '50%'],
                        title: '@lang('admin.create_admin')',
                        content: response
                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                });

            }
        });

        table.on('tool(configs)', function(obj){
            var data = obj.data;
            if(obj.event === 'name'){
                layer.prompt({
                    formType: 2,
                    title: false,
                    value: data.name
                }, function(value, index){
                    layer.close(index);
                    $.post($('#configs').data('url'), {id:data.id, field:'name', value:value}, function (res) {
                        if (res) {
                            layer.msg(`{{ __('admin.form.success') }}`, {icon: 1});
                        }
                    });
                    obj.update({
                        name: value
                    });
                });
            } else if (obj.event === 'value') {
                layer.prompt({
                    formType: 2,
                    title: false,
                    value: data.value
                }, function(value, index){
                    layer.close(index);
                    $.post($('#configs').data('url'), {id:data.id, field:'value', value:value}, function (res) {
                        if (res) {
                            layer.msg(`{{ __('admin.form.success') }}`, {icon: 1});
                        }
                    });
                    obj.update({
                        value: value
                    });
                });
            }
        });

        $('.btn-post').on('click', function () {
            $.post($(this).data('url'), function () {
                layer.msg(`{{ __('admin.form.success') }}`, {icon: 1});
            });
        });
    });
</script>
