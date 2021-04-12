<?php
/**
 * This snippet will only work if you pass a $pagination object to it. It is
 * used in wherever we need to paginate results, such as weblog, search results, etc. 
 * Example usage:
 *  <?php $pagination = $notes->pagination() ?>
 *  <?php if ($pagination->hasPages()): ?>
 *     <?php snippet('pagination',['pagination' => $pagination]) ?>
 *  <?php endif ?>
 * This snippet would be used after a results query, and preferable within a check for
 * if pagination is necessary (as seen above)
 */
?>

<?php
  global $postsPerPage;
?>

<nav class="text-xl my-2">
  <ul class="flex justify-center">
    <?php if ($pagination->hasPrevPage()): ?>
      <li class="mx-1 px-3 py-2 text-terminal font-mono uppercase">
      <a href="<?= $pagination->prevPageURL() ?>" class="flex items-center"><span class="mx-1">&laquo; newer</span></a>
    </li>
    <?php endif ?>

    <?php foreach ($pagination->range($postsPerPage) as $r): ?>
      <li class="mx-1 px-3 py-2 text-terminal font-mono uppercase">
      <?php if($pagination->page() === $r ): ?>
        <span class="underline text-gray-600"><?php echo $r ?></span>
      <?php else: ?>
        <a<?php $pagination->page() === $r ? ' aria-current="page"' : '' ?> href="<?php echo $pagination->pageURL($r) ?>"><?php echo $r ?></a>
      <?php endif ?>
    </li>
    <?php endforeach ?>

    <?php if ($pagination->hasNextPage()): ?>
      <li class="mx-1 px-3 py-2 text-terminal font-mono uppercase">
      <a href="<?= $pagination->nextPageURL() ?>" class="flex items-center"><span class="mx-1">older &raquo;</span></a>
      </li>
    <?php endif ?>
  </ul>
</nav>