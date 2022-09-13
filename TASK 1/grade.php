<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post" >
    <input type="text" name="physics" placeholder="Enter ur degree in physics"> <br>
    <input type="text" name="chemistry" placeholder="Enter ur degree in chemistry"> <br>
    <input type="text" name="biology" placeholder="Enter ur degree in biology"> <br>
    <input type="text" name="mathematics" placeholder="Enter ur degree in mathematics"><br>
    <input type="text" name="computer" placeholder="Enter ur degree in computer"><br>
    <button type="submit" name="submit" value="submit">calculate</button>
</form>


    <?php 
// if($_SERVER["REQUEST_METHOD"] == 'POST'&& $_POST )
// {

    if (isset($_POST['submit'])) {
    $phy=$_POST['physics'];
    $chem=$_POST['chemistry'];
    $bio=$_POST['biology'];
    $math=$_POST['mathematics'];
    $cmp=$_POST['computer'];
    $grades=[$phy,$chem,$bio,$math,$cmp];
    $average =  array_sum($grades)/count($grades);
    $presentage=((($average)/100))*100;
    
    if($presentage>=90){
        $massege="(".$presentage.")&A";
    }

    elseif($presentage>=80){
        $massege="(".$presentage.")&B";
    }

    elseif($presentage>=70){
        $massege="(".$presentage.")&C";
    }

    elseif($presentage>=60){
        $massege="(".$presentage.")&D";
    }

    elseif($presentage>=40){
        $massege="(".$presentage.")&E";
    }

    else{
        $massege="(".$presentage.")&F";
    }

    echo $massege;
    
// }
    }
?>

</body>
</html>