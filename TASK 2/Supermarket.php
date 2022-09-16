
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
    <input type="text" name="name" placeholder="Enter ur name"  size="50"> <br>
    <select name="City"> <br>
        <option value="Cairo" name="Cairo" >Cairo</option> <br>
        <option value="Giza" name="Giza" >Giza</option> <br>
        <option value="Alex" name="Alex" >Alex</option> <br>
        <option value="Other" name="Other" >Other</option>
        </select>
        <br>
        <input type="number" name="phones" placeholder="number of phones u want to buy"  size="50" > <br>
        <input type="number" name="Computers" placeholder="number of computers u want to buy"  size="50" > <br>
        <input type="number" name="laptops" placeholder="number of laptops u want to buy"  size="50" > <br>

    <button type="submit" name="submit" value="submit">Checkout</button>
</form>
    
</body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        $City=$_POST['City'];

        
        $phones=$_POST['phones'];
        $Computers=$_POST['Computers'];
        $laptops=$_POST['laptops'];
        $sum=(($laptops*1000)+($Computers*2000)+($phones*3000));
    

        switch($City){

            case 'Cairo':
                if($sum<100){
                    echo "Delivery Fees=0 & discount=0% & TOTAL= $sum";
                    break;
                }
                elseif($sum<3000){
                    $total=$sum*0.9;
                    echo "Delivery Fees=0 & discount=10% & TOTAL= $total";
                    break;
                }
                elseif($sum<4500){
                    $total=$sum*0.80;
                    echo "Delivery Fees=0 & discount=15% & TOTAL= $total";
                    break;
                }
                elseif($sum>4500){
                    $total=$sum*0.85;
                    echo "Delivery Fees=0 & discount=20% & TOTAL= $total";
                    break;
                }

            case 'Giza':
                if($sum<100){
                    $total=$sum+30;
                    echo "Delivery Fees=30 & discount=0% & TOTAL= $total";
                    break;
                }
                elseif($sum<3000){
                    $total=($sum*0.9)+30;
                    echo "Delivery Fees=30 & discount=10% & TOTAL= $total";
                    break;
                }
                elseif($sum<4500){
                    $total=($sum*0.85)+30;
                    echo "Delivery Fees=30 & discount=15% & TOTAL= $total";
                    break;
                }
                elseif($sum>4500){
                    $total=($sum*0.80)+30;
                    echo "Delivery Fees=30 & discount=20% & TOTAL= $total";
                    break;
                }

            case 'Alex':
                if($sum<100){
                    $total=$sum+50;
                    echo "Delivery Fees=50 & discount=0% & TOTAL= $total";
                    break;
                }
                elseif($sum<3000){
                    $total=($sum*0.9)+50;
                    echo "Delivery Fees=50 & discount=10% & TOTAL= $total";
                    break;
                }
                elseif($sum<4500){
                    $total=($sum*0.85)+50;
                    echo "Delivery Fees=50 & discount=15% & TOTAL= $total";
                    break;
                }
                elseif($sum>4500){
                    $total=($sum*0.80)+50;
                    echo "Delivery Fees=50 & discount=20% & TOTAL= $total";
                    break;
                }

            case 'Other':
                if($sum<100){
                    $total=$sum+100;
                    echo "Delivery Fees=100 & discount=0% & TOTAL= $total";
                    break;
                }
                elseif($sum<3000){
                    $total=($sum*0.9)+100;
                    echo "Delivery Fees=100 & discount=10% & TOTAL= $total";
                    break;
                }
                elseif($sum<4500){
                    $total=($sum*0.85)+100;
                    echo "Delivery Fees=100 & discount=15% & TOTAL= $total";
                    break;
                }
                elseif($sum>4500){
                    $total=($sum*0.80)+100;
                    echo "Delivery Fees=100 & discount=20% & TOTAL= $total";
                    break;
                }    
            }
        

        }

?>
