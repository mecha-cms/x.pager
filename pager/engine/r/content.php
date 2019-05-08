<?php

foreach (g(__DIR__ . DS . 'content' . DS . 'pager', 'php') as $v) {
    Content::set('pager/' . Path::N($v), $v);
}