

//grab pagonation pages

// const pageContainer = document.querySelector(".grid__posts__pagination_container");
// const pages = document.querySelectorAll(".pagination");

// const paginationPromise = new Promise((resolve, reject) => {
//     const pagesLength = pages.length;
//     if(pagesLength > 5){
//         resolve("Yes");
//     }else{
//         reject("Do nothing")
//     }
// });

// paginationPromise.then((okay) => {

//     const createLinkForDots = document.createElement('a');
//     const Text = document.createTextNode("...");
//     createLinkForDots.classList.add("grid__pagination__link");
//     createLinkForDots.appendChild(Text);
//     return createLinkForDots;

// }).then((element) => {

//     const containerLength = pageContainer.children.length;
//     let order;
//     if(containerLength >= 9){
//         order = pageContainer.childNodes[12];
//     }else{
//         order = pageContainer.childNodes[10];
//     }
    
//    pageContainer.insertBefore(element, order);


// }).catch((err) => {
//     console.log(err);
// })

