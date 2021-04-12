<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`.
 * This example templates only echos the field values from the content file and doesn't need any special logic from a controller.
 * Snippets like the header, footer and intro contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>

<?php snippet('header') ?>

<main class="flex-grow bg-black">
  <div class="container mx-auto">

  <h1 class="text-center text-2xl font-title text-white pt-2 sm:pt-0 sm:text-3xl">Flannel + camo, 24/7</h1>
  
  <!-- component -->
  <div class="flex justify-center items-center">
        
    <div class="container mx-auto max-w-xs rounded-lg overflow-hidden my-2">
        <div class="relative">
          <img class="w-full" src="/assets/img/marc-about-photo.jpg" alt="Marc's profile photo"/>
          <div class="text-center absolute w-full" style="bottom: -20px">
              <div class="mb-10 bg-black">
                <p class="text-terminal text-xl font-mono uppercase">marc[at]marchawkins.com</p>
              </div>
          </div>
        </div>
        <p class="text-center font-mono text-terminal uppercase">Let's get social!</p>
        <?php snippet('social-icon-links') ?>
    </div><!-- .container -->
      </div>
  </div><!-- .container -->
</main>

<?php snippet('footer') ?>
