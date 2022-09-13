<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
</head>
<body>

<form action="" method="post" >
    <input type="text" name="name" placeholder="Enter ur name"> <br>
    <input type="text" name="loan" placeholder="loan u needs "> <br>
    <input type="text" name="years" placeholder="the number of years to be paid in "> <br>
    <button type="submit" name="submit" value="submit">calculate the monthly installment</button>
</form>
   
</body>
</html>

<?php
 
    if(isset($_POST['submit']))
    {
        $loan=$_POST['loan'];
        $years=$_POST['years'];
        
        if($years<=3){
            $interst=$loan*0.10;
            $num=$interst+$loan;
            $monthlyinstallment = $num/($years*12);
            echo $monthlyinstallment;
        }
        else{
            $interst=$loan*0.15;
            $num=$interst+$loan;
            $monthlyinstallment = $num/($years*12);
            echo $monthlyinstallment;
        }

    }
   
?>
