<?php

foreach (g(__DIR__ . DS . 'layout' . DS . 'pager', 'php') as $k => $v) {
    Layout::set('pager/' . Path::N($k), $k);
}