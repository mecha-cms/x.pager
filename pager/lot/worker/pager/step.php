<nav class="pager pager-step">
<?php

$_state = Extend::state('pager')['step'] ?? [];
$_page = Lot::get('page');
$_count = $_page ? count(glob(Path::F($_page->path) . DS . '*.page', GLOB_NOSORT)) : 0;

echo call_user_func(function($current, $count, $chunk, $kin, $fn, $first, $previous, $next, $last) {
    $begin = 1;
    $end = (int) ceil($count / $chunk);
    $out = "";
    if ($end <= 1) {
        return $out;
    }
    if ($current <= $kin + $kin) {
        $min = $begin;
        $max = min($begin + $kin + $kin, $end);
    } else if ($current > $end - $kin - $kin) {
        $min = $end - $kin - $kin;
        $max = $end;
    } else {
        $min = $current - $kin;
        $max = $current + $kin;
    }
    if ($previous) {
        $out = '<span>';
        if ($current === $begin) {
            $out .= '<b title="' . $previous . '">' . $previous . '</b>';
        } else {
            $out .= '<a href="' . call_user_func($fn, $current - 1) . '" title="' . $previous . '" rel="prev">' . $previous . '</a>';
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
}, $url->i ?: 1, $_count, $config->chunk, $_state['kin'], function($i) use($url) {
    return $url->clean . ($i > 0 ? '/' . $i : "");
}, $language->first, !empty($_state['previous']) ? $language->previous : false, !empty($_state['next']) ? $language->next : false, $language->last);

?>
</nav>