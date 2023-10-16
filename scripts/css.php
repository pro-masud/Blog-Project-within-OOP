<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<?php 

$query = "SELECT * FROM blog_theme WHERE id = '1'";
$result = $DB -> select($query);

while($checkResult = $result -> fetch_assoc()){
if($checkResult['theme_name'] == 'default'){ ?>

    <link rel="stylesheet" href="./theme/default.css">

    <?php }else if($checkResult['theme_name'] == 'green'){ ?>
    <link rel="stylesheet" href="./theme/green.css">
    <?php }else if($checkResult['theme_name'] == 'red'){ ?>
        <link rel="stylesheet" href="./theme/red.css">
<?php } }?>