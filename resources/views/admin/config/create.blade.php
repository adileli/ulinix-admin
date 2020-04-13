<div class="layuimini-main">
    <form class="layui-form" action="{{ route('admin.configs.create') }}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.configs_name') }}</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.configs_name')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.configs_name')]) }}" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.configs_value') }}</label>
            <div class="layui-input-block">
                <textarea name="value" lay-verify="required" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.configs_value')]) }}" class="layui-textarea"></textarea>
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
