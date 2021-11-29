<?php

// isset($_REQUEST["letsupload"]) ? 
//      $file = $_FILES["target__file"] 
//      json_encode($file) : '';

// if (isset($_FILES["target__file"])) {
//     $file = $_FILES["target__file"];
//      $file__name = $_FILES["target__file"]["name"];
//      echo json_encode($file);
// }

// namespace Html;
//     class Table {
//         public $title = "";
//         public $numRows = 0;
      
//         public function message() {
//           echo "<p>Table '{$this->title}' has {$this->numRows} rows.</p>";
//         }
//       }
      
//       class Row {
//         public $numCells = 0;
//         public function message() {
//           echo "<p>The row has {$this->numCells} cells.</p>";
//         }
//       }
      


?>


<?php

$arr = [1,2,4,3,5,6,7,8];



?>

<div>
    <?php
   foreach ( $arr as $key => $value) {
      if ( $value > 3) {
          echo $value;
      }
   }
   exit();
    ?>
</div>