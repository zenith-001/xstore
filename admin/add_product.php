<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  include "db.php";
  $pr_name = filter_var($_REQUEST['name'], FILTER_SANITIZE_ENCODED);
  $manufacturer = filter_var($_REQUEST['manufacturer'], FILTER_SANITIZE_ENCODED);
  $type = filter_var($_REQUEST['type'], FILTER_SANITIZE_ENCODED);
  $cost = filter_var($_REQUEST['cost'], FILTER_SANITIZE_ENCODED);
  $ram = filter_var($_REQUEST['ram'], FILTER_SANITIZE_ENCODED);
  $storage = filter_var($_REQUEST['storage'], FILTER_SANITIZE_ENCODED);
  $display = filter_var($_REQUEST['display'], FILTER_SANITIZE_ENCODED);
  $processor = filter_var($_REQUEST['processor'], FILTER_SANITIZE_ENCODED);
  $graphics = filter_var($_REQUEST['graphics'], FILTER_SANITIZE_ENCODED);
  $color = filter_var($_REQUEST['color'], FILTER_SANITIZE_ENCODED);
  $stock = filter_var($_REQUEST['stock'], FILTER_SANITIZE_ENCODED);
  $hand = filter_var($_REQUEST['hand'], FILTER_SANITIZE_ENCODED);
  $description = filter_var($_REQUEST['description'], FILTER_SANITIZE_ENCODED);
  $trending = filter_var($_REQUEST['trending'], FILTER_SANITIZE_ENCODED);
  $identity = $_REQUEST['identity'];
  $xxx = "";
  $blogdir = "../database/products/$identity";
  if (!file_exists($blogdir)) {
    mkdir(".../database/products/" . $identity, 0777, true);
  }
  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
    // Directory where images will be stored
    $targetDir = "$blogdir/res/";
    $xxx = "$blogdir/res";
    // Create the uploads directory if it doesn't exist
    if (!file_exists($targetDir)) {
      mkdir($targetDir, 0777, true);
    }

    // Counter for renaming images
    $counter = 1;

    // Loop through each uploaded file
    foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
      $name = $_FILES["images"]["name"][$key];
      $targetFile = $targetDir . $counter . "." . pathinfo($name, PATHINFO_EXTENSION);
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

      // Check if file already exists
      if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
      } else {
        // Check if file is an actual image
        $check = getimagesize($tmp_name);
        if ($check !== false) {
          // Allow certain file formats
          if ($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "gif") {
            // Attempt to move uploaded file to designated folder
            if (move_uploaded_file($tmp_name, $targetFile)) {
              echo "The file " . basename($name) . " has been uploaded as " . $counter . "." . $imageFileType . "<br>";
              $counter++; // Increment counter for the next file
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          }
        } else {
          echo "File is not an image.";
        }
      }
    }
  } else {
    echo "No files were uploaded.";
  }
  $files = scandir($xxx);
  $totalFiles = count($files) - 2;
  $file_upload_str = "database/products/$identity/res";
  if ($trending == "true") {
    $trending = "true";
  }
  else{
    $trending = "false";
  }
  $sql = "INSERT INTO `products_list` (`ID`, `Name`, `Manufacturer`, `Type`, `Cost`, `Ram`, `Storage`, `Display`, `Processor`, `Graphics`, `Color`, `Stock`, `Hand`, `Description`,`Image`,`Trending`) VALUES ('$identity', '$pr_name', '$manufacturer', '$type', '$cost', '$ram', '$storage', '$display', '$processor', '$graphics', '$color', '$stock', '$hand', 'description','$file_upload_str', '$trending');";
  $request = mysqli_query($conn, $sql);
  if ($request) {
    $status = "Successful";
    echo $status;
  } else {
    $status = "Error: " . mysqli_error($conn);
    echo $status;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />
  <link rel="stylesheet" href="../CSS/admin_.css">

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
  <link rel="stylesheet" href="../CSS/form_design.css">
  <title>Contact Datas</title>
</head>

<body>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <h3 class="desc">Upload a product to the site from here.</h3>
  <br>
  <form action="add_product.php" method="POST" enctype="multipart/form-data">
    Product Name: <br>
    <input maxlength="125" minlength="5" required placeholder="Name" type="text" name="name"><br><br>
    Product Manufacturer: <br>
    <input maxlength="125" minlength="5" required placeholder="Manufacturer" type="text" name="manufacturer"><br><br>
    Product Type: <br>
    <input maxlength="125" minlength="1" required placeholder="Type" type="text" name="type"><br><br>
    Product Cost: <br>
    <input maxlength="75" minlength="1" required placeholder="Cost" type="text" name="cost"><br><br>
    Product Ram: (GB/DDR?) <sub style="font-weight: 400;">eg:(8/4)</sub> <br>
    <input maxlength="95" minlength="1" required placeholder="Ram" type="text" name="ram"><br><br>
    Product Storage: (GB/Type) <sub style="font-weight: 400;">eg:(256/SSD)</sub> <br>
    <input maxlength="95" minlength="1" required placeholder="Storage" type="text" name="storage"><br><br>
    Product Display: <br>
    <input maxlength="333" minlength="1" required placeholder="Display" type="text" name="display"><br><br>
    Product Processor: <br>
    <input maxlength="333" minlength="1" required placeholder="Processor" type="text" name="processor"><br><br>
    Product Graphics Card: <br>
    <input maxlength="333" minlength="1" required placeholder="Graphics Card" type="text" name="graphics"><br><br>
    Product Color Varient: <br>
    <input maxlength="25" minlength="1" required placeholder="Color Varient" type="text" name="color"><br><br>
    Stock Pieces: <br>
    <input maxlength="25" minlength="1" required placeholder="Stock Pieces" type="text" name="stock"><br><br>
    Product Hand: (First/Second)<br>
    <input maxlength="25" minlength="1" required placeholder="Hand" type="text" name="hand"><br><br>
    <!-- <input type="hidden" name="date"> -->
    <input type="hidden" name="identity">
    Thumbnail Image:<br>
    <input required id="file" type="file" name="images[]" accept="images/*" multiple><br><br>
    Product Description:<br>
    <textarea minlength="10" maxlength="2500" required placeholder="Description" name="description"></textarea><br>
    Trending:
    <input style="margin-left:-100px; margin-top:4px;" type="checkbox" name="trending" value="true"><br><br>

    <button type="submit">Upload</button>
    <div class="status">
      <?php
      if (isset($status)) {
        echo $status;
      }
      ?>
    </div>
    <script>
      x = new Date()
      // document.getElementsByName("date")[0].value = `${x.getUTCFullYear()}/${x.getUTCMonth() + 1}/${x.getUTCDate()}`
      document.getElementsByName("identity")[0].value = Date.now();
    </script>
  </form>
</body>

</html>