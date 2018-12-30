<?php

foreach (g(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'pager', 'php') as $v) {
    Shield::set('pager/' . Path::N($v), $v);
}

// Make sure to put after shield’s CSS to inherit its CSS variable(s)
Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . 'pager.min.css', 30);