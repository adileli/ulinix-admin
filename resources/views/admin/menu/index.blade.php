<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">
        <div>
            <div class="layui-btn-group">
                <button class="layui-btn" id="btn-add" data-url="{{ route('admin.menu.create') }}"><i class="fa fa-plus"></i> {{ __('admin.form.create') }}</button>
                <button class="layui-btn" id="btn-expand"><i class="fa fa-expand"></i> {{ __('admin.form.expand_all') }}</button>
                <button class="layui-btn" id="btn-fold"><i class="fa fa-compress"></i> {{ __('admin.form.fold_all') }}</button>
            </div>
            <table id="menu-table" class="layui-table" lay-filter="menu-table"></table>
        </div>
    </div>
</div>
<script type="text/html" id="status">
    @verbatim
        <input type="checkbox" name="status" value="{{d.status}}" lay-skin="switch" {{ d.status == 1 ? 'checked' : '' }} disabled>
    @endverbatim
</script>
<!-- 操作列 -->
<script type="text/html" id="operating">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">{{ __('admin.form.edit') }}</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">{{ __('admin.form.delete') }}</a>
</script>
<script>
    var menus = @json($menus)

    layui.use(['table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var treetable = layui.treetable;

        // 渲染表格
        layer.load();
        treetable.render({
            treeColIndex: 1,
            treeSpid: 0,
            treeIdName: 'id',
            treePidName: 'pid',
            elem: '#menu-table',
            data: menus,
            page: false,
            cols: [[
                {field: 'id', width: 90, align: 'center', title: 'ID'},
                {field: 'title_ug', minWidth: 200, title: '@lang('admin.form.menu_name_ug')'},
                {field: 'title_cn', minWidth: 200, title: '@lang('admin.form.menu_name_cn')'},
                {field: 'href', title: '@lang('admin.form.menu_url')'},
                {field: 'icon', width: 90, align: 'center', title: '@lang('admin.form.menu_icon')', templet: function (d) {
                        return '<i class="' + d.icon + '"></i>'
                    }
                },
                {templet: '#status', field: 'status', width: 90, align: 'center', title: '@lang('admin.form.status')'},
                {field: 'sort', width: 90, align: 'center', title: '@lang('admin.form.sort')'},
                {templet: '#operating', width: 160, align: 'center', title: '@lang('admin.form.operating')'}

            ]],
            done: function () {
                layer.closeAll('loading');
            }
        });

        $('#btn-expand').click(function () {
            treetable.expandAll('#menu-table');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#menu-table');
        });

        $('#btn-add').click(function () {
            let $this = $(this);
            $.get($this.data('url'), function(response){
                layer.open({
                    type: 1,
                    area: ['60%', '90%'],
                    maxmin: true,
                    title: '@lang('admin.form.create')',
                    content: response
                });
            });
        });

        //监听工具条
        table.on('tool(menu-table)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'del') {
                layer.confirm(`@lang('admin.confirm.delete')`, function(index){
                    obj.del();
                    layer.close(index);
                    let url = 'admin/menus/delete/' + data.id;
                    $.post(url, res => {
                        layer.msg('@lang('admin.form.success')', {icon: 1})
                    }).fail(res => {
                        layer.msg('@lang('admin.form.error')', {icon: 2})
                    });
                });
            } else if (layEvent === 'edit') {
                let url = 'admin/menus/edit/' + data.id;
                $.get(url, {}, function(response){
                    layer.open({
                        type: 1,
                        area: ['60%', '90%'],
                        maxmin: true,
                        title: '@lang('admin.form.edit')',
                        content: response
                    });
                });
            }
        });
    });
</script>
