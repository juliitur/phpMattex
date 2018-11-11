<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/main.css">
  <!-- Import jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Import Modernizr for touch -->
<script src="js/modernizr-custom.js"></script>
<script src="js/main.js"></script>
  <title>404 | Mattress Tufting</title>
</head>

<body id="body-m">
  <section id="header">
    <div class="container">
      <div class="row">
        <div class="col text-center mt-4">
        <a href="index.php" class="brand text-white">MATTEX INTERNATIONAL</a>
    </div>
  </div>
</div>
  </section>

 <!-- 404 SECTION -->
 <section id="single-main">
   <div class="container">
     <div class="row text-center mt-5">
       <div class="col-md-12">
          <div class="card p-4">
            <div class="card-body">
       <h5 class="display-4">Sorry, but page was not found </h5>
       <div class="text-white">
         <h1 class="p-5 border rounded bg-danger text-center">404</h1>
        </div>
        <p>You may have mistyped the address or the page may have moved.</p>
        <div class="group-xl">
          <a href="index.php" class="btn btn-primary">Back to home</a>
          <a href="contact.php" class="btn btn-outline-success">Contact us</a>
        </div>
        </div>
       </div>
       </div>
     </div>
   </div>
 </section>

  <!-- FOOTER -->
  <?php
    //include the footer file.
    include_once("templates/footer.html");
  ?>

  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
    
  </script>
</body>

</html>