const login = (e, likeOrDislike) => {
    e.preventDefault();
    alert(`Please login for ${likeOrDislike} this post`);
}


const react = (e, userId, reactionType, postId) => {
    e.preventDefault();
    const [reaction, uId, reType, poId] = ["reaction", userId, reactionType, postId];
    const reactioncsrfToken = document.getElementById("reactioncsrf__token");
    const token = reactioncsrfToken.value;
    const requestAjax = new XMLHttpRequest();
    requestAjax.onreadystatechange = fireAjax;

    function fireAjax(){
        if(requestAjax.readyState == 4 && requestAjax.status == 200){
            

            const dataTotalAttr = e.target.getAttribute("data-total");
            const dataTotalOpAttr = e.target.getAttribute("data-totalop");

   
            const reactId = document.getElementById(dataTotalAttr);
            const reactOpId = document.getElementById(dataTotalOpAttr);

            if(e.target.classList.contains("reacted") != true){
                e.target.classList.add("reacted");
                reactId.innerText++;
            }else{
                e.target.classList.remove("reacted");
                reactId.innerText--;
            }

            const reactionAttr = e.target.getAttribute("data-reaction-class-op");
            const getThatClass = document.querySelector(`.${reactionAttr}`);


            if(getThatClass.classList.contains("reacted")){
                getThatClass.classList.remove("reacted");
                reactOpId.innerText--;
            }
        }
    }

    requestAjax.open("POST", "in2.php");
    requestAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    requestAjax.send(`reaction=${reaction}&reactioncsrf__token=${token}&poId=${poId}&uId=${uId}&reType=${reType}`);

}