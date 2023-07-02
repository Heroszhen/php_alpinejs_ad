
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php
      if(
        strpos($_SERVER["REQUEST_URI"], "profil") === false && 
        strpos($_SERVER["REQUEST_URI"], "admin") === false &&
        !in_array($_SERVER["REQUEST_URI"], ["/login", "/maintenance"])
      )
        {
    ?>
    <script src="./js/alpinejs/mnav.js"></script>
    <?php } ?>
  </body>
</html>