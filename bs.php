<?php
    $salary=$_POST['bs'];
    $hra=$_POST['hra'];
    $da=$_POST['da'];
    $ta=$_POST['ta'];
    $pf=$_POST['pf'];

    $hra_amount=($salary*$hra)/100;
    $da_amount=($salary*$da)/100;
    $ta_amount=($salary*$ta)/100;
    $pf_amount=($salary*$pf)/100;
   
    $gross_salary= $salary+$hra_amount+$da_amount+$ta_amount-$pf_amount;
    $net_salary= $gross_salary-$pf_amount;

    echo "gross salary:".$gross_salary."<br>";
    echo "net salary:".$net_salary."<br>";
 ?>