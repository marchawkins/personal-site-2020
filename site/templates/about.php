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

<main class="flex-grow">
  <h1 class="text-center text-2xl font-title pt-2 sm:pt-0 sm:text-3xl">Flannel + camo, 24/7</h1>
  
  <style>/*
        button {
        background-color: #6617cb;
        background-image: linear-gradient(315deg, #6617cb 0%, #cb218e 74%);
        box-shadow: 0 0 0 0 #ec008c, 0.2rem 0.2rem 30px #6617cb;
        }
        button:hover {
        box-shadow: 0 0 0 0 #ec008c, 0.2rem 0.2rem 60px #6617cb;
        }
    */</style>

  <!-- component -->
  <div class="w-screen flex justify-center items-center">
        
    <div class="container mx-auto max-w-xs rounded-lg overflow-hidden my-2 bg-white">
        <div class="relative mb-6">
          <img class="w-full" src="/assets/img/marc-about-photo.jpg" alt="Marc's profile photo"/>
          <div class="text-center absolute w-full" style="bottom: -30px">
              <div class="mb-10">
                <p class="text-white tracking-wide uppercase text-lg font-bold">Marc</p>
                <p class="text-gray-400 text-sm font-bold">marc[at]marchawkins.com</p>
              </div>
              <!-- <button class="p-4 rounded-full transition ease-in duration-200 focus:outline-none">
                <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6">
                    <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                      C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                      C15.952,9,16,9.447,16,10z" />
                </svg>
              </button> -->
          </div>
        </div>
        <div class="pb-2 grid grid-cols-3 gap-6">
          <div class="twitter bg-black p-4">
            <a href="https://twitter.com/marchawkins" title="find me on twitter"><img class="w-full" src="/assets/img/twitter.svg" alt="twitter logo"/></a>
          </div><!-- .twitter -->
          <div class="instagram bg-black p-4">
            <a href="https://www.instagram.com/marchawkins/" title="my photos on instagram"><img class="w-full" src="/assets/img/instagram.svg" alt="instagram logo"/></a>
          </div><!-- .instagram -->
          <div class="pinterest bg-black p-4">
            <a href="https://www.pinterest.com/marchawkins/" title="my picks on pinterest"><img class="w-full" src="/assets/img/pinterest.svg" alt="pinterest logo"/></a>
          </div><!-- .pinterest -->
        </div><!-- .grid -->
    </div>
  </div>
  
</main>

<?php snippet('footer') ?>
