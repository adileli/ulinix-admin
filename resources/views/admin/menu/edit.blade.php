<form class="layui-form pa-20" method="post" action="{{ route('admin.menu.update', ['id' => $menu->id]) }}">
    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.menu_name_cn') }}</label>
        <div class="layui-input-block">
            <input type="text" name="title_cn" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.menu_name_cn')]) }}" autocomplete="off" class="layui-input" value="{{ $menu->title_cn }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.menu_name_ug') }}</label>
        <div class="layui-input-block">
            <input type="text" name="title_ug" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.menu_name_ug')]) }}" autocomplete="off" class="layui-input" value="{{ $menu->title_ug }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.menu_url') }}</label>
        <div class="layui-input-block">
            <input type="text" name="href" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.menu_url')]) }}" autocomplete="off" class="layui-input" value="{{ $menu->href }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.menu_parent') }}</label>
        <div class="layui-input-block">
            <input type="text" name="pid" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.menu_parent')]) }}" autocomplete="off" class="layui-input" value="{{ $menu->pid }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.menu_icon') }}</label>
        <div class="layui-input-block">
            <input name="icon" type="text" id="iconPicker" lay-filter="iconPicker" class="hide" value="{{ $menu->icon }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.menu_target') }}</label>
        <div class="layui-input-block">
            <input type="text" name="target" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.menu_target')]) }}" autocomplete="off" class="layui-input" value="{{ $menu->target }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.sort') }}</label>
        <div class="layui-input-block">
            <input type="text" name="sort" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.sort')]) }}" autocomplete="off" class="layui-input" value="{{ $menu->sort }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.status') }}</label>
        <div class="layui-input-block">
            <input type="checkbox" name="status" lay-skin="switch" lay-filter="status" {{ $menu->status == 1 ? 'checked' : '' }} value="{{ $menu->status }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">{{ __('admin.form.remark') }}</label>
        <div class="layui-input-block">
            <textarea name="remark" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.form.remark')]) }}" class="layui-textarea">{{ $menu->remark }}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="update">{{ __('admin.form.submit') }}</button>
        </div>
    </div>
</form>

<script>
    var menus = @json($menus)

    layui.use(['iconPickerFa', 'form', 'layer'], function(){
        var iconPickerFa = layui.iconPickerFa,
            form = layui.form,
            layer = layui.layer,
            $ = layui.$;

        form.render();
        form.verify({
            title_cn: function(value){
                if(value.length < 2){
                    return '@lang('validation.min.string', ['attribute' => __('admin.form.menu_name_cn'), 'min' => 2])';
                }
            },
            title_ug: function(value){
                if(value.length < 2){
                    return '@lang('validation.min.string', ['attribute' => __('admin.form.menu_name_ug'), 'min' => 2])';
                }
            },
            href: function(value){
                if(value == ''){
                    return '@lang('validation.filled', ['attribute' => __('admin.form.menu_url')])';
                }
            },
            pid: function(value){
                if(value == ''){
                    return '@lang('validation.filled', ['attribute' => __('admin.form.menu_parent')])';
                }
            },
            target: function(value){
                if(value == ''){
                    return '@lang('validation.filled', ['attribute' => __('admin.form.menu_target')])';
                }
            },
            sort: function(value){
                if(value == ''){
                    return '@lang('validation.filled', ['attribute' => __('admin.form.sort')])';
                }
            },
        });

        iconPickerFa.render({
            elem: '#iconPicker',
            url: "lib/font-awesome-4.7.0/less/variables.less",
            search: true,
            page: true,
            limit: 36,
            click: function (data) {
                $('#iconPicker').val('fa '+ data.icon)
            }
        });

        form.on('submit(update)', function(data){
            $.post(data.form.action, data.field, res => {
                layer.msg('@lang('admin.form.success')', {icon: 1});
                window.location.reload()
            }).fail(res => {
                layer.msg('@lang('admin.form.error')', {icon: 2});

                console.log(res)
            });
            return false;
        });

    });
</script>
