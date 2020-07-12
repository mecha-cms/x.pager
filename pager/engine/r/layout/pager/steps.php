<?php

$p = $site->is('tags') ? (object) [
    'link' => $url . $url->path
] : ($parent->exist ? $parent : $page);

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
