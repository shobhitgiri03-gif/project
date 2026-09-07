<?php
    $name=$_POST['un'];
    $password=$_POST['ps'];
    $gender=$_POST['gen'];
    $email=$_POST['em'];
    $contact=$_POST['cont'];
    $course=$_POST['course'];
?>


<table 
        style="width:600px; 
        border:1px solid red;
        background-color:lightblue;    
        color:red;
        text-align:center; 
        margin:0 auto;">
    <tr>
        <th> username </th>
        <th> password </th>
        <th> email </th>
        <th> gender </th>
        <th> contact </th>  
        <th> course </th>
    </tr>
    <tr>
        <td> <?php echo $name; ?> </td>
        <td> <?php echo $password;?></td>
        <td> <?php echo $email; ?></td>
        <td> <?php echo $gender; ?></td>
        <td> <?php echo $contact; ?></td>
        <td> <?php echo $course; ?></td>
    </tr>
</table>