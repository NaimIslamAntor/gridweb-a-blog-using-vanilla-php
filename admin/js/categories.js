


const deleteCategory = (event, ck) => {
    event.preventDefault();
 const boOL = confirm("Are you sure you want to delete");
if(boOL){ 
    
    const spinParent = document.querySelector(".spin_parent");
    
    spinParent.classList.add("lets_spin");const http = new XMLHttpRequest();
    http.onreadystatechange = doSomeResponse;
    function doSomeResponse(){ if(http.readyState == 4 && http.status == 200){
            event.target.parentElement.parentElement.remove();

            spinParent.classList.remove("lets_spin");} }
    http.open("GET", `./adminaction.php?delete_C=${ck}`);
    http.send();
}

}

const editCategory = (event, ck) => {
    event.preventDefault();

const categoryParent = event.target.parentElement.previousElementSibling.previousElementSibling;
const parentChild = categoryParent.children[0];
const parentChildinnerHtml = parentChild.innerHTML;

const divBox = document.createElement("div");
divBox.classList.add("edit_div");

const createTextArea = document.createElement("textarea");
const button = document.createElement("button");

const buttonTwo = document.createElement("button");

button.classList.add("cat__btn");
buttonTwo.classList.add("cat__btn");


createTextArea.innerHTML = parentChildinnerHtml;
button.innerText = "Update";
buttonTwo.innerText = "Cancel";

divBox.appendChild(createTextArea);
divBox.appendChild(button);
divBox.appendChild(buttonTwo);


parentChild.classList.add("hide");
categoryParent.appendChild(divBox);
event.target.classList.add("hide");

if(parentChild.classList.contains("hide") || event.target.classList.contains("hide")){

     const cleaningThingsUp = () => {
     parentChild.classList.remove("hide");
     divBox.remove();
     event.target.classList.remove("hide"); 
    }
buttonTwo.addEventListener("click", cleaningThingsUp);

button.addEventListener("click", (e) => {
    const getThatAttr = e.target.parentElement.previousElementSibling;
    const tValue = createTextArea.value;
    if(tValue.length > 0){
    const spinParent = document.querySelector(".spin_parent");
    spinParent.classList.add("lets_spin");

const http = new XMLHttpRequest();
http.onreadystatechange = letsDoIt;

function letsDoIt() {
   if(http.readyState == 4 && http.status == 200){
     const attrrr = getThatAttr.getAttribute("data-description-of-category");
      parentChild.innerHTML = tValue;

     const arr = attrrr.split("-------------------------");
     arr[0] = tValue;
     const updatedAttribute = `${arr[0]}-------------------------${arr[1]}-------------------------${arr[2]}-------------------------${arr[3]}`;
     getThatAttr.setAttribute("data-description-of-category",updatedAttribute);
     cleaningThingsUp();
  
     spinParent.classList.remove("lets_spin");
                } }

http.open("GET", `./adminaction.php?edit_c=${ck}&&category_slug=${tValue}`);
http.send();
   
           }else{
               alert("Category can't be empty!!!");
               return false
           }

       });

   }



}


const categories = document.querySelectorAll(".edit__description_of_category");
const categoryWrapper = document.getElementById("category__wrapper");

categories.forEach(category => {
    category.addEventListener("click", moadForEditing);
});


// function(moadForEditing) dependency varrs and funcs are bellow...
// var(checking, storeElement), function(removeTheClassYouWant, removingTheEvent, resetingTheEvent, afterWorkDone).
//so be careful to edite those.

const removeTheClassYouWant = (NameOfTheClass) => {
    const getClass = document.querySelector(`.${NameOfTheClass}`);
    getClass.classList.remove(NameOfTheClass);
}

const removingTheEvent = (element, eventType, refFunction) => {
    element.removeEventListener(eventType, refFunction);
}


//Be Carefull to edit this function(moadForEditing) because html elements order matters here.
//Check the page category.php page before editing this js function.

//depenency start
let checking = false;
let storeElement;

const resetingTheEvent = (getThatClass, getTherefFunc) => {
    checking = false;
    storeElement = null;
   const getting = document.querySelector(`.${getThatClass}`);
   getting.addEventListener("click", getTherefFunc);
}

const afterWorkDone = () => {
    const doneBox = document.createElement("div");
doneBox.classList.add("work__done");
doneBox.innerHTML = "Done!";
categoryWrapper.appendChild(doneBox);

setTimeout(() => {
    doneBox.classList.add("animate");
}, 1500);

setTimeout(() => {
    doneBox.remove();
}, 1800);
}

