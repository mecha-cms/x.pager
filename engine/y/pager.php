<?php if ($prev = $pager->prev): ?>
  <a href="<?= eat($prev->link); ?>" rel="prev" title="<?= eat($prev->description); ?>">
    <?= $prev->title; ?>
  </a>
<?php else: ?>
  <a aria-disabled="true" rel="prev">
    <?= $prev->title; ?>
  </a>
<?php endif; ?>

<?php if ($next = $pager->next): ?>
  <a href="<?= eat($next->link); ?>" rel="next" title="<?= eat($next->description); ?>">
    <?= $next->title; ?>
  </a>
<?php else: ?>
  <a aria-disabled="true" rel="next">
    <?= $next->title; ?>
  </a>
<?php endif; ?>