<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../libs/js_calendar_from_ics/js/main.js" type="application/javascript"></script>
</head>
<body>
    <?php 
        $_SESSION['projectId'] = $_POST['projectId'];
        header('Location: index.php') 
    ?>

    
</body>
</html>