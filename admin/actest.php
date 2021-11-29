

<!-- 
<form enctype="multipart/form-data" id="form">
<input type="file" name="target__file">
<button type="submit" id="upload__btn" name="letsupload">Upload</button>
</form>
<div id="div"></div>
<script>
      const form = document.getElementById("form");
      const div = document.getElementById("div")
      form.addEventListener("submit", upload);


      function upload(e){
          e.preventDefault();
         
         const http = new XMLHttpRequest();
         
         const dataOfForm = new FormData(form);
         http.open("POST", "acaction.php");





         http.onload = function(){
             if(this.status == 200){
                // alert();
                //  div.innerHTML = this.responseText;
                console.log(this.responseText);
             }
         }

         http.upload.addEventListener("progress", (e) => {
             console.log(e);
         })

         http.send(dataOfForm);
      }
</script> -->





<?php
// include 'acaction.php';

// use Html\Table as T;
// use Html\Row as R;

// $test1 = new T();
// $test1->title = "test1";
// $test1->message();

// echo "<br><br><br>";

// $test2 = new R();
// $test2->numCells = 10;
// $test2->message();
// $directory = "../img/thumbnail/";
// $read__directory = glob($directory.'*.*');
// $num_of_filesgallery = count($read__directory); 
// //$read__directory is an array make it rv before looping so that we get latest images at starting
// rsort($read__directory); 
// // print_r($read__directory);

// // for ($i=99; $i < $num_of_filesgallery; $i++) { 
// //    echo $read__directory[$i]."____$i<br>";
// // }

// for ($i=197; $i < 197+49; $i++) { 
//     echo $read__directory[$i]."____$i<br>";
//  }


// $value = 10 > 5 ? "yes" : "no";
// echo $value;

// class Fruit{
//     public $name;
//     public $color;
//     protected $longstr;

//     public function __construct($name, $color){
//         $this->name = $name;
//         $this->color = $color;
//     }

//     public function modifiedFruit():string {
//         return $this->longstr;
//     }
   

//     public function fruitinfo(){
//         $this->longstr = $this->name." color is ".$this->color;


       
//     }

   
// }



// $objfruit = new Fruit("Apple", "red");
// $objfruit->fruitinfo();
// echo $objfruit->modifiedFruit();
?>

<!-- <?php

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';


?> -->


<!-- <h1 style="color:red"><?php echo //$_SERVER['PATH_INFO']; ?></h1> -->

