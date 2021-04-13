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
  global $postsPerPage;
  $postsPerPage = 24;
?>

<?php snippet('header') ?>

<main class="flex-grow bg-black">
  <div class="container mx-auto">
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

    <div class="grid grid-cols-2 gap-4 px-2 sm:grid-cols-4 lg:grid-cols-6">
      <?php foreach ($notes as $note): ?>
        <?php snippet('note-block-single',['note' => $note]) ?>
      <?php endforeach ?>
    </div><!-- .grid -->

    <?php $pagination = $notes->pagination() ?>
    <?php if ($pagination->hasPages()): ?>
      <?php snippet('pagination',['pagination' => $pagination]) ?>
    <?php endif ?>
  </div><!-- .container -->
</main>

<?php snippet('footer') ?>
