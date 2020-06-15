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

<main>

  <?php 
  // we always use an if-statement to check if a page exists to prevent errors 
  // in case the page was deleted or renamed before we call a method like `children()` in this case
  if ($notes = page('notes')): ?>
  <h1 class="">Notes</h1>
  <div class="container note_list">
    <?php foreach ($notes->children()->listed()->flip()->limit(5) as $note): ?>
    <div class="note border-b p-2 m-2">
    
        <h3 class="text-2xl">_<?php echo $note->date()->toDate('Ymd') ?></h3>
        <h4><?php echo $note->date()->toDate('l, M jS') ?></h4>
        <h2 class="text-title"><a class="" href="<?= $note->url() ?>" title="Continue reading"><?php echo $note->title() ?></a></h2>
        <?php if($loc = $note->mymap()->yaml()): ?>
          <p class="text-sm"><?php echo($loc['city']) ?></p>
        <?php endif ?>
    
      <?php /* <a class="block" href="<?= $note->url() ?>" title="Continue reading">
        <span class="block text-xl font-title">_<?php echo $note->date()->toDate('Ymd') ?></span>
        <span class="block text-sm">
          <span class="text-xs"><?php echo $note->date()->toDate('l, M jS') ?></span>
          <h2 class=""><?php echo $note->title() ?></h2>
          <?php if($loc = $note->mymap()->yaml()): ?>
            <span class=""><?php echo($loc['city']) ?></span>
          <?php endif ?>
        </span>
      </a> */ ?>
      </div><!-- .note -->
    <?php endforeach ?>
  </div><!-- .container.note_list -->
  <?php endif ?>
  
</main>

<?php snippet('footer') ?>
