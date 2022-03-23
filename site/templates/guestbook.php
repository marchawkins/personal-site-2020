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

<main class="flex-grow bg-black text-gray-600 body-font"  id="guestbook">
 <div class="container  mx-auto" id="guestCapture">
  <h1 class="text-center text-2xl font-title text-white pt-2 sm:pt-0 sm:text-3xl">Sign my guestbook</h1>
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

      <p><a id="download-link" href="">Download Photo</a></p>
      <div id="gallery"></div>
    
    </div><!-- .px-10.mx-auto -->
  </div><!-- .flex -->
 </div><!-- .container -->

 <div id="debug" style="border: 1px solid #f00; padding: 10px; margin: 10px;"></div>
</main>

<script>
  // variable setup
  const constraints = {video: true};
  
  // define buttons
  const captureVideoButton = document.querySelector("#capture-button");
  const takeButton = document.querySelector("#take-button");
  const saveButton = document.querySelector("#save-button");

  const downloadLink = document.querySelector("#download-link");

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
    downloadLink.href = img.src;

    // setup the buttons
    takeButton.classList.add('hidden');
    saveButton.classList.remove('hidden');
    captureVideoButton.classList.remove('hidden');
    captureVideoButton.innerHTML = "Re-take Photo";


  };
  
  // function to save image to the server via ajax request
  saveButton.onclick = function(){
    var photo = canvas.toDataURL('image/jpeg', 1.0);
    var form = new FormData();
    form.append('photo',photo);
    form.append('name','profile pic');

    var request = new XMLHttpRequest();
    /*request.onreadystatechange = function () {
      if (this.readyState == 4) {
        debugOutput = document.querySelector("#debug");
        debugOutput.innerHTML = this.response;
      }
    };*/
    request.open('POST', '_lib/php/guestbook-uploader.php');
    request.onload = function () {
      debugOutput = document.querySelector("#debug");
        if (request.status == 200) {
          debugOutput.innerHTML = this.response;
        } else {
          alert('There was a problem. Try again later.');
        }
    };
    request.setRequestHeader('Content-type', 'multipart/form-data');
    request.send(form);
    alert(form['name']);
    /*
    canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      savePhoto(url);
    });
    */

  };

      /*
      var http = new XMLHttpRequest();
    http.onreadystatechange = function () {
      if (this.readyState == 4) {
        alert('Request has been sent, ' + this.response);
      }};

      http.open('POST', '/guestbook-uploader.php', true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      http.send('fruit=lemon&color=yellow');
    };


    var newImg = document.createElement('img'),
      url = URL.createObjectURL(blob);
    newImg.onload = function() {
    // no longer need to read the blob so it's revoked
      URL.revokeObjectURL(url);
    };

    newImg.src = url;
    document.body.appendChild(newImg);
  });*/

    
    /*
    alert(img.src);
    var opts = {
      method: 'GET',      
      headers: {}
    }
    */
 

</script>

<?php snippet('footer') ?>
