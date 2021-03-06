<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`. 
 * This home template renders content from others pages, the children of the `photography` page to display a nice gallery grid.
 * Snippets like the header and footer contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>

<?php snippet('header') ?>

<main class="flex-grow">
  <h1 class="text-center text-2xl font-hand text-black pt-2 sm:pt-0">Demented and sad, but social.</h1>
  <?php 
  // we always use an if-statement to check if a page exists to prevent errors 
  // in case the page was deleted or renamed before we call a method like `children()` in this case
  if ($notes = page('notes')): ?>
  <div class="container note_list mx-auto">
    <?php foreach ($notes->children()->listed()->flip()->limit(5) as $note): ?>
    <div class="note p-2 m-2 even:bg-gray-400">
      <a class="block sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>">
        <span class="block text-5xl font-mono tracking-tighter text-gray-900 sm:inline-block"><?php echo $note->date()->toDate('Y') ?>_<?php echo $note->date()->toDate('m') ?>.<?php echo $note->date()->toDate('d') ?></span>
        <span class="block text-sm leading-tight sm:inline-block sm:mt-2 sm:ml-4">
          <span class="block text-xs uppercase text-gray-500"><?php echo $note->date()->toDate('l, M jS') ?></span>
          <h2 class="text-2xl font-medium leading-tight text-gray-900"><?php echo $note->title() ?></h2>
          <?php /* if($loc = $note->mymap()->yaml()): ?>
            <span class="hidden sm:block text-xs text-gray-700"><?php echo($loc['city']) ?></span>
          <?php endif */ ?>
        </span>
      </a>
    </div><!-- .note -->
    <?php endforeach ?>
  </div><!-- .container.note_list -->
  <?php endif ?>
  
</main>

<?php snippet('footer') ?>
