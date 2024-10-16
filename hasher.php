<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasher</title>
</head>
<body>
    <form action="hasher.php" method="POST">
        <input value="sha256" placeholder="algorithm" type="text" name="algo">
        <input value ="prabin" type="text" name="str" placeholder="string">
        <button type="submit">Submit</button>
    </form>
    <p>
        The hash for the given string <b>"<?php echo $_POST["str"];?>"</b> using the <b>"<?php echo $_POST["algo"];?>"</b> algorithm is :
            <br>
            <?php echo hash($_POST["algo"],$_POST["str"]);
            ?> 
    </p>
    <input type="text" placeholder="place hash here" id="hash">
    <button id="dec">decrypt</button>
    <script>
    db = [{str:"8038@Zenith",hash:"b3ff16d9a134af46bdabf353862070d0ef510d9a985bd32cdfaa996f8ee996d8"},
    {str:"123",hash:"a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3"},
    {str:"8118@Divyam",hash:"04b4953ef7bd6be8295545b9efd0be590967915a9695dd2643c0d7a0b944860f"}
    ]
    document.querySelector("#dec").onclick = function(){
        val = document.querySelector("#hash").value;
        db.forEach(item => {
            if (item["hash"]== val) {
                alert("entry found logging in")
            }
        });
    }
    </script>
</body>
</html>