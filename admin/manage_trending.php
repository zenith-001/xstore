<?php
if (isset($_POST["rmTrend"])) {
  $id = $_POST["rmTrend"];
  include "db.php";
  $sql = "UPDATE `products_list` SET `Trending` = 'false' where `ID` = $id";
  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Successfully Removed The Trending Item')</script>";
  } else {
    echo "<script>alert('Some Error Occoured While Removing The Trending Item')</script>";
  }
}
?>

<!DOCTYPE html>
<func lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
    <style>
      tr:nth-last-child(1) td:nth-last-child(19) {
        border-bottom-left-radius: 20px;
      }
    </style>
    <link rel="stylesheet" href="../CSS/admin_.css">
    <title>Contact Datas</title>
  </head>

  <body>
    <h3 class="desc">Manage the list of trending products in the site.</h3>
    <br>
    <?php
    include "db.php";
    $sql = "SELECT * FROM `products_list` WHERE `Trending`= 'true'";
    $result = mysqli_query($conn, $sql);
    // Check if any data exists
    if (mysqli_num_rows($result) > 0) {
      // Output table header
      echo "<table>";
      echo "<th>SN</th>
        <th>ID</th>
        <th>Name</th>
        <th>Manufacturer</th>
        <th>Type</th>
        <th>Cost</th>
        <th>Ram</th>
        <th>Display</th>
        <th>Processor</th>
        <th>Graphics</th>
        <th>Color</th>
        <th>Stock</th>
        <th>Hand</th>
        <th>Description</th>
        <th>Sold</th>
        <th>Rating</th>
        <th>Reviews</th>
        <th>Images</th>
        <th>Action</th>";

      // Output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr id='" . $row["ID"] . "'>";
        echo "<td data-column='SN'>" . urldecode($row["SN"]) . "</td>";
        echo "<td data-column='ID'>" . urldecode($row["ID"]) . "</td>";
        echo "<td data-column='Name'>" . urldecode($row["Name"]) . "</td>";
        echo "<td data-column='Manufacturer'>" . urldecode($row["Manufacturer"]) . "</td>";
        echo "<td data-column='Type'>" . urldecode($row["Type"]) . "</td>";
        echo "<td data-column='Cost'>" . urldecode($row["Cost"]) . "</td>";
        echo "<td data-column='Ram'>" . urldecode($row["Ram"]) . "</td>";
        echo "<td data-column='Display'>" . urldecode($row["Display"]) . "</td>";
        echo "<td data-column='Processor'>" . urldecode($row["Processor"]) . "</td>";
        echo "<td data-column='Graphics'>" . urldecode($row["Graphics"]) . "</td>";
        echo "<td data-column='Color'>" . urldecode($row["Color"]) . "</td>";
        echo "<td data-column='Stock'>" . urldecode($row["Stock"]) . "</td>";
        echo "<td data-column='Hand'>" . urldecode($row["Hand"]) . "</td>";
        echo "<td data-column='Description'>" . urldecode($row["Description"]) . "</td>";
        echo "<td data-column='Sold'>" . urldecode($row["Sold"]) . "</td>";
        echo "<td data-column='Rating'>" . urldecode($row["Rating"]) . "</td>";
        echo "<td data-column='Reviews'>" . urldecode($row["Reviews"]) . "</td>";
        echo "<td data-column='Image'>" . urldecode($row["Image"]) . "</td>";
        echo "<td>
            &nbsp;&nbsp;&nbsp;<a onclick='expand(" . $row["ID"] . ",this)'><button class='show'>Expand</button></a><button onclick='rmTrending(" . $row["ID"] . ")' class='del'>Remove</button>
                  </td>";
        echo "</tr>";
      }

      // Close table
      echo "</table>";
    } else {
      echo "<h4 style='color:#994444' class='desc'>No trending product found.</h4>";
    }

    ?>

  </body>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
    function rmTrending(id) {
      form = document.createElement("form");
      form.method = "POST";
      form.action = "manage_trending.php";
      inp = document.createElement("input");
      inp.name = "rmTrend";
      inp.value = id;
      form.appendChild(inp);
      document.body.appendChild(form);
      form.submit();
    }
    document.querySelectorAll(".show").forEach(x => {
            x.click()
        });

        function expand(id_, z) {
            elem = document.getElementById(JSON.stringify(id_));
            arr_ = elem.children;

            for (let x of arr_) {
                if (x.style.whiteSpace == "nowrap") {
                    x.style.whiteSpace = "normal";
                    z.querySelector("button").innerHTML = "Retract";
                } else {
                    x.style.whiteSpace = "nowrap";
                    z.querySelector("button").innerHTML = "Expand";
                }
            }
        }

  </script>

  </html>