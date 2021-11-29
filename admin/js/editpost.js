//get the submit button
const btnId = document.getElementById("deletepost__actionbtn");
btnId.addEventListener("click", (e) =>  {
    const getTheBoleamData = confirm('Are you sure yo wanna delete');
    if(!getTheBoleamData){
        e.preventDefault();
    }
});



const btn = document.getElementById("ajaxbtn");
const file = document.getElementById("ajaxfile");

btn.addEventListener("click", (e) => {
   e.preventDefault();
   console.log(file.files[0]);
   const formData = new FormData();
   formData.append('file',file.files[0]);

   const xhr = new XMLHttpRequest();
  

   xhr.onload = function() {
      if(this.status == 200){
         console.log(this.responseText);
      }

//    xhr.onreaystatechange = function(){
//       if(this.readyState = 4 && this.status == 200){
//          console.log(this.responseText);
//       }
//    }
   xhr.open("POST", "acaction.php");
      xhr.setRequestHeader("Content-type", "multipart/form-data");
      xhr.send(`${formData}`);
   }

});