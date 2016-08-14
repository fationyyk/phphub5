<?php
// 如：db:seed 或者 清空数据库命令的地方调用
function insanity_check()
{
    if (App::environment('production')) {
        exit('别傻了? 这是线上环境呀。');
    }
}

function cdn($filepath)
{
    if (config('app.url_static')) {
        return config('app.url_static') . $filepath;
    } else {
        return config('app.url') . $filepath;
    }
}

function cdn_square_image($path, $size)
{
    if (strpos($path, '.ico') === false) {
        return cdn($path)."?imageView2/1/w/{$size}/h/{$size}";
    } else {
        return cdn($path);
    }
}

function get_cdn_domain()
{
    return config('app.url_static') ?: config('app.url');
}

function get_user_static_domain()
{
    return config('app.user_static') ?: config('app.url');
}

function lang($text, $parameters = [])
{
    return str_replace('phphub.', '', trans('phphub.'.$text, $parameters));
}

function admin_link($title, $path, $id = '')
{
    return '<a href="'.admin_url($path, $id).'" target="_blank">' . $title . '</a>';
}

function admin_url($path, $id = '')
{
    return env('APP_URL') . "/admin/$path" . ($id ? '/'.$id : '');
}

function admin_enum_style_output($value, $reverse = false)
{
    if ($reverse) {
        $class = ($value === true || $value == 'yes') ? 'danger' : 'success';
    } else {
        $class = ($value === true || $value == 'yes') ? 'success' : 'danger';
    }

    return '<span class="label bg-'.$class.'">'.$value.'</span>';
}

function navViewActive($anchor)
{
    return Route::currentRouteName() == $anchor ? 'active' : '';
}

function model_link($title, $model, $id)
{
    return '<a href="'.model_url($model, $id).'" target="_blank">' . $title . '</a>';
}

function model_url($model, $id)
{
    return env('APP_URL') . "/$model/$id";
}