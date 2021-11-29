

const loader = () => { const [loaderContainer, loaderSubContainer, loaderBlock] = [document.createElement("div"), document.createElement("div"), document.createElement("div")];
  
loaderContainer.classList.add("loader__container");loaderSubContainer.classList.add("loaderSubContainer");loaderBlock.classList.add("loader__loader");
loaderSubContainer.appendChild(loaderBlock);
loaderContainer.appendChild(loaderSubContainer);
return loaderContainer; }
  
const removeInlineEvent = (element, EventType) => { 
    element.removeAttribute(EventType); }
  
const resetInlineEvent = (element, eventType, refFunction) => {
    element.setAttribute(eventType, refFunction); }
  
const bioRequest = (bio, token, element) => { const http = new XMLHttpRequest();
http.onreadystatechange = function (){
if(this.readyState == 4 && this.status == 200){ element.parentElement.appendChild(loader()); const responseData = JSON.parse(this.responseText);
const {type, biodata} = responseData;
  
const afterRequestBio = () => { element.innerHTML = biodata;
element.classList.remove("be__hidden"); resetInlineEvent(element, "ondblclick", "updateBio(event)"); }
if(type == "Yes"){ afterRequestBio();
}else if(type == "No"){ afterRequestBio(); }
element.nextElementSibling.remove();}}
    
http.open("POST", "in2.php");
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.send(`bioRequest=bioRequest&biotoken=${token}&bio=${bio}`);
}
  
  
function updateBio(event){
//start with a promise call bioPromise
const bioPromise = new Promise((resolve, reject) => {
resolve(event);
reject("Something Wrong!!!");
});
  
bioPromise.then((event) => {
//get innerHTML of the current targeting element. 
const thatEvent = event.target;
const {innerHTML, parentElement} = thatEvent;
thatEvent.classList.add("be__hidden"); removeInlineEvent(thatEvent, "ondblclick");
  
bioObject = { eventElement: thatEvent, parentOfBioData: parentElement, bio: innerHTML }
return bioObject;
  
}).then((bioObject) => {
const {eventElement, parentOfBioData, bio} = bioObject;
//create a div block
const txtAreaBtnContainer = document.createElement("div");
txtAreaBtnContainer.classList.add("txtAreaBtnContainer");
 //create a textarea for holding bio data.
const bioDataHolder = document.createElement("textarea");
bioDataHolder.classList.add("bioDataHolder"); 
//create one button for submitting and one for cancelling
  
 const [bioSubBtn, bioCanBtn] = [document.createElement("button"), document.createElement("button")];
bioSubBtn.classList.add("bioSubBtn"); bioCanBtn.classList.add("bioCanBtn"); bioSubBtn.innerHTML = "Save"; bioCanBtn.innerHTML = "Cancel"; bioDataHolder.innerHTML = bio;
 const ElementsList = [bioDataHolder, bioSubBtn, bioCanBtn];
  
ElementsList.forEach((element) => {
txtAreaBtnContainer.appendChild(element);});
parentOfBioData.appendChild(txtAreaBtnContainer);

const objectOfButtons = {stableElement: eventElement, cancelBtn: bioCanBtn, saveBtn: bioSubBtn, bioValue: bioDataHolder}
return objectOfButtons;
}).then((objectOfButtons) => {
const {stableElement, cancelBtn, saveBtn} = objectOfButtons;
const removeTheContainer = cancelBtn.parentElement;

cancelBtn.addEventListener("click", () => {
removeTheContainer.remove();
stableElement.classList.remove("be__hidden");
resetInlineEvent(stableElement, "ondblclick", "updateBio(event)");});
return objectOfButtons;
  
}).then((finalObject) => {
const {saveBtn, bioValue} = finalObject;

let warnContainer = document.createElement("div"); let characterwarner = document.createElement("p");
warnContainer.classList.add("warn__container"); characterwarner.classList.add("warn__forchar");
         
bioValue.addEventListener("keyup", (e) => {
const {value} = e.target;
const lenOfValue = value.length;
     
let charLeft = 40 - lenOfValue; let CharacterCondtionalText = "Characters";
if(charLeft == 1){
CharacterCondtionalText = "Character";}
const checkChild = bioValue.parentElement.children;
        
if(lenOfValue < 40){
   if(checkChild.length <= 3){ warnContainer.appendChild(characterwarner); bioValue.parentElement.appendChild(warnContainer);
}
characterwarner.innerHTML = `Must write <strong>${charLeft}</strong> ${CharacterCondtionalText} more`;
if(lenOfValue == 0){
characterwarner.innerHTML = "<strong class='be__red'>Bio can't be empty!!!</strong>";}
}else{ warnContainer.remove(); } });


return finalObject;
}).then((getSameObject) => {
const {stableElement, saveBtn, bioValue} = getSameObject;
  
saveBtn.addEventListener("click", (e) => { const valueOfBio = bioValue.value;
if(valueOfBio.length >= 40){
const token = stableElement.dataset.biotoken;
e.target.parentElement.remove();
bioRequest(valueOfBio, token, stableElement);
}else{ alert("Bio is too short"); return false;
}});})}