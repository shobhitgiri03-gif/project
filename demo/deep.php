<?php
    $num1=$_POST['num1'];
    $num2=$_POST['num2'];
    $option=$_POST['gen'];

    if($option=="add")
    {
        $result=$num1+$num2;
    }
    else if($option=="sub")
    {
        $result=$num1-$num2;
    }
    else if($option=="mul")
    {
        $result=$num1*$num2;
    }
    else if($option=="div")
    {
        $result=$num1/$num2;
    }

?>

<h1> <?php echo $result;?> </h1>