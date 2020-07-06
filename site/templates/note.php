<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * This template is responsible for rendering all the subpages of the `notes` page.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`.
 * Snippets like the header and footer contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>

<?php snippet('header') ?>

<main>
  <article class="note container mx-auto">

  <div class="mx-auto px-4 py-8 max-w-xl">
        <div class="bg-white shadow-2xl rounded-lg mb-6 tracking-wide" >
          <?php if($image = $page->feature_image()->toFile()): ?>
            <div class="md:flex-shrink-0">
                <img src="<?php echo $image->url() ?>" alt="<?php echo $image->url() ?>" class="w-full  rounded-lg rounded-b-none">
            </div>
          <?php endif ?>
            <div class="px-4 py-2 mt-2">
                <h1 class="font-bold text-2xl text-gray-800 tracking-normal"><?php echo $page->title() ?></h1>
                    <p class="text-sm text-gray-700 px-2 mr-1">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora reiciendis ad architecto at aut placeat quia, minus dolor praesentium officia maxime deserunt porro amet ab debitis deleniti modi soluta similique...
                    </p>
                    <div class="flex items-center justify-between mt-2 mx-6">
                    <?php if ($page->tags()->isNotEmpty()) : ?>
                      <p class="note-tags tags"><?= $page->tags() ?></p>
                    <?php endif ?>
                         <a href="#" class="flex text-gray-700">
                            <svg fill="none" viewBox="0 0 24 24" class="w-6 h-6 text-blue-500" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </a>
                    </div>
                <div class="author flex items-center -ml-3 my-3">
                    <div class="user-logo">
                        <img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
                    </div>
                    <h4 class="text-sm tracking-tighter font-normal text-gray-600">
                        By <a href="/about" title="About Marc">Marc</a> on <time class="note-date"><?= $page->date()->toDate('d F Y') ?></time>
                    </h4>
                </div>
            </div>
        </div>
    </div>



      
      
      
      


    <div class="note-text text">
      <?= $page->text()->kt() ?>
    </div>

  </article>
</main>

<?php snippet('footer') ?>
