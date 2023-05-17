<?php

if (class_exists('Asset')) {
    $z = defined('TEST') && TEST ? '.' : '.min.';
    Asset::set(__DIR__ . D . 'index' . $z . 'css', 10);
}

if (class_exists('Layout')) {
    if (!Layout::path('pager')) {
        Layout::set('pager', __DIR__ . D . 'engine' . D . 'y' . D . 'pager.php');
    }
    Layout::set('pager/page', __DIR__ . D . 'engine' . D . 'y' . D . 'pager' . D . 'page.php');
    Layout::set('pager/part', __DIR__ . D . 'engine' . D . 'y' . D . 'pager' . D . 'part.php');
}