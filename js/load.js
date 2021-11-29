

const profileLoad = document.querySelector("#profile_load");
const root = document.querySelector("#root");

// console.log(profileLoad);
// console.log(root);

// profileLoad.addEventListener("click", e => {
//     e.preventDefault();
//     let linkAttr = e.target.getAttribute("link");
//     let idAttr = e.target.getAttribute("data-id");

//     const http = new XMLHttpRequest();
//     http.onreadystatechange = function(){
//         if(this.readyState == 4 && this.status == 200){
//             window.history.pushState("", "", linkAttr);
//             root.innerHTML = this.responseText;
//         }
//     }
//     http.open("GET", `profile.php?id=${idAttr}`);
//     http.send();
// });