<?php if(isset($_SERVER['HTTP_ARRAY_DATA'])){ $_POST = json_decode($_SERVER['HTTP_ARRAY_DATA'],"false"); } ?>
<!doctype html>
<html>
<head>
    <title>OHS Tests</title>    
</head>
<body>
    <?php print_r($_POST); ?>
    <form action="" method="POST">
        <input type="text" name="test" placeholder="test" />
        <input type="file" name="file" />
        <button type="submit">Submit</button>
    </form>
</body>
</html>