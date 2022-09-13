<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<form action="" method="post">
    <input type="text" name="num1" placeholder="Enter number1">
    <input type="text" name="num2" placeholder="Enter number2">
    <select name="Operator">
        <option value="none">none</option>
        <option value="Add">Add</option>
        <option value="Subtract">Subtract</option>
        <option value="Multiply">Multiply</option>
        <option value="Divided">Divided</option>
    </select>

    <button type="submit" name="submit" value="submit">Calculat</button>
    
</form>

<?php

    if(isset($_POST['submit']))
    {
        $num1=$_POST['num1'];
        $num2=$_POST['num2'];
        $Operator=$_POST['Operator'];

        switch($Operator){
            case 'none':
                echo"error";
                break;
            case 'Add':
                echo  $result =$num1+$num2;
                break;
            case 'Subtract':
                echo $result =$num1-$num2;
                break;
            case 'Multiply':
                echo $result =$num1*$num2;
                break;    
            case 'Divided':
                echo  $result =$num1/$num2;
                break;    
        }

    } 

   
?>

</body>
</html>
