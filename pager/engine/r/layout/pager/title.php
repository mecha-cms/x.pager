<nav class="pager pager-title">
  <span>
  <?php if ($_prev = $pager->prev): ?>
  <a href="<?= strtr($_prev, ['&' => '&amp;']); ?>" rel="prev"><?= $site->is('page') ? (new Page(LOT . DS . 'page' . DS . Path::R($_prev, $url) . '.page'))->title : i('Previous'); ?></a>
  <?php else: ?>
  <b><?= i('Previous'); ?></b>
  <?php endif; ?>
  </span> <span>
  <?php if ($site->has('parent')): ?>
  <a href="<?= $parent->url . $url->query('&amp;') . $url->hash; ?>"><?= $parent->title; ?></a>
  <?php else: ?>
  <a href="<?= $url; ?>"><?= i('Home'); ?></a>
  <?php endif; ?>
  </span> <span>
  <?php if ($_next = $pager->next): ?>
  <a href="<?= strtr($_next, ['&' => '&amp;']); ?>" rel="prev"><?= $site->is('page') ? (new Page(LOT . DS . 'page' . DS . Path::R($_next, $url) . '.page'))->title : i('Next'); ?></a>
  <?php else: ?>
  <b><?= i('Next'); ?></b>
  <?php endif; ?>
  </span>
</nav>