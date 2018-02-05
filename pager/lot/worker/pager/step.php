<nav class="pager pager-step">
<?php

$_range = 5;
$_page = Lot::get('page');
if ($_page && isset($_page->path)) {
    $_o = "";
    $_chunk = $_page->chunk($site->chunk); // Current page chunk value…
    $_current = (int) $site->step ?: 1;
    $_count = count(glob(Path::F($_page->path) . DS . '*.page', GLOB_NOSORT));
    $_c = (int) ceil($_count / $_chunk);
    $_d = (int) floor($_range / 2);
    $_u = $_page->url . '/';
    $_previous = $_current > 1 ? $_current - 1 : false;
    $_next = $_current < $_c ? $_current + 1 : false;
    $_step = b($_c, 0, $_chunk);
    if ($_step > 1) {
        $_o .= '<span class="pager-step-previous">';
        $_o .= $_previous ? '<a class="a-previous" href="' . $_u . $_previous . '" title="' . $language->previous . '" rel="prev">' . $language->previous . '</a>' : '<span class="a a-previous">' . $language->previous . '</span>';
        $_o .= '</span> ';
        $_o .= '<span class="pager-step-step">';
        // Enable range view if `$_chunk` is greater than `$_range`
        if ($_step > $_range) {
            // Jump!
            if ($_current >= $_range) {
                $_o .= '<a class="a-step a-step:1" href="' . $_u . '1" title="' . $language->first . '" rel="prev">1</a>';
                $_o .= ' <span class="s">&#x2026;</span>';
            }
            // Closer to the first chunk
            if ($_current < $_range) {
                for ($_i = 1; $_i <= $_range; ++$_i) {
                    if ($_i > 1) {
                        $_o .= ' ';
                    }
                    $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                }
            // Closer to the last chunk
            } else if ($_current >= ($_step - $_d - 1)) {
                for ($_i = $_step - $_range + 1; $_i <= $_step; ++$_i) {
                    if ($_i > 1) {
                        $_o .= ' ';
                    }
                    $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                }
            // Somewhere in the middle of the chunk
            } else if ($_current >= $_range && $_current < ($_step - $_d)) {
                for ($_i = $_current - $_d; $_i <= ($_current + $_d); ++$_i) {
                    if ($_i > 1) {
                        $_o .= ' ';
                    }
                    $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
                }
            }
            // Jump!
            if ($_current < ($_step - $_range + $_d)) {
                $_o .= ' <span class="s">&#x2026;</span>';
                $_o .= ' <a class="a-step a-step:' . $_step . '" href="' . $_u . $_step . '" title="' . $language->last . '" rel="next">' . $_step . '</a>';
            }
        // Disable range view(s) if `$_chunk` is less than `$_range`
        } else {
            for ($_i = 1; $_i <= $_step; ++$_i) {
                if ($_i > 1) {
                    $_o .= ' ';
                }
                $_o .= $_i === $_current ? '<span class="a a-step a-step:' . $_i . '">' . $_i . '</span>' : '<a class="a-step a-step:' . $_i . '" href="' . $_u . $_i . '" title="' . $_i . '" rel="' . ($_i < $_current ? 'prev' : 'next') . '">' . $_i . '</a>';
            }
        }
        $_o .= '</span> ';
        $_o .= '<span class="pager-step-next">';
        $_o .= $_next ? '<a class="a-next" href="' . $_u . $_next . '" title="' . $language->next . '" rel="next">' . $language->next . '</a>' : '<span class="a a-next">' . $language->next . '</span>';
        $_o .= '</span>';
    }
    echo $_o;
}

?>
</nav>