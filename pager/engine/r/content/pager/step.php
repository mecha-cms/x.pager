<nav class="pager pager-step">
<?php

$_state = State::get('x.pager.step') ?? [];
$_count = count($pages->lot);

echo (function($current, $count, $chunk, $peek, $fn, $first, $prev, $next, $last) {
    $begin = 1;
    $end = (int) ceil($count / $chunk);
    $out = "";
    if ($end <= 1) {
        return $out;
    }
    if ($current <= $peek + $peek) {
        $min = $begin;
        $max = min($begin + $peek + $peek, $end);
    } else if ($current > $end - $peek - $peek) {
        $min = $end - $peek - $peek;
        $max = $end;
    } else {
        $min = $current - $peek;
        $max = $current + $peek;
    }
    if ($prev) {
        $out = '<span>';
        if ($current === $begin) {
            $out .= '<b title="' . $prev . '">' . $prev . '</b>';
        } else {
            $out .= '<a href="' . call_user_func($fn, $current - 1) . '" title="' . $prev . '" rel="prev">' . $prev . '</a>';
        }
        $out .= '</span> ';
    }
    if ($first && $last) {
        $out .= '<span>';
        if ($min > $begin) {
            $out .= '<a href="' . call_user_func($fn, $begin) . '" title="' . $first . '" rel="prev">' . $begin . '</a>';
            if ($min > $begin + 1) {
                $out .= ' <span>&#x2026;</span>';
            }
        }
        for ($i = $min; $i <= $max; ++$i) {
            if ($current === $i) {
                $out .= ' <b title="' . $i . '">' . $i . '</b>';
            } else {
                $out .= ' <a href="' . call_user_func($fn, $i) . '" title="' . $i . '" rel="' . ($current >= $i ? 'prev' : 'next') . '">' . $i . '</a>';
            }
        }
        if ($max < $end) {
            if ($max < $end - 1) {
                $out .= ' <span>&#x2026;</span>';
            }
            $out .= ' <a href="' . call_user_func($fn, $end) . '" title="' . $last . '" rel="next">' . $end . '</a>';
        }
        $out .= '</span>';
    }
    if ($next) {
        $out .= ' <span>';
        if ($current === $end) {
            $out .= '<b title="' . $next . '">' . $next . '</b>';
        } else {
            $out .= '<a href="' . call_user_func($fn, $current + 1) . '" title="' . $next . '" rel="next">' . $next . '</a>';
        }
        $out .= '</span>';
    }
    return $out;
}, $url['i'] ?? 1, $_count, $state->chunk, $_state['peek'], function($i) use($page) {
    return $page->url . ($i > 0 ? '/' . $i : "");
})($language->first, !empty($_state['prev']) ? $language->prev : false, !empty($_state['next']) ? $language->next : false, $language->last);

?>
</nav>