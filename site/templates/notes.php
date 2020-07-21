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

<main class="flex-grow">

<div class="container note_list mx-auto">
  <div class="notes">
    <?php 
      $notes = $page->children()->listed()->flip();
      if($tag = param('tag')):
        $notes = $notes->filterBy('tags', $tag, ',');
      endif;
      $notes = $notes->paginate(20)
    ?>
    
    <h1 class="text-center text-2xl font-title pt-2 sm:pt-0 sm:text-3xl">
    <?php if($tag = param('tag')): ?>
      Notes tagged with &ldquo;<?php echo param('tag') ?>&rdquo;
    <?php else : ?>
      Notes
    <?php endif ?>
    </h1>

    <?php foreach ($notes as $note): ?>
      <div class="note p-2 m-2 even:bg-gray-400">
      <a class="block sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>">
        <span class="block text-5xl font-mono tracking-tighter text-gray-900 sm:inline-block"><?php echo $note->date()->toDate('Y') ?>_<?php echo $note->date()->toDate('m') ?>.<?php echo $note->date()->toDate('d') ?></span>
        <?php /* if($feature_image = $note->feature_image()->toFile()): ?>
          <span class="hidden sm:block w-16 h-16">
                <img src="<?php echo $feature_image->thumb()->url() ?>" alt="<?php echo $note->title() ?>" class="object-scale-down">
            </span>
          <?php endif */ ?>
        <span class="block text-sm leading-tight sm:inline-block sm:mt-2 sm:ml-4">
          <span class="block text-xs uppercase text-gray-500"><?php echo $note->date()->toDate('l, M jS') ?></span>
          <h2 class="text-2xl font-medium leading-tight text-gray-900"><?php echo $note->title() ?></h2>
          <?php /* if($loc = $note->mymap()->yaml()): ?>
            <span class="hidden sm:block text-xs text-gray-700"><?php echo($loc['city']) ?></span>
          <?php endif */ ?>
        </span>
      </a>
    </div><!-- .note -->
    <?php /*
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
    */ ?>
    <?php endforeach ?>
    
    <?php if ($notes->pagination()->hasPages()): ?>
    <!-- pagination component -->
    <div class="flex pagination justify-center my-4">
    
      <?php if ($notes->pagination()->hasNextPage()): ?>
        <a href="<?= $notes->pagination()->nextPageURL() ?>" title="older notes">
          <button class="border border-gray-500 text-gray-500 block rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-gray-900 hover:text-white">
          <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
              <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
          </svg> Previous page
        </button>
      </a>
      <?php endif ?>
      
      <?php if ($notes->pagination()->hasPrevPage()): ?>
        <a href="<?= $notes->pagination()->prevPageURL() ?>" title="newer notes">
          <button class="border border-gray-500 text-gray-500 block rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-gray-900 hover:text-white">
          Next page <svg class="h-5 w-5 ml-2 fill-current" clasversion="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
              viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_11_" d="M-24,422h401.645l-72.822,72.822c-9.763,9.763-9.763,25.592,0,35.355c9.763,9.764,25.593,9.762,35.355,0
              l115.5-115.5C460.366,409.989,463,403.63,463,397s-2.634-12.989-7.322-17.678l-115.5-115.5c-9.763-9.762-25.593-9.763-35.355,0
              c-9.763,9.763-9.763,25.592,0,35.355l72.822,72.822H-24c-13.808,0-25,11.193-25,25S-37.808,422-24,422z"/>
          </svg>
          </button>
        </a>
      <?php endif ?>

    </div><!-- .flex -->
<?php endif ?>
   

</div><!-- .container -->
</main>

<?php snippet('footer') ?>
