<?php $pager = new PagerSteps\Pages($pages->lot, [$page->chunk ?? 5, ($url['i'] ?? 1) - 1], $parent->path ?? $page->path); ?>
<nav class="pager pager-steps">
  <?php if ($pager->prev): ?>
  <span>
    <?= $pager->prev(i('Previous')); ?>
  </span>
  <?php endif; ?>
  <?php if ($pager->steps): ?>
  <span>
    <?= $pager->steps(""); ?>
  </span>
  <?php endif; ?>
  <?php if ($pager->next): ?>
  <span>
    <?= $pager->next(i('Next')); ?>
  </span>
  <?php endif; ?>
</nav>
