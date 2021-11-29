

const commentArrangementForLargerComment = () => {
    const commentLabel = document.querySelectorAll(".comment__label");

    commentLabel.forEach((label) => {
        const shortLength = 480;
        let commentLength = label.innerHTML.length;
        if(commentLength > shortLength){
            const div = document.createElement("div");
            div.classList.add("checkdiv");
            const button = document.createElement("button");
            const dates = document.querySelectorAll(".date");
            
            button.classList.add("read");
            button.innerHTML = "Read More";
            label.classList.add("Short_comment");
            const getDataAttr = label.getAttribute("data-id-for-up-comment");
    
            dates.forEach((date) => {
    
                const dateDataAttr = date.getAttribute("data-read");
                if(getDataAttr == dateDataAttr){
                    button.setAttribute("data-reading", dateDataAttr);
                    div.appendChild(button)
                    date.appendChild(div);
                    button.addEventListener("click", (e) => {
                        e.preventDefault();
                        const eAttr = e.target.getAttribute("data-reading");
                        if(e.target.innerHTML === "Read More"){
                            e.target.innerHTML = "Read Less";
                        }else{
                            e.target.innerHTML = "Read More";
                        }
    
                        const ShortComments = document.querySelectorAll(".comment__label");
                        ShortComments.forEach((ShortComment) => {
                            const showcomAttr = ShortComment.getAttribute("data-id-for-up-comment");
                            if(eAttr == showcomAttr){
                                ShortComment.classList.toggle("Short_comment");
                            }
                        });
    
                    });
                } }); }});}
commentArrangementForLargerComment();


const postComment = (e) => {
   e.preventDefault();
    const spinParent = document.querySelector(".spin_parent");
    
    const commentCsrfToken = document.getElementById("comment__csrf__token");

    const comment = document.querySelector("#comment");
    const postId = document.querySelector("#post_id");
    const commentSection = document.querySelector(".comment-section");
    const numOfComments = document.querySelector(".num_of_comments");
    const commentValue = comment.value;
    const postIdValue = postId.value;
    const commentCsrfTokenValue = commentCsrfToken.value;

    if(commentValue.length > 0){
        spinParent.classList.add("lets_spin");
        let request = new XMLHttpRequest();
        let commenting = "commenting";
        request.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                commentSection.innerHTML = this.responseText;
                //big thing
                commentArrangementForLargerComment();
    
                //big thing end
                comment.value = "";
                numOfComments.innerText++;
                spinParent.classList.remove("lets_spin");
            }
        }
        request.open("POST", `in2.php`);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(`commenting=${commenting}&comment__csrf__token=${commentCsrfTokenValue}&post_id=${postIdValue}&comment=${commentValue}`);
    }else{
        alert("Comment Can't Be Empty");
        return false;
    }
    

    
}







   


