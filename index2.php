<html>
<head>
<title>Text manager</title>
<link rel="stylesheet" href="https://unpkg.com/mustard-ui@latest/dist/css/mustard-ui.min.css">

</head>
<body>

<header style="height: 200px;">
<h1>Text manager</h1>
</header>

<?php              
    // Recovery of the web page content.
    /* $path = 'https://www.gutenberg.org/files/59101/59101-0.txt'; // A remplir avec l'url de la page web a aspirer */
                
    //$path="https://www.gutenberg.org/files/59101/59101-0.txt";

    $file ="";
    if(isset($_POST['poemURL']) && $_POST['poemURL'] !==""){ 
        $path = $_POST['poemURL']; 
        $words = array();   
/*         $file = fopen($path, "r");
        $chain = ''; */

        $file = file_get_contents($path);
                    
        // Creation of an array that contains all the words.
        // Action of downloading and displaying the text after giving an url.
/*         if($file){
            while(!feof($file)){
                $chain .= fgets($file,1024);
                $lineWord = preg_split('/\s+/', $chain);
                for($y = 0; $y < count($lineWord); $y++){
                    if($lineWord[$y]!==""){
                        array_push($words, $lineWord[$y]);
                    }
                }
            }
        } */
    }     
?>

<br>
<div class="row">
    <div class="col col-sm-5">
        <div class="panel">
            <div class="panel-body">
                <ol>
                    <div>
                        <h2>1. Get text</h2>
                        <!-- Form for downloading and displaying the text -->
<!--                         <?php
                            $path = "";
                            if(isset($_POST["poemURL"])) {
                                $path = $_POST["poemURL"];
                            }
                        ?> -->
                        <form action="index2.php" method="post">
                        <input type="text" name="poemURL" placeholder="Enter the poem url" value="<?=$path?>">
                        <br>
                        <input type="submit" value="FETCH TEXT"></form>
                    </div>
                    <div>
                        <h2>2. Find keywords</h2>
                        <form action="index2.php" method="post">
                        <input type="hidden" name="poemURL" value="<?=$path?>">
                        <input type="text" name="textS&H" placeholder="Enter the poem url">
                        <br>
                        <input type="submit" value="SEARCH TEXT"></form>
                    </div>

                
                </ol>

                <!-- Action of searching the words given -->
                <?php
/*                     echo "c'est lolo";
                    if(isset($_POST['textS&H']) && $_POST['textS&H'] !=="") {
                        $searchQ = $_POST['textS&H'];
                        $searchedWords = preg_split('/\s+/', $searchQ);
                        $numberOfTimeForEachWord = array(array());
                        for($i =0 ; $i < count($searchedWords); $i++){
                            $numberOfTime = array();
                            for($j =0 ; $j < count($words); $j++){
                                $wordConsidered = $words[$j];               
                                if($wordConsidered !== "" && stripos($wordConsidered, $searchedWords[$i])!==FALSE){
                                    array_push($numberOfTime,$wordConsidered);
                                }
                            }
                            array_push($numberOfTimeForEachWord, $numberOfTime);
                        }
                        echo "<h2>3. Check results</h2>
                            <div>
                                <form action=\"index2.php\" method=\"post\">
                                <br>";
                                for($t =0; $t < count($searchedWords); $t) {
                                    echo $searchedWords[$t];
                                    echo "<br>";
                                }
                            "</form></div>";
                    } */

                    if(isset($_POST['textS&H']) && $_POST['textS&H'] !=="") {
                        $searchQ = $_POST['textS&H'];
                        $searchedWords = preg_split('/\s+/', $searchQ);
                        $numberOfTimeForEachWord = array(array());
                        echo "<h2>3. Check results</h2>";

                        for($i =0 ; $i <= count($searchedWords); $i++) {

/*                             $verification = TRUE; */
                            $positionEvolving = 0;
                            $positionsForEachWord = array();
/*                             while($verification) {
                                $position = stripos($file, $searchedWords[$i], $positionEvolving);
                                if($position !== FALSE) {
                                    array_push($positionsForEachWord, $position);
                                    $positionEvolving = $position;
                                    if ($position === (strlen($file)-strlen($searchedWords[$i]))) {
                                        $verification = FALSE;
                                    }
                                } else {
                                    $verification = FALSE;
                                }
                            } */
                            // Doesn't take in consideration the first value !
                            echo "<br>";
                            echo $searchedWords[$i];
                            $position = stripos($file, $searchedWords[$i], $positionEvolving);
                            $k=0;
                            while($position !== FALSE) {
                                substr_replace($file, 'RR', $position, strlen($searchedWords[$i]));
                                array_push($positionsForEachWord, $position);
                                $positionEvolving = $position+1;
                                $position = stripos($file, $searchedWords[$i], $positionEvolving);
                                
                                echo " ";
                                echo $k;
                                echo " ";
                                $k++;
                            }
                            /* echo $positionsForEachWord; */
                            array_push($numberOfTimeForEachWord, $positionsForEachWord);
                        }
                    }
                ?>
            </div>
        </div>
        
    </div>

    <div class="col col-sm-7" style="padding-left: 25px;">
        <pre><code>           
            <?php echo $file ?>
        </code></pre>
    </div>
</div>

</body>
</html>
