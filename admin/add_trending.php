<?php
if (isset($_POST["adTrend"])) {
  $id = $_POST["adTrend"];
  include "db.php";
  $sql = "UPDATE `products_list` SET `Trending` = 'true' where `ID` = $id";
  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Successfully Added The Trending Item')</script>";
  } else {
    echo "<script>alert('Some Error Occoured While Adding The Trending Item')</script>";
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
      tr:nth-last-child(1) td:nth-last-child(9) {
        border-bottom-left-radius: 20px;
      }
    </style>
    <link rel="stylesheet" href="../CSS/admin_.css">
    <title>Contact Datas</title>
  </head>

  <body>
    <h3 class="desc">Add a trending product in the site.</h3>
    <br>
    <?php
    include "db.php";
    $sql = "SELECT * FROM `products_list` where `Trending` = 'false'";
    $result = mysqli_query($conn, $sql);
    echo "<table>";
    echo "<th>SN</th>
        <th>ID</th>
        <th>Name</th>
        <th>Manufacturer</th>
        <th>Cost</th>
        <th>Stock</th>
        <th>Sold</th>
        <th>Rating</th>
        <th>Action</th>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr id='" . $row["ID"] . "'>";
      echo "<td data-column='SN'>" . urldecode($row["SN"]) . "</td>";
      echo "<td data-column='ID'>" . urldecode($row["ID"]) . "</td>";
      echo "<td data-column='Name'>" . urldecode($row["Name"]) . "</td>";
      echo "<td data-column='Manufacturer'>" . urldecode($row["Manufacturer"]) . "</td>";
      echo "<td data-column='Cost'>" . urldecode($row["Cost"]) . "</td>";
      echo "<td data-column='Stock'>" . urldecode($row["Stock"]) . "</td>";
      echo "<td data-column='Sold'>" . urldecode($row["Sold"]) . "</td>";
      echo "<td data-column='Rating'>" . urldecode($row["Rating"]) . "</td>";
      echo "<td>
            &nbsp;&nbsp;&nbsp;<a onclick='expand(" . $row["ID"] . ",this)'><button class='show'>Expand</button></a><button class='edit' onclick='addTrend(" . urldecode($row["ID"]) . ")'>Add</button>
                  </td>";
      echo "</tr>";
    }

    echo "</table>";
    ?>
  </body>
  <script>
    function addTrend(id) {
      form = document.createElement("form");
      form.method = "POST";
      form.action = "add_trending.php";
      inp = document.createElement("input");
      inp.name = "adTrend";
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
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

  </html>