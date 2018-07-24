<?php

foreach (g(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'pager', 'php') as $v) {
    Shield::set('pager/' . Path::N($v), $v);
}

Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . 'pager.min.css');