<?php $pager = new PagerSteps\Pages($pages->lot, [$page->chunk ?? 5, ($url['i'] ?? 1) - 1], $parent->path ?? $page->path); ?>
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
