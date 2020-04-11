<div class="layuimini-main">
    <form class="layui-form layuimini-form" method="post" action="{{ route('admin.admins.store') }}">
        <div class="layui-form-item">
            <label class="layui-form-label required">{{ __('admin.name') }}</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.name')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.name')]) }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.email') }}</label>
            <div class="layui-input-block">
                <input type="email" name="email" lay-verify="required|email" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.email')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.email')]) }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.password') }}</label>
            <div class="layui-input-block">
                <input type="password" name="password" lay-verify="required" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.password')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.password')]) }}" class="layui-input">
            </div>
        </div>

        @if(Auth::user()->is_super_admin)
            <div class="layui-form-item">
                <label class="layui-form-label">{{ __('admin.form.super_admin') }}</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="is_super_admin" lay-skin="switch">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">{{ __('admin.form.permission') }}</label>
                <div class="layui-clear">
                    @foreach($menus as $menu)
                        <fieldset class="layui-elem-quote layui-quote-nm">
                            <legend>
                                <input type="checkbox" name="permission[{{$menu['id']}}]" title="{{  $menu['title_ug'] . ' ('.$menu['title_cn'] . ')'  }}">
                            </legend>
                            @if(isset($menu['child']))
                                <div class="layui-field-box">
                                    @foreach($menu['child'] as $childMenu)
                                        <div>
                                            <input type="checkbox" name="permission[{{$childMenu['id']}}]" lay-skin="primary" title="{{  $childMenu['title_ug'] . ' ('.$childMenu['title_cn'] . ')'  }}">
                                            @if(isset($childMenu['child']))
                                                <div style="padding: 5px 15px">
                                                    @foreach($childMenu['child'] as $m)
                                                        <input type="checkbox" name="permission[{{$m['id']}}]" lay-skin="primary" title="{{  $m['title_ug'] . ' ('.$m['title_cn'] . ')'  }}">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </fieldset>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="save">{{ __('admin.form.submit') }}</button>
            </div>
        </div>
    </form>
</div>
<script>
    layui.use(['form', 'table'], function () {
        var form = layui.form,
            layer = layui.layer,
            table = layui.table,
            $ = layui.$;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        // 当前弹出层，防止ID被覆盖
        var parentIndex = layer.index;

        form.on('submit(save)', function(data){
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
