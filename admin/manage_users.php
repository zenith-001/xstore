<?php
// Include database connection file
include "db.php";

// Function to delete record from the database
function deleteRecord($conn, $id)
{
    $sql = "DELETE FROM user_accounts WHERE ID = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Deleting...";
        $folder_path = "../database/products/$id";

        // Delete the associated folder and its contents
        if (is_dir($folder_path)) {
            // Use recursive deletion to delete folder and its contents
            $success = deleteDir($folder_path);
            if ($success) {
                echo "Folder and its contents deleted successfully.";
            } else {
                echo "Failed to delete folder and its contents.";
            }
        } else {
            echo "Folder does not exist.";
        }
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
}

// Function to update record in the database
function updateRecord($conn, $id, $data)
{
    // Construct the SQL query to update the record
    $sql = "UPDATE user_accounts SET ";
    foreach ($data as $key => $value) {
        $sql .= "`$key` = '$value', ";
    }
    // Remove the trailing comma and space
    $sql = rtrim($sql, ", ");
    $sql .= " WHERE ID = $id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Success')</script>";
        return true; // Update successful
    } else {
        echo "<script>alert('Failure')</script>";
        return false; // Update failed
    }
}

// Check if a record deletion is requested
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if (deleteRecord($conn, $delete_id)) {
        echo "<script>alert('Record deleted successfully!');</script>";
        // Refresh the page or redirect to update the view
        echo "<script>window.location.href = 'manage_products.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to delete record!');</script>";
    }
}
// Check if record update is requested
if (isset($_POST['save'])) {
    // Construct an array with the updated data
    $id = $_POST['ID'];
    $data = array(
        "SN" => $_POST['SN'],
        "ID" => $_POST['ID'],
        "Name" => $_POST['Name'],
        "Manufacturer" => $_POST['Manufacturer'],
        "Type" => $_POST['Type'],
        "Cost" => $_POST['Cost'],
        "Ram" => $_POST['Ram'],
        "Display" => $_POST['Display'],
        "Processor" => $_POST['Processor'],
        "Graphics" => $_POST['Graphics'],
        "Color" => $_POST['Color'],
        "Stock" => $_POST['Stock'],
        "Hand" => $_POST['Hand'],
        "Description" => $_POST['Description'],
        "Sold" => $_POST['Sold'],
        "Rating" => $_POST['Rating'],
        "Reviews" => $_POST['Reviews'],
        "Image" => $_POST['Image']
    );
    updateRecord($conn, $id, $data);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />
    <link rel="stylesheet" href="../CSS/admin_.css">
    <style>
        tr:nth-last-child(1) td:nth-last-child(19) {
            border-bottom-left-radius: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
    <title>Manage Products</title>
</head>

<body>
    <!-- Your existing HTML code here -->

    <?php
    // Fetch all data from the database table
    $sql = "SELECT * FROM user_accounts";
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
            &nbsp;&nbsp;&nbsp;<a onclick='expand(" . $row["ID"] . ",this)'><button class='show'>Expand</button></a>
                    <button class='edit' onclick='editRow(" . $row["ID"] . ")'>Edit</button>
                    <button class='save' style='display: none;' onclick='saveRow(" . $row["ID"] . ")'>Save</button>
                    <a href='?delete_id=" . $row["ID"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'><button class='del'>Delete</button></a>
                  </td>";
            echo "</tr>";
        }

        // Close table
        echo "</table>";
    } else {
        echo "No data found.";
    }

    // Close database connection
    mysqli_close($conn);
    ?>

    <!-- JavaScript function to handle editing and saving -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function editRow(id) {
            // Get the row element
            var row = document.getElementById(id);

            // Loop through the row's cells
            for (var i = 0; i < row.cells.length - 1; i++) { // Exclude the last cell containing action buttons

                var cell = row.cells[i];
                var oldValue = cell.innerHTML.trim();
                // Replace cell content with input fields for editing
                if (i == 0 || i == 1) {
                    cell.innerHTML = "<input readonly type='text' name='" + cell.getAttribute('data-column') + "' value='" + oldValue + "' />";
                } else {
                    cell.innerHTML = "<input type='text' name='" + cell.getAttribute('data-column') + "' value='" + oldValue + "' />";
                }
            }

            // Hide the Edit button and show the Save button
            row.querySelector('.edit').style.display = 'none';
            row.querySelector('.save').style.display = '';
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

        function saveRow(id) {
            // Get the row element
            var row = document.getElementById(id);

            // Get the form data
            var formData = [];
            let form_ = document.createElement("form");
            form_.setAttribute("method", "POST");
            form_.setAttribute("action", "manage_products.php");
            var inputs = row.querySelectorAll('input');
            for (var i = 0; i < inputs.length; i++) {
                formData.push(inputs[i].value);
                var input_ = document.createElement("input");
                input_.name = inputs[i].name;
                if (input_.name !=="Image") {
                    input_.setAttribute("value", encodeURIComponent(inputs[i].value));
                }
                else{
                    input_.setAttribute("value", inputs[i].value);
                }
                form_.appendChild(input_);
            }
            console.log(form_)
            var input_ = document.createElement("input");
            input_.name = "save";
            input_.setAttribute("value", true);
            form_.appendChild(input_);
            form_.setAttribute("id", "updater");
            document.body.appendChild(form_);
            form_.submit();
            // document.getElementById("updater").submit();    
        }
    </script>
</body>

</html>