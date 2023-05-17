<?php

$z = defined('DEBUG') && DEBUG ? '.' : '.min.';
Asset::set(__DIR__ . DS . '..' . DS . '..' . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . 'index' . $z . 'css');