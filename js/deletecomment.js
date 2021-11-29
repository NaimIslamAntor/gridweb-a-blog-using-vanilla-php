
const deleteComment=(e)=>{e.preventDefault();
    const sure = confirm("Are You Sure You Want to Delete This Comment");
    if(sure){
        const updateAndDeleteCsrfToken = document.getElementById("update__and__deletecsrf__token");
        const useTokenToDelete = updateAndDeleteCsrfToken.value;
        let comntIdAttr = e.currentTarget.getAttribute("data-comment-delete");const httpReq=new XMLHttpRequest();httpReq.onreadystatechange=function(){if(this.readyState == 4 && this.status == 200){
            let commentBlocks=document.querySelectorAll(".comment__label-section");const totalComments=document.querySelector(".num_of_comments");commentBlocks.forEach(commentBlock=>{let blockAttr=commentBlock.getAttribute("data-comment-block");if(comntIdAttr == blockAttr){
            commentBlock.classList.add("animation_for_deleting");setTimeout(()=>{commentBlock.remove();totalComments.innerText--;}, 500);}});}}

            httpReq.open("POST", "in2.php");
            httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpReq.send(`comment_id=${comntIdAttr}&token=${useTokenToDelete}`);
    }

}

