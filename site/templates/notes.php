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

<?php snippet('header') ?>

<main>
  <?php snippet('intro') ?>


  <div class="notes">
    <?php foreach ($page->children()->listed()->sortBy('date', 'desc') as $note): ?>
    <article class="note">
      <header class="note-header">
        <a href="<?= $note->url() ?>">
          <h2><?= $note->title() ?></h2>
          <time><?= $note->date()->toDate('d F Y') ?></time>
        </a>
      </header>
      <!-- <figure>
      <?php
          // the `cover()` method defined in the `album.php` page model can be used 
          // everywhere across the site for this type of page ?>
          <figcaption>
            <span>
              <span class="example-name"><?php echo $note->title() ?>: <?php echo $note->date()->toDate('Ymd') ?></span>
              <?php if($image = $note->image()): ?>
              <img src="<?= $image->url() ?>" alt="<?php echo $note->title() ?>"/>
              <?php endif ?>
            </span>
          </figcaption>
        </figure> -->
    </article>
    <?php endforeach ?>
  </div>

</main>

<?php snippet('footer') ?>
