<?php namespace x\pager;

if (\class_exists("\\Asset")) {
    $z = \defined("\\TEST") && \TEST ? '.' : '.min.';
    \Asset::set(__DIR__ . \D . 'index' . $z . 'css', 10);
}

if (\class_exists("\\Layout")) {
    if (!\Layout::path('pager')) {
        \Layout::set('pager', __DIR__ . \D . 'engine' . \D . 'y' . \D . 'pager.php');
    }
    \Layout::set('pager/page', __DIR__ . \D . 'engine' . \D . 'y' . \D . 'pager' . \D . 'page.php');
    \Layout::set('pager/peek', __DIR__ . \D . 'engine' . \D . 'y' . \D . 'pager' . \D . 'peek.php');
}

// Enable pager in `page` page type
function route__page($content) {
    \extract($GLOBALS, \EXTR_SKIP);
    // Make sure current page type is `page`
    if (!$state->is('page')) {
        return $content;
    }
    // Make sure parent page exists
    if (!isset($page) || !$page->parent || !$page->parent->exist) {
        return $content;
    }
    // Make sure current page exists
    if (!$page->exist) {
        return $content;
    }
    // Since `exist` value can be faked for virtual page creation purpose(s), we must also check that the file exists
    if (!$path = $page->path) {
        return $content;
    }
    $pages = \Pages::from(\dirname($path));
    $pager = \Pager\Page::from($pages->sort($page->parent->sort ?? [1, 'path']));
    // Get current page index from the current page path
    $part = \array_search($page->path, $pager->value);
    if (false === $part) {
        return $content; // Page does not exist
    }
    // Calling the `chunk` method with values greater than `1` is useless for the `page` page type. This is because
    // navigation is always one step forward and/or one step back.
    $GLOBALS['pager'] = $pager = $pager->chunk(1, $part);
    return $content;
}

\Hook::set('route.page', __NAMESPACE__ . "\\route__page", 100.1);