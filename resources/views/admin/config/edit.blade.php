<div class="layuimini-main">
    <form class="layui-form" action="{{ route('admin.configs.edit', ['id' => $config['id']]) }}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.title_cn') }}</label>
            <div class="layui-input-block">
                <input type="text" name="title_cn" lay-verify="required" autocomplete="off" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.title_cn')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.title_cn')]) }}" class="layui-input" value="{{ $config['title_cn'] }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.title_ug') }}</label>
            <div class="layui-input-block">
                <input type="text" name="title_ug" lay-verify="required" autocomplete="off" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.title_ug')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.title_ug')]) }}" class="layui-input" value="{{ $config['title_ug'] }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.configs_name') }}</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.configs_name')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.configs_name')]) }}" class="layui-input" value="{{ $config['name'] }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.configs_value') }}</label>
            <div class="layui-input-block">
                <textarea name="value" lay-verify="required" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.configs_value')]) }}" class="layui-textarea">{{ $config['value'] }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.configs_type') }}</label>
            <div class="layui-input-block">
                <input type="text" name="type" lay-verify="required" autocomplete="off" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.configs_type')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.configs_type')]) }}" class="layui-input" value="{{ $config['type'] }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.configs_remark') }}</label>
            <div class="layui-input-block">
                <input type="text" name="remark" autocomplete="off" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.configs_remark')]) }}" class="layui-input" value="{{ $config['remark'] }}">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="save">{{ __('admin.form.submit') }}</button>
            </div>
        </div>
    </form>
</div>

<script>
    layui.use(['form'], function () {
        var form = layui.form
            , layer = layui.layer;

        form.render();

        //监听提交
        form.on('submit(save)', function (data) {
            $.post(data.form.action, data.field, (res) => {
                layer.msg(`{{ __('admin.form.success') }}`, {icon: 1});
                window.location.reload();
            });
            return false;

        });

    });
</script>
