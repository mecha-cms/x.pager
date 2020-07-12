<?php $pager = new PagerTitle\Page($pages->lot, $page->path, $parent->exist ? $parent : $page); ?>
<nav class="pager pager-title">
  <?php if ($pager->prev): ?>
  <span>
    <?= $pager->prev(i('Previous')); ?>
  </span>
  <?php endif; ?>
  <?php if ($pager->parent): ?>
  <span>
    <?= $pager->parent(i('Home')); ?>
  </span>
  <?php endif; ?>
  <?php if ($pager->next): ?>
  <span>
    <?= $pager->next(i('Next')); ?>
  </span>
  <?php endif; ?>
</nav>
