<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <script defer src="/js/script.js"></script>
    <script src="/js/util.js"></script>

    <title>Alexandra Daddario</title>
  </head>
  <body>
    <?php
      if(
        strpos($_SERVER["REQUEST_URI"], "profil") === false && 
        strpos($_SERVER["REQUEST_URI"], "admin") === false &&
        !in_array($_SERVER["REQUEST_URI"], ["/login"])
      )
        {
        require_once "../View/home/nav.php";
      }
    ?>