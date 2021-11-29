const mainul = document.querySelector('.menu');
const ulchild = Array.from(mainul.children);
const menuContainer = document.querySelector('.container__menu');
const bar1 = menuContainer.querySelector('.bar1');
const bar2 = menuContainer.querySelector('.bar2');
const bar3 = menuContainer.querySelector('.bar3');
const nav = document.querySelector('.nav');
// const main = document.querySelector('.main');


const navFunction = (bar1,bar2,bar3,nav) => {
    bar1.classList.toggle('cross');
    bar2.classList.toggle('cross');
    bar3.classList.toggle('cross');

    nav.classList.toggle('active');
    main.classList.toggle('active');
}

menuContainer.addEventListener('click',e => {

    navFunction(bar1,bar2,bar3,nav);               
});



const letsLoggedIn = document.getElementById("lets_logged_in");
const loggedOrNot = document.getElementById("logged_or__not");

try {
    if(letsLoggedIn != null && loggedOrNot != null){
        letsLoggedIn.addEventListener('click', () => {
            const checkingBox = loggedOrNot.value;
            if(checkingBox == ''){
                loggedOrNot.setAttribute("value", "start_the_cookie");
            }else{
                loggedOrNot.setAttribute("value", "");
            }
        });
    }else{
        throw "This is for signup functionality only available in the register.php page";
    }
   
} catch (error) {
    console.log(error);
}