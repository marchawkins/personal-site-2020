<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`.
 * This template lists all all the subpages of the `notes` page with their title date sorted by date and links to each subpage.
 * Snippets like the header, footer and intro contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>

<?php
  $postsPerPage = 24;
?>

<?php snippet('header') ?>

<main class="flex-grow bg-black">

<div class="container note_list mx-auto">
  <div class="notes">
    <?php 
      $notes = $page->children()->listed()->flip();
      if($tag = urldecode(param('tag'))):
        $notes = $notes->filterBy('tags', $tag, ',');
      endif;
      $notes = $notes->paginate($postsPerPage);
    ?>
    
    <h1 class="text-center text-2xl font-title text-white p-4 sm:text-3xl">
    <?php if($tag = param('tag')): ?>
      Posts tagged with &ldquo;<?php echo urldecode(param('tag')) ?>&rdquo;
    <?php else : ?>
      Weblog
    <?php endif ?>
    </h1>

    <div class="grid grid-cols-2 gap-4 px-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 sm:gap-4 sm:px-0">
      <?php foreach ($notes as $note): ?>
        <div class="">
        <?php if($feature_image = $note->feature_image()->toFile()):
          $imgSrc = $feature_image->thumb()->url();
        else:
          $imgSrc = "/assets/img/weblog-thumb-missing.gif";
        endif ?>
          <a class="block sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>"><img src="<?php echo $imgSrc ?>" alt="<?php echo $note->title() ?>" width="300" class="object-cover h-48 sm:h-48 w-full"></a>
          <h2 class="text-base text-white font-title leading-tight mt-2"><a class="block hover:underline sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>"><?php echo $note->title() ?></a></h2>
          <h3 class="text-xs text-gray-500"><?php echo $note->date()->toDate('l, M jS') ?></h3>
        </div>
      <?php endforeach ?>
    </div><!-- .grid -->

    <?php $pagination = $notes->pagination() ?>
    <?php if ($pagination->hasPages()): ?>
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
    <?php endif ?>
</div><!-- .container -->
</main>

<?php snippet('footer') ?>
