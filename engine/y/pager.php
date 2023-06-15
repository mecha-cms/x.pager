<?php

$out = [
    '0' => $lot[0] ?? 'nav',
    '1' => (array) ($lot[1] ?? []),
    '2' => array_replace_recursive([
        'aria-label' => $label ?? i('Page Navigation'),
        'class' => 'pager'
    ], (array) ($lot[2] ?? []))
];

$next = $pager->next;
$prev = $pager->prev;

if (array_key_exists('previous', $lot) && !array_key_exists('prev', $lot)) {
    $lot['prev'] = $lot['previous'];
}

$out[1]['prev'] = !array_key_exists('prev', $lot) || $lot['prev'] ? ['a', isset($lot['prev']) && is_string($lot['prev']) ? $lot['prev'] : ($prev->title ?? i('Previous')), [
    'aria-disabled' => $prev ? null : 'true',
    'href' => $prev ? ($prev->url ?? $prev->link ?? null) : null,
    'rel' => 'prev',
    'title' => $prev ? $prev->description : null
], []] : null;

$out[1]['next'] = !array_key_exists('next', $lot) || $lot['next'] ? ['a', isset($lot['next']) && is_string($lot['next']) ? $lot['next'] : ($next->title ?? i('Next')), [
    'aria-disabled' => $next ? null : 'true',
    'href' => $next ? ($next->url ?? $next->link ?? null) : null,
    'rel' => 'next',
    'title' => $next ? $next->description : null
], []] : null;

echo new HTML(Hook::fire('y.pager', [$out], $pager), true);