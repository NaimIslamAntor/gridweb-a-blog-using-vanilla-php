<?php

if($id == $_SESSION["id"]){ ?>
 //this selectors are for profile picture modal
   const profileButton = document.querySelector(".ppend"); const exitbtn = document.querySelector(".exit");
//this is the actual modal 
   const ppModal = document.querySelector(".pp_update_box");

//this selctors are for back picture modal
   const backPicture = document.querySelector(".backedit"); const upbtn = document.querySelector("#upbtn");

//this functiob is for poping out the modal
const ModalEvent = (button, item, subattr) => {
const text = document.querySelector(".text"); let inText = "Update your profile picture";
      button.addEventListener('click', e => {
       item.classList.toggle("pop"); subattr.setAttribute('name', 'ppsubmit'); text.innerHTML = inText; });}
//this function is for bbpicture
const modalEventForBB = (btn, itm, subbtnattr) => {
//this for changing text of the text class
const text = document.querySelector(".text"); let inText = "Update your Cover picture"
btn.addEventListener('click', e => {
if(itm.classList.contains('pop') != false){
subbtnattr.setAttribute('name', 'bbpicsubmit'); text.innerHTML = inText;
}else{
itm.classList.toggle('pop'); subbtnattr.setAttribute('name', 'bbpicsubmit'); text.innerHTML = inText; }});}

//calling for poping and exit
ModalEvent(profileButton, ppModal, upbtn);  ModalEvent(exitbtn, ppModal, upbtn);
//calling modal for bb pic popping and atribute changing
modalEventForBB(backPicture, ppModal, upbtn); <?php } ?>


const showFunc = (gallerySection, ppGallery, pInput, dir, table) => {
pInput.reverse();
for (let index = 0; index < pInput.length; index++) {
const element = pInput[index].value; let textSlice = element.slice(17, element.length); const imgElement = document.createElement("img");
imgElement.classList.add("child-item");imgElement.setAttribute("src", element);imgElement.setAttribute("alt", textSlice);
const threeDot = document.createElement("i");
threeDot.classList.add("fas"); threeDot.classList.add("fa-ellipsis-v"); const galleryChild = document.createElement("div");
galleryChild.classList.add("gallery_child"); const actualForm = document.createElement("form");
actualForm.classList.add("btn_form_for_image"); <?php if($id == $_SESSION["id"]){ ?>
   const tokenHolder = document.getElementById("csrf_token_for_upload_pp_cp");
   const tokenKeeper = tokenHolder.value;
   const tokenFeild = document.createElement("input");
   tokenFeild.setAttribute("type", "hidden"); tokenFeild.setAttribute("name", "update__pp_and_cp__token"); tokenFeild.setAttribute("value", tokenKeeper); 
actualForm.setAttribute("action", "in2.php"); actualForm.setAttribute("method", "POST"); const btnArray = ["Make profile", "Make cover", "delete"];
for(let i=0; i < btnArray.length; i++){ 
const btn = document.createElement("button");
     
btn.setAttribute("name", btnArray[i].slice(5, btnArray[i].length)); btn.setAttribute("id", btnArray[i].slice(5, btnArray[i].length)); btn.classList.add("btn_img_action"); btn.innerHTML = btnArray[i];
actualForm.appendChild(btn); } actualForm.appendChild(tokenFeild); let hideInput = document.createElement("input");
hideInput.setAttribute("type", "hidden");hideInput.setAttribute("name", "proval");hideInput.setAttribute("id", "provalid");hideInput.setAttribute("value", textSlice);
actualForm.appendChild(hideInput); let hideInputt = document.createElement("input");
hideInputt.setAttribute("type", "hidden");hideInputt.setAttribute("name", "directory");hideInputt.setAttribute("id", "dir");hideInputt.setAttribute("value", dir);
actualForm.appendChild(hideInputt);let tabInput = document.createElement("input");
tabInput.setAttribute("type", "hidden");tabInput.setAttribute("name", "tableee");tabInput.setAttribute("value", table);
actualForm.appendChild(tabInput); <?php  } ?> let downloadBtn = document.createElement('a');
downloadBtn.classList.add('btn_img_action');downloadBtn.innerText = "Download";downloadBtn.setAttribute("href", element);downloadBtn.setAttribute("download", "");
actualForm.appendChild(downloadBtn);
threeDot.addEventListener("click", () => {
actualForm.classList.toggle("pop");});
    
let documentFragment = document.createDocumentFragment();
documentFragment.appendChild(galleryChild);

galleryChild.appendChild(imgElement); galleryChild.appendChild(threeDot); galleryChild.appendChild(actualForm);
ppGallery.appendChild(documentFragment);
gallerySection.appendChild(ppGallery);}}
//this code is for showing profile pictures
const profileThumb = document.querySelector(".profile_gallery");const galleryType = document.querySelector('.gallery_type');
profileThumb.addEventListener("click", () => {const gallerySection = document.querySelector(".gallery_section");
gallerySection.innerHTML = " ";const ppGallery = document.createElement("div");
ppGallery.classList.add("pp_gallery");galleryType.innerHTML = "Your All profile pictures";
const myP = document.querySelector(".val_wrapper");
const pInput = Array.from(myP.children);let  dir = "profile.pictures/"; let table = "profile_pictures";
showFunc(gallerySection, ppGallery, pInput, dir, table);});
//this code is for showing cover pictures
const coverThumb = document.querySelector(".cover");
coverThumb.addEventListener("click", () => {const gallerySection = document.querySelector(".gallery_section");
gallerySection.innerHTML = " ";
const ccGallery = document.createElement("div");
ccGallery.classList.add("pp_gallery");galleryType.innerHTML = "Your All cover pictures";const myC = document.querySelector(".c_val_wrapper");
const cInput = Array.from(myC.children);let  dir = "coverrr.pictures/";let table = "cover_pictures";
showFunc(gallerySection, ccGallery, cInput, dir, table);
});