//depenency end
function moadForEditing(event) {

const funcEvent = event.target;
const attr = funcEvent.getAttribute("data-description-of-category");
//Getting every clicking items inner text.
//thats going to be the class that we re gonna check.
//it will get remove after the person once click cancel or edit button to edit.
//and the clicking item will get clickable again.

const classNamee = funcEvent.innerHTML;
// This if stmt is for checking that someone dont click one button at multiple times

//removing the current event after category clicking is a great idea.
//so that one can't press it again.
//once the edit or cancel button pressed the the event will get right again.
if(checking == false){
   checking = true;
   storeElement = this;
   removingTheEvent(storeElement, "click", moadForEditing); }

if(!funcEvent.classList.contains(classNamee)){
    funcEvent.classList.add(classNamee);
        
const editPromise = new Promise((resolve, reject) => {
    resolve(attr);
    reject("Something Wrong!");
    });

 editPromise.then((categoryDescription) => {
//Creating a modal for editing the category description and add a class.
//1st create a div html element for wrapping the modal.
//2nd create one textarea html element for storing the description.
//Create to button.
// With a id call c__desctiption_storing.
//And append that to the modal wrapper.

const div = document.createElement("div");
       

const dividdingTextFromId = categoryDescription.split("-------------------------");
const sndClass = `${dividdingTextFromId[2]}modal`;
div.classList.add("edit__with__modal",sndClass);

const headingForCateygoryHolding = document.createElement("h3");
 
headingForCateygoryHolding.classList.add("categoryslug___heading");
headingForCateygoryHolding.innerHTML = dividdingTextFromId[0];

const tokenInput = document.createElement("input");
tokenInput.setAttribute("type", "hidden");
tokenInput.value = dividdingTextFromId[3];

const textarea = document.createElement("textarea");
textarea.setAttribute("id", "c__desctiption_storing");

textarea.innerHTML = dividdingTextFromId[1];
textarea.setAttribute("data-ditectorIdForC", dividdingTextFromId[2]);
div.appendChild(headingForCateygoryHolding);
div.appendChild(tokenInput);
div.appendChild(textarea);

return div;

}).then((divBlock) => {
        
//Create two button for cancelling and edting.
const btn1 = document.createElement("button");
const btn2 = document.createElement("button");

btn1.classList.add("btn1__for_e_c", "cat__btn");
btn2.classList.add("btn1__for_e_s", "cat__btn");

btn1.innerHTML = "Cancel";
btn2.innerHTML = "Edit";
  
//This button callback function is for cancel eidting.
btn1.addEventListener("click", (event) => {
    const cancelEvent = event.target;
    const {parentElement} = cancelEvent;
    const getClassList = cancelEvent.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;

    //removing the class from category slug.
    resetingTheEvent(getClassList, moadForEditing);
    removeTheClassYouWant(getClassList);
    parentElement.remove();

});

divBlock.appendChild(btn1);
divBlock.appendChild(btn2);

categoryWrapper.appendChild(divBlock);
//return the edit button for a click event.
//Which will send an ajax request for editing the description
//of the category
return btn2;
    }).then((makeRequest) => {
        //work left here will be doing later okay
  
makeRequest.addEventListener("click", (event) => {
  
const textAreaSibling = event.target.previousElementSibling.previousElementSibling; 
//csrfToken is for form protection so that nobody randomly cant submit the form.
//textAreaValue is description of the category.
//textAreaDataAttr is the id of the category.
//modal's category heading is the classList of the category that's gonna click.

const gettingTheSlugAsClass = textAreaSibling.previousElementSibling.previousElementSibling.innerHTML;
const csrfToken = textAreaSibling.previousElementSibling.value;
const textAreaValue = textAreaSibling.value;
const textAreaDataAttr = textAreaSibling.getAttribute("data-ditectorIdForC");
           
//Create one httprequest object


if(textAreaValue.length > 0){
    
const http = new XMLHttpRequest();

http.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        const getThatClassWhichIsClickingFirst = document.querySelector(`.${gettingTheSlugAsClass}`);
       
//Overwrite the attribute data-description-of-category with updated value.
//Which holding categories info.
//And it's very important!.

//textAreaValue value is the updated value which becomming the description of,
//the clicking category.

const getDataAttr = getThatClassWhichIsClickingFirst.getAttribute("data-description-of-category");
const gaoingToArray = getDataAttr.split("-------------------------");

//update the attribute data-description-of-category 2nd value.
//and other values shall remain same as before.

getThatClassWhichIsClickingFirst.setAttribute("data-description-of-category",
`${gaoingToArray[0]}-------------------------${textAreaValue}-------------------------${textAreaDataAttr}-------------------------${csrfToken}`);
resetingTheEvent(gettingTheSlugAsClass, moadForEditing);                
removeTheClassYouWant(gettingTheSlugAsClass);
event.target.parentElement.remove();
afterWorkDone(); } }
            //Sending the request.    
http.open("POST", "./adminaction.php");
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.send(`editcategorydescription=editcategorydescription&token=${csrfToken}&description=${textAreaValue}&id=${textAreaDataAttr}`);

}else{
    alert("Description can't be empty!")
}

            
});
}).catch((err) => {
alert(err);
    });
}
}
