<?php

$next = $pager->next;
$prev = $pager->prev;

$out = [
    '0' => ($next || $prev ? ($lot[0] ?? 'nav') : false),
    '1' => (array) ($lot[1] ?? []),
    '2' => array_replace_recursive([
        'aria-label' => $label ?? i('Page Navigation'),
        'class' => 'pager pager-page'
    ], (array) ($lot[2] ?? []))
];

if (array_key_exists('previous', $lot) && !array_key_exists('prev', $lot)) {
    $lot['prev'] = $lot['previous'];
}

$out[1]['prev'] = $prev && (!array_key_exists('prev', $lot) || $lot['prev']) ? ['a', isset($lot['prev']) && is_string($lot['prev']) ? $lot['prev'] : i('Previous') . ': ' . $prev->title, [
    'aria-disabled' => $prev ? null : 'true',
    'href' => $prev ? ($prev->url ?? $prev->link ?? null) : null,
    'rel' => 'prev',
    'title' => $prev ? $prev->description : null
], []] : ($next || $prev ? ['a', [], ['aria-hidden' => 'true']] : null);

$out[1]['next'] = $next && (!array_key_exists('next', $lot) || $lot['next']) ? ['a', isset($lot['next']) && is_string($lot['next']) ? $lot['next'] : i('Next') . ': ' . $next->title, [
    'aria-disabled' => $next ? null : 'true',
    'href' => $next ? ($next->url ?? $next->link ?? null) : null,
    'rel' => 'next',
    'title' => $next ? $next->description : null
], []] : ($next || $prev ? ['a', [], ['aria-hidden' => 'true']] : null);

echo new HTML(Hook::fire('y.pager.page', [$out], $pager), true);