<html>
<head>
<title>Hello World</title>
</head>
<body>
<?php

if(!isset($_GET['op']) || !isset($_GET['x'] || !isset($_GET['y']))) {
    echo "<h1>Incorrect or incomplete data</h1>";
    exit();
}
$x = $_GET['x'];
$y = $_GET['y'];

switch ($_GET['op']){
    
    case 'sum':
        $result = $x+$y;
        echo "<h1>$x +$y = $result</h1>";
        break;
    
    case 'substract':
        $result = $x-$y;
        echo "<h1>$x -$y = $result</h1>";
        break;
    
    case 'divide' :
        if($y == 0){
            echo "<h1> Cannot divide by zero!</h1>";
        }
        
        else{
            $result = $x / $y;
            echo "<h1>$x /$y = $result</h1>";
        }
        break;

    case 'multiply' : 
        $result = $x * $y;
        echo "<h1>$x x $y = $result</h1>";
        break;
    
    default:
        $op = $_GET['op'];
        echo "<h1>Unrecognized operation : $op</h1>";
}

?>
</body>
</html>

