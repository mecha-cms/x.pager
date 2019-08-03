<?php

foreach (g(__DIR__ . DS . 'content' . DS . 'pager', 'php') as $k => $v) {
    Content::set('pager/' . Path::N($k), $k);
}