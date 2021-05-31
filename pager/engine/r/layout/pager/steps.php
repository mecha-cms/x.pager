<?php

<<<<<<< HEAD
$p = $site->is('archives') || $site->is('tags') ? (object) [
=======
$p = $site->is('archives') || $site->is('tags')  ? (object) [
>>>>>>> 8afc13a0ecdfbcd9b15c0c5afa8d0699f41a40fa
    'link' => $url . $url->path
] : $page;

$pager = new PagerSteps\Pages($pages->lot, [$page->chunk ?? 5, ($url['i'] ?? 1) - 1], $p);

?>
<nav class="pager pager-steps">
  <span>
    <?= $pager->prev(i('Previous')); ?>
  </span> <span>
    <?= $pager->steps(""); ?>
  </span> <span>
    <?= $pager->next(i('Next')); ?>
  </span>
</nav>
