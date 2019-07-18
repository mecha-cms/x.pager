<nav class="pager pager-title">
  <span>
  <?php if ($_prev = $pager->prev): ?>
  <a href="<?php echo $_prev; ?>" rel="prev"><?php echo $site->is('page') ? Page::from(PAGE . DS . Path::R($_prev, $url, DS) . '.page')->title : $language->prev; ?></a>
  <?php else: ?>
  <b><?php echo $language->prev; ?></b>
  <?php endif; ?>
  </span> <span>
  <?php if ($site->has('parent')): ?>
  <a href="<?php echo $parent->url; ?>"><?php echo $parent->title; ?></a>
  <?php else: ?>
  <a href="<?php echo $url; ?>"><?php echo $language->home; ?></a>
  <?php endif; ?>
  </span> <span>
  <?php if ($_next = $pager->next): ?>
  <a href="<?php echo $_next; ?>" rel="prev"><?php echo $site->is('page') ? Page::from(PAGE . DS . Path::R($_next, $url, DS) . '.page')->title : $language->next; ?></a>
  <?php else: ?>
  <b><?php echo $language->next; ?></b>
  <?php endif; ?>
  </span>
</nav>