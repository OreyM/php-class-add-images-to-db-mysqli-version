<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Images to DataBase</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<fieldset>
    <form action="scripts/tets.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <p><input type="file" name="imgFile" placeholder="Enter your file" size="30"></p>
        <input type="submit" name="addFile" value="Add file">
    </form>
</fieldset>

</body>
</html>