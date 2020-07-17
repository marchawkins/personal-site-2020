<?php /* 404 page template */ ?>

<?php snippet('header') ?>

<main class="flex-grow">
  <article class="note mx-auto pb-4 max-w-4xl">

    <div class="bg-white shadow-2xl mb-4 tracking-wide" >
      <img src="/assets/img/404-image.jpg" alt="404 image"/>
      <div class="px-2 sm:px-4 pb-2 mt-2">
          <h1 class="px-2 mr-1 mb-2 font-normal text-4xl text-gray-800 text-center tracking-tight uppercase font-title leading-tight sm:leading-normal"><?php echo $page->title() ?></h1>
          
          <!-- main content -->
          <div class="note-content text-sm text-gray-700 px-2 mr-1 mb-6">
            <?php echo $page->text()->kirbytext();?>
          </div>
      </div>
    </div>
  </article>
</main>

<?php snippet('footer') ?>
