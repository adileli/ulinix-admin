<style>
    .layui-form-item .layui-input-company {width: auto;padding-right: 10px;line-height: 38px;}
</style>
<div class="layuimini-container layuimini-page-anim">
    <div class="layuimini-main">

        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">{{ __('admin.site_name') }}</label>
                <div class="layui-input-block">
                    <input type="text" name="site_name" lay-verify="required" lay-reqtext="{{ __('validation.filled', ['attribute' => __('admin.site_name')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.site_name')]) }}" value="{{ Arr::get($setting, 'site_name', '') }}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label required">{{ __('admin.url') }}</label>
                <div class="layui-input-block">
                    <input type="text" name="url" lay-verify="required" lay-reqtext="{{ __('validation.filled', ['attribute' => __('admin.url')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.url')]) }}" value="{{ Arr::get($setting, 'url', '') }}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{{ __('admin.logo') }}</label>
                <div class="layui-input-block">
                    <a type="button" class="layui-btn" id="logo">
                        <i class="fa fa-cloud-upload"></i> {{ __('admin.upload_image') }}
                    </a>
                    <img id="logo-preview" src="{{ asset(Arr::get($setting, 'logo', '')) }}" alt="logo" width="48">
                    <input id="logo-input" type="hidden" name="logo" value="{{ Arr::get($setting, 'logo', '') }}">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">{{ __('admin.meta_keywords') }}</label>
                <div class="layui-input-block">
                    <textarea name="keywords" class="layui-textarea">{{ Arr::get($setting, 'keywords', '') }}</textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">{{ __('admin.meta_description') }}</label>
                <div class="layui-input-block">
                    <textarea name="description" class="layui-textarea">{{ Arr::get($setting, 'description', '') }}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="setting">{{ __('admin.form.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['form', 'upload'], function () {
        var form = layui.form
            , upload = layui.upload
            , layer = layui.layer;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        var uploadInst = upload.render({
            elem: '#logo'
            ,url: `{{ route('admin.uploadLogo') }}`
            ,done: function(res){
                $('#logo-preview').attr('src', res.webPath);
                $('#logo-input').val(res.webPath);
            }
            ,error: function(){
                parent.layer.msg(`{{ __('admin.form.error') }}`);
            }
        });

        //监听提交
        form.on('submit(setting)', function (data) {
            let url = `{{ route('admin.setting') }}`;
            $.post(url, data.field, res => {
                parent.layer.msg(`{{ __('admin.form.success') }}`);
                window.location.reload();
            });

            return false;
        });

    });
</script>
