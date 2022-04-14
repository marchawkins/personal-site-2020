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

<style>
  #guestCapture {
    visibility: hidden;
    opacity: 0;
    max-height: 0;
    transition: opacity 250ms ease-in, max-height 250ms ease-in, visibility 0ms ease-in 250ms;
  }
  #guestCapture.show {
    visibility: visible;
    opacity: 1;
    max-height: 1000px;
  }
</style>

<main class="flex-grow bg-black text-gray-600 body-font"  id="guestbook">
 <div class="container mx-auto show" id="guestCapture">
  <h1 class="text-center text-2xl font-title text-white pt-2 sm:pt-0 sm:text-3xl">Post to Guestbook</h1>
  <div class="flex items-center">
    <div class="px-10 mx-auto align-middle">
      <div class="rounded-lg my-4 aspect-w-4 aspect-h-3 border-2 border-terminal overflow-hidden">
        <video class="videostream" autoplay></video><!-- used to hold the video stream from webcam -->
        <canvas class="hidden"></canvas><!-- used to hold the static capture from video stream -->
        <img id="screenshot-img" /><!-- used to hold the static capture from video stream (older browsers) -->
      </div><!-- .rounded-lg -->
      <p class="leading-relaxed text-terminal font-mono uppercase text-center">Click "initialize" and allow access to your webcam.</p>
      <div class="flex justify-center items-center">
        <button id="capture-button" class="flex mx-auto mt-6 text-black font-mono uppercase border-0 py-2 px-5 border-2 border-terminal bg-terminal focus:outline-none hover:bg-transparent hover:border-white hover:text-white rounded">Initialize webcam</button>
        <button id="take-button" class="hidden cursor-pointer mx-auto mt-6 text-black font-mono uppercase border-0 py-2 px-5 border-2 border-terminal bg-terminal focus:outline-none hover:bg-transparent hover:border-white hover:text-white rounded">Take photo</button>
        <button id="save-button" class="hidden cursor-pointer mx-auto mt-6 text-black font-mono uppercase border-0 py-2 px-5 border-2 border-terminal bg-terminal focus:outline-none hover:bg-transparent hover:border-white hover:text-white rounded">Save photo</button>
      </div><!--. flex -->
      </div><!-- .px-10.mx-auto -->
    </div><!-- .flex -->
  </div><!-- .container -->
  
  <?php
    $handle = opendir($_SERVER['DOCUMENT_ROOT'].'/_uploads/guestbook/');
    $captureArray = [];
    while($file = readdir($handle)){
      if($file !== '.' && $file !== '..' && $file !== '.DS_Store'){
       array_push($captureArray,$file);
      }
    }

    if(count($captureArray)>0) {
       // sort by filename, then put newest first
      natsort($captureArray);
      $captureArray = array_reverse($captureArray);
  ?>
    <div class="container py-12 mx-auto">
      <div class="flex flex-wrap w-full mb-8">
        <div class="w-full mb-6 lg:mb-0">
          <h1 class="text-center text-2xl font-title text-white pt-2 sm:pt-0 sm:text-3xl">Recent Visitors</h1>  
        </div><!-- .w-full -->
      </div><!-- .flex -->
      <div class="flex flex-wrap -m-4" id="thumbGallery">
        <?php foreach ($captureArray as $capture): ?>
          <div class="lg:w-1/4 p-4 w-1/2">
            <a href="/_uploads/guestbook/<?php echo $capture ?>" title="View Bigger" target="_blank" class="block relative h-48 rounded overflow-hidden"><img src="/_uploads/guestbook/<?php echo $capture ?>" alt="Photo Guestbook" class="object-cover object-center w-full h-full block"/></a>
          </div><!-- .lg -->
        <?php endforeach ?>
      </div><!-- .flex-wrap -->
    </div><!-- .container -->
  <?php } ?>
 <div id="debug" style="display:none; border: 1px solid #f00; padding: 10px; margin: 10px;"></div>
</main>

<script>
  // variable setup
  const constraints = {video: true};
  
  // define buttons
  const captureVideoButton = document.querySelector("#capture-button");
  const takeButton = document.querySelector("#take-button");
  const saveButton = document.querySelector("#save-button");

  //const downloadLink = document.querySelector("#download-link");

  // define media elements
  const img = document.querySelector("#guestCapture #screenshot-img");
  const video = document.querySelector("#guestCapture video");
  const canvas = document.createElement("canvas");
  
  // function to initialize video / retake photo button
  captureVideoButton.onclick = function () {
    // hide image in case it already holds a photo
    img.style.display = "none";

    // reinitialize video object
    video.src = '';
    video.load();

    // setup video object with stream & prep canvas size
    navigator.mediaDevices
    .getUserMedia(constraints)
    .then(handleSuccess)
    .catch(handleError);
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
  };

  // output the webcam stream to the video object
  function handleSuccess(stream) {
    //screenshotButton.disabled = false;
    video.srcObject = stream;

    // setup buttons
    captureVideoButton.classList.add('hidden');
    saveButton.classList.add('hidden');
    captureVideoButton.innerHTML = "Re-take Photo";
    takeButton.classList.remove('hidden');
  };

  // show alert if there was a problem starting video
  function handleError(stream) {
    alert('Whoops. Something is busted. My bad. Tweet me at @marchawkins');
  };

  // function to grab video still as an image
  takeButton.onclick = function() {
    // capture a video still to the canvas
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext("2d").drawImage(video, 0, 0);
    img.src = canvas.toDataURL("image/jpg");
    img.style.display = "block";
    //downloadLink.href = img.src;

    // setup the buttons
    takeButton.classList.add('hidden');
    saveButton.classList.remove('hidden');
    captureVideoButton.classList.remove('hidden');
    captureVideoButton.innerHTML = "Re-take Photo";

    // turn off the camera stream
    if(video.srcObject.active) {
      var track = video.srcObject.getTracks()[0];
      track.stop();
    }

  };
  
  // function to save image to the server via ajax request
  saveButton.onclick = function(){
    var photo = canvas.toDataURL('image/jpeg', 1.0);
    var data = new FormData();
    data.append("name", "pic");
    data.append("photo",photo);
    fetch("_lib/php/guestbook-uploader.php", { method: "POST", body: data }).then(function(response) {
      return response.text().then(function(text) {
      addToGallery(text);
      });
    });
    //document.querySelector("#guestCapture").style.display = "none";
    document.querySelector("#guestCapture").classList.remove('show');
  };
  
  function addToGallery(imgPath) {
    var capturePath = imgPath;
    newCapture = '<div class="lg:w-1/4 p-4 w-1/2 new"><a href="'+capturePath+'" title="View Bigger" target="_blank" class="block relative h-48 rounded overflow-hidden"><img src="'+capturePath+'" alt="Photo Guestbook" class="object-cover object-center w-full h-full block"/></a></div><!-- .lg -->';

    document.querySelector("#thumbGallery").innerHTML = newCapture + document.querySelector("#thumbGallery").innerHTML;

  }

</script>

<?php snippet('footer') ?>
