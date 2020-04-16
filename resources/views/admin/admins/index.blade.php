<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">

        <script type="text/html" id="toolbar">
            <div class="layui-btn-container">
                <button class="layui-btn data-add-btn" lay-event="create" data-url="{{ route('admin.admins.create') }}"><i class="fa fa-plus"></i> {{ __('admin.create_admin') }} </button>
            </div>
        </script>

        <table class="layui-hide" id="admins-table" lay-filter="admins-table-filter"></table>

        <script type="text/html" id="operating">
            <a class="layui-btn layui-btn-xs" lay-event="edit">{{ __('admin.form.edit') }}</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">{{ __('admin.form.delete') }}</a>
        </script>

    </div>
</div>

<script>
    var admins = @json($admins)

    layui.use(['form', 'table','miniPage','element'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table,
            miniPage = layui.miniPage;

        table.render({
            elem: '#admins-table',
            data: admins,
            toolbar: '#toolbar',
            defaultToolbar: ['filter', 'exports', 'print'],
            cols: [[
                {field: 'id', width: 80, title: 'ID'},
                {field: 'name', minWidth: 100, title: '@lang('admin.name')'},
                {field: 'nickname', minWidth: 100, title: '@lang('admin.nickname')'},
                {field: 'email', title: '@lang('admin.email')', minWidth: 150},
                {title: '@lang('admin.form.operating')', width: 160, templet: '#operating', align: "center"}
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: true
        });

        /**
         * toolbar事件监听
         */
        table.on('toolbar(admins-table-filter)', function (obj) {
            if (obj.event === 'create') {   // 监听添加操作
                let $this = $(this);

                $.get($this.data('url'), function(response){
                    var index = layer.open({
                        type: 1,
                        maxmin: true,
                        area: ['60%', '90%'],
                        title: '@lang('admin.create_admin')',
                        content: response
                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                });

            }
        });

        table.on('tool(admins-table-filter)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'delete') {
                layer.confirm(`@lang('admin.confirm.delete')`, function(index){
                    obj.del();
                    layer.close(index);
                    let url = 'admin/admins/delete/' + data.id;
                    $.post(url, res => {
                        layer.msg('@lang('admin.form.success')', {icon: 1})
                    }).fail(res => {
                        layer.msg('@lang('admin.form.error')', {icon: 2})
                    });
                });
            }
            if (layEvent === 'edit') {
                let $this = $(this),
                    url = 'admin/admins/edit/' + data.id;

                $.get(url, {}, function(response){
                    var index = layer.open({
                        type: 1,
                        area: ['60%', '90%'],
                        maxmin: true,
                        title: '@lang('admin.form.edit')',
                        content: response
                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                });
            }
        });

    });
</script>
