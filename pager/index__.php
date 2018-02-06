<?php

function fn_pager_path($path, $id) {
    if (is_string($id) && ($id === 'pager' || strpos($id, 'pager/') === 0)) {
        return File::exist(__DIR__ . DS . 'lot' . DS . 'worker' . DS . $id . '.php', $path);
    }
    return $path;
}

Hook::set('shield.get.path', 'fn_pager_path');

Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . 'pager.min.css');