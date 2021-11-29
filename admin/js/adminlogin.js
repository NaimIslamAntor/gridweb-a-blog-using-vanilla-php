const password = document.getElementById("password");const eyeButton = document.getElementById("hide_show");const eyeInd = document.querySelector(".eye_ind");
try {
    if(password != null && eyeButton != null && eyeInd != null){
        eyeButton.addEventListener("click",()=> {var inputType = password.getAttribute('type');var checkingClass = eyeInd.classList.contains("fa-eye-slash");
        if(inputType == "password" && checkingClass){
        password.setAttribute("type", "text");eyeInd.classList.remove("fa-eye-slash");eyeInd.classList.add("fa-eye");}else{
        password.setAttribute("type", "password");eyeInd.classList.remove("fa-eye");eyeInd.classList.add("fa-eye-slash");
        }});
    }else{
        throw "Login form is not available when You are logged in";
    }
} catch (error) {
    console.log(error);
}

const checkThisInput = (event, whichInput) => {
    let check = event.target.value;
    let checkWhichInput = whichInput;
if(!check.length > 0){
    event.target.style.border = "1px solid red";
event.target.setAttribute("placeholder", `${checkWhichInput} can't be empty!!`);
}else{
    event.target.style.border = "1px solid #b29d9d";
}}
const makeCheck = (e) => {
    const {value} = e.target; 
    var valLength = value.length;
    if(valLength == 0){
        e.target.setAttribute("value", "start_the_cookie");
    }else{
        e.target.setAttribute("value", "");
    }
}

const popUp = (event, popIdentifier) => {
    event.preventDefault();
    const idOrClass = document.getElementById(popIdentifier);
    idOrClass.classList.toggle("come_on");
}


const readCategoryShortDescription = (event) => {
    const myTargetBtn = event.target;

    const blokedSiblingOfCurrentTarget = myTargetBtn.parentElement.parentElement.nextElementSibling;
    blokedSiblingOfCurrentTarget.classList.toggle("let_me_read");

    if(myTargetBtn.classList.contains("fa-plus")){
        myTargetBtn.classList.remove("fa-plus");
        myTargetBtn.classList.add("fa-minus");
    }else{
        myTargetBtn.classList.remove("fa-minus");
        myTargetBtn.classList.add("fa-plus");
        
    }
}
