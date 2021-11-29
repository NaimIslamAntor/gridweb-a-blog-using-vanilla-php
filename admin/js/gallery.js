const galleryContainer = document.querySelector(".gallery__container");
const lightboxHandler = document.querySelector("#lightbox__handler");
const numberOfFilesInGallery = document.querySelector("#number__of_files_in_gallery");
const imgPath = "../img/thumbnail/";
//This is for giving back event in gallery items
const addInlineEvent = (element) => {
    element.setAttribute("onclick", "popLightBox(event)");
}

const checkTracking = () => {
    const glItem = galleryContainer.querySelectorAll(".gallery__item");
    glItem.forEach((check) => {
        if (check.classList.contains("grid_lightbox__tracker")) {
            check.classList.remove("grid_lightbox__tracker");
         }
    });

}

// const controlMovement = (direction ,imgElement, inputElemnt) => {
//     if (direction != null) {
//         const getSrcAndAlt = direction.dataset.image;
//         imgElement.setAttribute("src", `${imgPath}${getSrcAndAlt}`);
//         imgElement.setAttribute("alt", getSrcAndAlt);
//         inputElemnt.value = getSrcAndAlt;
//         checkTracking();
//         direction.classList.add("grid_lightbox__tracker");
//     }else{
//         alert("Opps no place to go");
//     }

//    }


const controlMovement = (direction ,imgElement, inputElemnt) => {
    if (direction != null) {
        //check the gallery__item child is img or not this actually for when img loading or uploading
        let gItemChild = direction.firstElementChild;
        if(gItemChild.closest("img")){
            const getSrcAndAlt = direction.dataset.image;
            imgElement.setAttribute("src", `${imgPath}${getSrcAndAlt}`);
            imgElement.setAttribute("alt", getSrcAndAlt);
            inputElemnt.value = getSrcAndAlt;
            checkTracking();
            direction.classList.add("grid_lightbox__tracker");
        }else{
            alert("Image is not ready yet");
        }

    }else{
        alert("Opps no place to go");
    }

   }


function popLightBox(event){
    lightboxHandler.innerHTML = "";
    checkTracking();
    const e = event.target;
    e.classList.add("grid_lightbox__tracker");
    const imgName = e.dataset.image;

    //create a div
    const [lightboxContainer, imgageTag, inpbtHolder, input, copYBtn, deleteBtn, cancelBtn, btnImgHolder,
         leftBtn, rightBtn] = [
    document.createElement("div"),
    document.createElement("img"),
    document.createElement("div"),
    document.createElement("input"),
    document.createElement("button"),
    document.createElement("button"),
    document.createElement("button"),
    document.createElement("div"),
    document.createElement("button"),
    document.createElement("button")
     ];
    const allElment = [lightboxContainer, imgageTag, inpbtHolder, input, copYBtn, deleteBtn, cancelBtn, btnImgHolder,
         leftBtn, rightBtn];
    allElment.forEach((element, index) => {
        element.classList.add(`galleryLightbox__element_${index}`);
    });
    
    copYBtn.innerHTML = "<i class='far fa-copy do_not__distrub'></i><strong class='do_not__distrub'> Copy</strong>";
    deleteBtn.innerHTML = "<i class='fas fa-trash do_not__distrub'></i><strong class='do_not__distrub'> Delete</strong>";
    cancelBtn.innerHTML = "<i class='fas fa-times do_not__distrub'></i>";
    leftBtn.innerHTML = "<i class='fas fa-chevron-left do_not__distrub'></i>";
    rightBtn.innerHTML = "<i class='fas fa-chevron-right do_not__distrub'></i>";
    input.value = imgName;

    //right btn functionality
    rightBtn.addEventListener("click", () => {
        const gridLightboxTracker = galleryContainer.querySelector(".grid_lightbox__tracker");
        const {nextElementSibling} = gridLightboxTracker;
       controlMovement(nextElementSibling ,imgageTag, input);
    });

    //left btn functionality
    leftBtn.addEventListener("click", () => {
        const gridLightboxTracker = galleryContainer.querySelector(".grid_lightbox__tracker");
        const {previousElementSibling} = gridLightboxTracker;

       controlMovement(previousElementSibling ,imgageTag, input);
    
    });


    //copy btn functionality
    copYBtn.addEventListener("click", () => {
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
    });

    deleteBtn.addEventListener("click", (eOfDelete) => {
        const { parentElement } = eOfDelete.target;
        const gridLightboxTracker = galleryContainer.querySelector(".grid_lightbox__tracker");
        const {dataset} = gridLightboxTracker;
        const imgSrcOfTracker = dataset.image;

       const psrmOfDelete =  confirm("Are you sure this file will delete permanently");
       if (psrmOfDelete) {
           const xhr = new XMLHttpRequest();

           xhr.open("POST", "./adminaction.php");

           xhr.onload = function(){
               if(this.status == 200){
                   parentElement.parentElement.remove();
                   gridLightboxTracker.remove();
                   numberOfFilesInGallery.innerHTML--;
               }else if(this.status == 404){
                   alert("404 error not found");

               }else if(this.status == 408){
                   alert("Sorry request timed out");
               }
           }         

           xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhr.send(`gallery__file=${imgPath}${imgSrcOfTracker}`);

       }
    });

     //cancel btn functionality
     cancelBtn.addEventListener("click", (eOfCancel) => {
        const { parentElement } = eOfCancel.target;
        checkTracking();
        parentElement.parentElement.remove();    
     });

   
    const copyingStuffs = [input, copYBtn, deleteBtn, cancelBtn];
    copyingStuffs.forEach((copyStuff) => {
        inpbtHolder.appendChild(copyStuff);
    });

    imgageTag.setAttribute("src", `${imgPath}${imgName}`);
    imgageTag.setAttribute("alt", imgName);

    const imgleftRightBtnArr = [leftBtn, imgageTag, rightBtn];

    imgleftRightBtnArr.forEach((lrimg) => {
        btnImgHolder.appendChild(lrimg);
    })

    const finalStuffs = [btnImgHolder, inpbtHolder];
    
    finalStuffs.forEach((finalStuff) => {
        lightboxContainer.appendChild(finalStuff);
    });

    lightboxHandler.appendChild(lightboxContainer);
}