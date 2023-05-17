<?php

$chunk = $chunk ?? $pager->chunk ?? 5;
$count = $count ?? ($pager->parent ? ($pager->parent->count ?? 0) : 0);
$part = $part ?? ($pager->current ? ($pager->current->part ?? 1) : 1);

$next = $next ?? true; // Show “next” link?
$prev = $prev ?? $previous ?? true; // Show “previous” link?

$end = (int) ceil($count / $chunk);
$peek = $peek ?? $lot[0] ?? 2; // `self::pager('part', ['peek' => 2])` or `self::pager('part', [2])`
$start = 1;

$out = [
    'chunk' => $chunk,
    'count' => $count,
    'of' => $end,
    'part' => $part,
    'peek' => $peek,
    'type' => basename(__FILE__, '.php')
];

if ($end > 0) {
    $out[0] = $lot[0] ?? 'nav';
    $out[1] = (array) ($lot[1] ?? []);
    $out[2] = array_replace_recursive([
        'aria-label' => i('Page Navigation'),
        'class' => 'pager pager-part'
    ], (array) ($out[2] ?? []));
    if ($part <= $peek + $peek) {
        $min = $start;
        $max = min($start + $peek + $peek, $end);
    } else if ($part > $end - $peek - $peek) {
        $min = $end - $peek - $peek;
        $max = $end;
    } else {
        $min = $part - $peek;
        $max = $part + $peek;
    }
    $out[1]['prev'] = $prev ? ['span', [
        'link' => ['a', is_string($prev) ? $prev : i('Previous'), [
            'aria-current' => $part !== $start ? null : 'page',
            'href' => $part !== $start ? $pager->to($part - 1) : null,
            'rel' => $part !== $start ? 'prev' : null,
            'title' => i('Go to the %s page.', 'previous')
        ]]
    ], []] : null;
    $out[1]['data'] = ['span', [], []];
    if ($min > $start) {
        $out[1]['data'][1][] = ['a', (string) $start, [
            'href' => $pager->to($start),
            'rel' => 'prev',
            'title' => i('Go to the %s page.', 'first')
        ]];
        if ($min > $start + 1) {
            $out[1]['data'][1][] = ['span', '&#x2026;', []];
        }
    }
    for ($i = $min; $i <= $max; ++$i) {
        $out[1]['data'][1][] = ['a', (string) $i, [
            'aria-current' => $part !== $i ? null : 'page',
            'href' => $part !== $i ? $pager->to($i) : null,
            'rel' => $part !== $i ? ($part >= $i ? 'prev' : 'next') : null,
            'title' => i('Go to page %d.', $i)
        ]];
    }
    if ($max < $end) {
        if ($max < $end - 1) {
            $out[1]['data'][1][] = ['span', '&#x2026;', []];
        }
        $out[1]['data'][1][] = ['a', (string) $end, [
            'href' => $page->to($end),
            'rel' => 'next',
            'title' => i('Go to the %s page.', 'last')
        ]];
    }
    $out[1]['next'] = $next ? ['span', [
        'link' => ['a', i('Next'), [
            'aria-current' => $part !== $end ? null : 'page',
            'href' => $part !== $end ? $pager->to($part + 1) : null,
            'rel' => $part !== $end ? 'next' : null,
            'title' => i('Go to the %s page.', 'next')
        ]]
    ], []] : null;
}

echo new HTML(Hook::fire('y.pager', [$out]), true);