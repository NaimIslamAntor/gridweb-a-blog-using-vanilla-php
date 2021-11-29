
    const gdFunction = (gdnavBar,gdNav) => {
        gdNav.classList.toggle('active');
    }
    const gdnavBar = document.querySelector('.menu__icon');
    gdnavBar.addEventListener('click',e => {
        
const gdNav = document.querySelector('.admin__nav');

gdFunction(gdnavBar,gdNav);
});

const dropDownMaker = (postDropDown) => {
    var dropDown = postDropDown;
    const postDp = document.querySelector(`.${dropDown}`);
    postDp.classList.toggle('actv');
    let classCheck;
    if(postDp.classList.contains('actv')){
        classCheck = 'actv';
    }else{
        classCheck = null;
    }
    localStorage.setItem('adminClass', classCheck);
}

(function(){
    const postDp = document.querySelector('.post_drop_down');
    let getTheClass = localStorage.getItem('adminClass');
    postDp.classList.add(getTheClass);
})();


const modifiedTags = (event, idOrClass) => {
    
    let getInnerHtml = event.target.value;

 if(getInnerHtml.length > 0){

    let catcher = document.querySelector(idOrClass);
    let splitingValues =  getInnerHtml.split(" ");
    let hasTagArray = [];
    splitingValues.forEach(splitingValue => {
        let letsCheckChar = splitingValue.charAt(0);
        let hashTag;
        if(letsCheckChar != "#"){
            hashTag = "#"+splitingValue;
        }else{
            hashTag = splitingValue;
        }
         
         hasTagArray.push(hashTag);
         
    });
    let arrayToConString = hasTagArray.toString();
    catcher.value = arrayToConString;
 }
 

}