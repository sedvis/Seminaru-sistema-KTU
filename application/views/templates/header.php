<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 2016-09-29
 * Time: 10:21
 */
?>

<html>
<head>
    <title><?php echo $headTitle; ?></title>
    <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <?php
    if(isset($css))
    {
        if(is_array($css))
        {
            foreach ($css as $elem)
            {
                echo '<link rel="stylesheet" type="text/css" href="'.$elem.'">';
            }
        }
    }
    ?>

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="https://use.fontawesome.com/e46df1b79d.js"></script>
    
    <?php
    if(isset($js))
    {
        if(is_array($js))
        {
            foreach ($js as $elem)
            {
                echo '<script src="'.$elem.'"></script>';
            }
        }
    }
    ?>
</head>
<body>

