
//This code is for showing and hiding the upload form
const uploadImage = document.getElementById("uploadImage");
const fileformHolder = document.querySelector(".fileform__holder");

uploadImage.addEventListener("click", (e) => {
    const event = e.target;
    let btnText = event.innerHTML;
    btnText == "Upload" ? event.innerHTML = "Close" : event.innerHTML = "Upload";
    fileformHolder.classList.toggle("g__grid");

});


//This code is for uploading files for gallery

//get the form

// const uploadForm = document.getElementById("uploadForm");
// const progressBar = document.getElementById("progressBar");
// const letMeprogress = progressBar.querySelector(".progress");
// const galleryFile = document.getElementById("galleryFile");

// uploadForm.addEventListener("submit", (e) => {
//     e.preventDefault();
//     progressBar.classList.add("letme__progress");
//     const transfer = new FormData(uploadForm);
//     const xhr = new XMLHttpRequest();

//     xhr.open("POST", "./adminaction.php");

//     xhr.upload.onprogress = function(progress) {
//         console.log(progress);
//         let lodaed = progress.loaded;
//         let total = progress.total;
//         let getPercentage = (lodaed * 100)/total;
//         getPercentage = getPercentage.toFixed(2)

//         letMeprogress.innerHTML = getPercentage;
//         letMeprogress.style.width = getPercentage+"%";
//     }
    
//     xhr.onload = function() {
//         if (this.status == 200) {
//             console.log(this.responseText);
//         }
//     }
//     xhr.send(transfer);
// });
//|\.svg
// const galleryContainer = document.querySelector(".gallery__container");

const uploadForm = document.getElementById("uploadForm");
// const progressBar = document.getElementById("progressBar");
// const letMeprogress = progressBar.querySelector(".progress");
const galleryFile = document.getElementById("galleryFile");
let fileArr = [];




galleryFile.addEventListener("change", (event) => {
    fileArr = [];
  
    let {files} = event.target;
    for (let index = 0; index < files.length; index++) {
        const element = files[index];
                fileArr.push(element);
            }

});

const fileSender = (file) => {

    const [loader, progressLoader, timmingLoader] = [document.createElement("div"), 
        document.createElement("div"), document.createElement("div")];

        const loadElements = [loader, progressLoader, timmingLoader];
        loadElements.forEach((element, index) => {
            element.classList.add(`g__load${index}`);
        });
        progressLoader.appendChild(timmingLoader);
        loader.appendChild(progressLoader);
        galleryContainer.prepend(loader);


     const transfer = new FormData();
     const xhr = new XMLHttpRequest();
     transfer.set("galleryFile", file);
     xhr.open("POST", "./adminaction.php");

    xhr.upload.onprogress = function(progress) {
    
        let lodaed = progress.loaded;
        let total = progress.total;
        let getPercentage = (lodaed * 100)/total;
        getPercentage = getPercentage.toFixed(2);
        timmingLoader.style.backgroundColor = "#1eadd9";
        timmingLoader.style.width = getPercentage+"%";
    }

     xhr.onload = function() {
        if (this.status == 200) {

            loader.classList.remove("g__load0");
            loader.classList.add("gallery__item");

            let objectDataOfGallery = JSON.parse(this.responseText);
            let {valid, dataset__value} = objectDataOfGallery;
            if (valid) {
                loader.setAttribute("onclick", "popLightBox(event)");
                let imgOfGallery = document.createElement("img");
                imgOfGallery.classList.add("gallery__image");
                imgOfGallery.setAttribute("src", `${imgPath}${dataset__value}`);
                loader.innerHTML = "";
                loader.appendChild(imgOfGallery);
                loader.setAttribute("data-image", dataset__value);
                numberOfFilesInGallery.innerHTML++;
            }else{
                loader.innerHTML = dataset__value;
                setTimeout(() => {
                    loader.remove();
                }, 3000);
            }
        }
    }
    xhr.send(transfer);

}

uploadForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const {length} = fileArr;
    if(length > 0){
        fileArr.forEach(file => {
            fileSender(file);
        });
        fileformHolder.classList.remove("g__grid");
        galleryFile.value = "";
        uploadImage.innerHTML = "Upload";
    }


});
