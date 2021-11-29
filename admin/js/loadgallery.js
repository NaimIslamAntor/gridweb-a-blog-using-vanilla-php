
// const adminBody = document.getElementById("adminBody");
//window.onbeforeunload = function() {window.scrollTo(0,0);}
const dirLength = galleryContainer.dataset.dirlength;
const structureOfImageG = (imgSrc) => {
   let endPointSlice = imgSrc.length;
   let planImageName = imgSrc.slice(dirLength, endPointSlice);
   console.log(planImageName);

   const ImgDiv = document.createElement("div"), imgEl = document.createElement("img");
   ImgDiv.classList.add("gallery__item"); ImgDiv.setAttribute("data-image", planImageName); ImgDiv.setAttribute("onclick", "popLightBox(event)"); imgEl.classList.add("gallery__image");
   imgEl.setAttribute("src", imgSrc);
   ImgDiv.appendChild(imgEl);
   return ImgDiv;
}



const sendRequestForFiles = async (startingPoint) => {
 
   const req = await fetch(`./adminaction.php?gallery_next=${startingPoint}`);
   const getdata = await req.json();
    getdata.forEach(data => {
      galleryContainer.appendChild(structureOfImageG(data.img));
   });
   // console.log(loadLimit);
   // startingPoint = galleryContainer.children.length;
   // console.log(startingPoint);
}


const prepareToLOad = () => {
   // let trackScroll = window.scrollY;
   // let totalScroll = document.documentElement.scrollHeight - window.innerHeight;
   // trackScroll = Math.ceil(trackScroll);
   // if (totalScroll == trackScroll) {
      // numberOfFilesInGallery.innerHTML > startingPoint ? sendRequestForFiles(): null;
      let startingPoint = galleryContainer.children.length;
      if (numberOfFilesInGallery.innerHTML > startingPoint) {
         
         console.log(numberOfFilesInGallery.innerHTML);
         sendRequestForFiles(startingPoint);
      }else{
         alert("loaded");
      }
      // console.log(startingPoint);
  // }
   // console.log("hurryup");
   
   // console.log(galleryContainer);
}
// console.log(Math.ceil(1));
// adminBody.addEventListener("load", () => {
//    window.addEventListener("scroll", prepareToLOad);
// });
//  window.addEventListener("scroll", prepareToLOad);
const loadBtn = document.getElementById("loadGalleryBtn");
loadBtn.addEventListener("click", prepareToLOad);

// document.addEventListener('DOMContentLoaded', (event) => {
//    //the event occurred
//  })




// const structureOfImageG = (imgSrc, imgAlt) => {
//    const ImgDiv = document.createElement("div"), imgEl = document.createElement("img");
//    ImgDiv.classList.add("gallery__item"); imgEl.classList.add("gallery__image");
//    imgEl.setAttribute("src", imgSrc);
//    ImgDiv.appendChild(imgEl);
//    return ImgDiv;
// }

// let startingPoint = galleryContainer.children.length;

// const sendRequestForFiles = async () => {
//    const req = await fetch(`./adminaction.php?gallery_next=${startingPoint}`);
//    const getdata = await req.json();
 
//    await getdata.forEach(data => {
//       galleryContainer.appendChild(structureOfImageG(data.img, data.img));
//    });
//    // console.log(loadLimit);
//    startingPoint = galleryContainer.children.length;
//    console.log(startingPoint);
// }


// const prepareToLOad = () => {
//    let trackScroll = window.scrollY;
//    let totalScroll = document.documentElement.scrollHeight - window.innerHeight;
//    trackScroll = Math.ceil(trackScroll);
//    if (totalScroll == trackScroll) {
//       numberOfFilesInGallery.innerHTML > startingPoint ? sendRequestForFiles(): null;
//       // console.log(startingPoint);
//    }
//    // console.log("hurryup");
   
//    // console.log(galleryContainer);
// }
// // console.log(Math.ceil(1));
// // adminBody.addEventListener("load", () => {
// //    window.addEventListener("scroll", prepareToLOad);
// // });
//  window.addEventListener("scroll", prepareToLOad);


// // document.addEventListener('DOMContentLoaded', (event) => {
// //    //the event occurred
// //  })

