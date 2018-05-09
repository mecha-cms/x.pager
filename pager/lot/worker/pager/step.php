<nav class="pager pager-step"><?php

$_state = Extend::state('pager', [
    'step' => [
        'range' => 5
    ]
])['step'];
$_range = $_state['range'];
$_page = Lot::get('page');
if ($_page && isset($_page->path)) {
    $_o = "";
    $_current = (int) $url->i ?: 1;
    $_count = count(glob(Path::F($_page->path) . DS . '*.page', GLOB_NOSORT));
    $_c = $_page->chunk($site->chunk); // Current page chunk value…
    $_d = (int) floor($_range / 2);
    $_u = $_page->url . '/';
    $_q = $url->query('&amp;'); // Include current URL query(es)…
    $_chunk = (int) ceil($_count / $_c);
    $_previous = $_current > 1 ? $_current - 1 : false;
    $_next = $_current < $_chunk ? $_current + 1 : false;
    if ($_chunk > 1) {
        if (!empty($_state['previous'])) {
            $_o .= '<span class="pager-step-previous">';
            $_o .= $_previous ? '<a class="a-previous" href="' . $_u . $_previous . $_q . '" title="' . $language->previous . '" rel="prev">' . $language->previous . '</a>' : '<span class="a a-previous">' . $language->previous . '</span>';
            $_o .= '</span> ';
        }
        if (!empty($_range)) {
            $_o .= '<span class="pager-step-range">';
            // Enable range view if `$_chunk` is greater than `$_range`
            if ($_chunk > $_range) {
                // Jump!
                if ($_current >= $_range) {
                    $_o .= '<a class="a-step a-step:1" href="' . $_u . '1' . $_q . '" title="' . $language->first . '" rel="prev">1</a>';
                    $_o .= ' <span class="s">&#x2026;</span>';
                }
                // Closer to the first chunk
                if ($_current < $_range) {
                    for ($_i = 1; $_i <= $_range; ++$_i) {
                        if ($_i > 1) {
                            $_o .= ' ';
                        }
                        $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . $_q . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                    }
                // Closer to the last chunk
                } else if ($_current >= ($_chunk - $_d - 1)) {
                    for ($_i = $_chunk - $_range + 1; $_i <= $_chunk; ++$_i) {
                        if ($_i > 1) {
                            $_o .= ' ';
                        }
                        $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . $_q . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                    }
                // Somewhere in the middle of the chunk
                } else if ($_current >= $_range && $_current < ($_chunk - $_d)) {
                    for ($_i = $_current - $_d; $_i <= ($_current + $_d); ++$_i) {
                        if ($_i > 1) {
                            $_o .= ' ';
                        }
                        $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . $_q . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                    }
                }
                // Jump!
                if ($_current < ($_chunk - $_range + $_d)) {
                    $_o .= ' <span class="s">&#x2026;</span>';
                    $_o .= ' <a class="a-step a-step:' . $_chunk . '" href="' . $_u . $_chunk . $_q . '" title="' . $language->last . '" rel="next">' . $_chunk . '</a>';
                }
            // Disable range view(s) if `$_chunk` is less than `$_range`
            } else {
                for ($_i = 1; $_i <= $_chunk; ++$_i) {
                    if ($_i > 1) {
                        $_o .= ' ';
                    }
                    $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . $_q . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                }
            }
            $_o .= '</span> ';
        }
        if (!empty($_state['next'])) {
            $_o .= '<span class="pager-step-next">';
            $_o .= $_next ? '<a class="a-next" href="' . $_u . $_next . $_q . '" title="' . $language->next . '" rel="next">' . $language->next . '</a>' : '<span class="a a-next">' . $language->next . '</span>';
            $_o .= '</span>';
        }
    }
    echo $_o;
}

?></nav>