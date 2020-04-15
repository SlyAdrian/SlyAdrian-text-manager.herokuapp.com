<html>
<head>
  <title>Text manager</title>
  <link rel="stylesheet" href="https://unpkg.com/mustard-ui@latest/dist/css/mustard-ui.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
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
    }
    $searchQ = "";
    if(isset($_POST['textS&H'])) {
      $searchQ = $_POST['textS&H'];
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
              <!--                         
              <?php
                $path = "";
                if(isset($_POST["poemURL"])) {
                  $path = $_POST["poemURL"];
                }
              ?> -->
              <form action="index.php" method="post">
                <input type="text" name="poemURL" placeholder="Enter the poem url" value="<?=$path?>">
                <br>
                <button type="submit" class="button-success">FETCH TEXT</button>
              </form>
            </div>
            <div>
              <h2>2. Find keywords</h2>
              <form action="index.php" method="post">
                <input type="hidden" name="poemURL" value="<?=$path?>">
                <input type="text" name="textS&H" placeholder="Enter the poem url" value="<?=$searchQ?>">
                <br>
                <button type="submit" class="button-success">SEARCH TEXT</button>
              </form>
            </div>                
          </ol>

          <!-- Action of searching the words given -->
          <?php
            if($searchQ !=="") {
              $searchedWords = preg_split('/\s+/', $searchQ);
              $numberOfTimeForEachWord = array(array());
              echo "<h2>3. Check results</h2>
                    <br>
                    <div class='stepper'>";

              for($i =0 ; $i < count($searchedWords); $i++) {
                $positionEvolving = 0;
                $positionsForEachWord = array();
                // Doesn't take in consideration the first value !

                $position = stripos($file, $searchedWords[$i], $positionEvolving);
                $number = 0;
                while($position !== FALSE) {
                  $number++;
                  $replacementStr = "<mark id=\"$searchedWords[$i]-$number\">$searchedWords[$i]</mark>";
                  $file = substr_replace($file, $replacementStr, $position, strlen($searchedWords[$i]));

                  array_push($positionsForEachWord, $position);
                  $positionEvolving = $position + strlen($replacementStr);       
                  $position = stripos($file, $searchedWords[$i], $positionEvolving);
                }
                echo "<div class='step'>
                <p class='step-number'> $number </p> 
                <p class='step-title'> Keyword: $searchedWords[$i]</p>";
                for($j = 1; $j <= count($positionsForEachWord); $j++){
                  $y = $j-1;
                  echo " ";
                  echo "<a href= '#$searchedWords[$i]-$j'>$j</a>";    
                  echo " ";
                }
                echo "</div>";
                array_push($numberOfTimeForEachWord, $positionsForEachWord);
              }
              echo "</div>";
            }
          ?>
        </div>
      </div>        
    </div>
    <div class="col col-sm-7" style="padding-left: 25px;">
      <pre><code><?php echo $file ?></code></pre>
    </div>
  </div>
</body>
</html>
