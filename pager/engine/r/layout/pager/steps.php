<?php

$p = $site->is('tags') ? $url . $url->path : ($parent->path ?? $page->path);
$pager = new PagerSteps\Pages($pages->lot, [$page->chunk ?? 5, ($url['i'] ?? 1) - 1], $p);

?>
<nav class="pager pager-steps">
  <span>
    <?= $pager->prev(i('Previous')); ?>
  </span>
  <span>
    <?= $pager->steps(""); ?>
  </span>
  <span>
    <?= $pager->next(i('Next')); ?>
  </span>
</nav>
