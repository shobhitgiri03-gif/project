<?php
    $fees=$_POST['num1'];
    $advance=$_POST['num2'];
    $feesbalance=$fees-$advance;
    echo "total fees:".$fees."<br>";
    echo "advance fees:".$advance."<br>";
    echo "balance fees:".$feesbalance."<br>";   
?>