<?php $pager = new PagerTitle\Page($pages->lot, $page->path, $parent->path ?? $page->path); ?>
<nav class="pager pager-title">
  <span>
    <?= $pager->prev(i('Previous')); ?>
  </span>
  <span>
    <?= $pager->parent(i('Home')); ?>
  </span>
  <span>
    <?= $pager->next(i('Next')); ?>
  </span>
</nav>
