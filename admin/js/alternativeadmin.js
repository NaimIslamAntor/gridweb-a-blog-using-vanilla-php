
const kickOut = document.getElementById("kick__out");

try {
    if (kickOut != null) {
        let countIt = kickOut.innerText;

setInterval(() => {
    if(countIt != 0){
        countIt--;
        kickOut.innerText = countIt;
        if (countIt == 0) {
            window.location = "http://localhost/gridweb/";
        }
    }
}, 1000);

    }else{
        throw "This option is for non admin users";
    }
} catch (error) {
    console.log(error);
}

