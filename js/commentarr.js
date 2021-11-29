
(function(){const commentLabel = document.querySelectorAll(".comment__label");
commentLabel.forEach((label) => {const shortLength = 480;let commentLength = label.innerHTML.length;if(commentLength > shortLength){const div = document.createElement("div");
div.classList.add("checkdiv");const button = document.createElement("button");const dates = document.querySelectorAll(".date");
button.classList.add("read");button.innerHTML = "Read More";label.classList.add("Short_comment");const getDataAttr = label.getAttribute("data-id-for-up-comment");
dates.forEach((date) => { const dateDataAttr = date.getAttribute("data-read");if(getDataAttr == dateDataAttr){
button.setAttribute("data-reading", dateDataAttr);div.appendChild(button)
date.appendChild(div);button.addEventListener("click", (e) => {e.preventDefault();const eAttr = e.target.getAttribute("data-reading");
if(e.target.innerHTML === "Read More"){e.target.innerHTML = "Read Less";}else{e.target.innerHTML = "Read More";}
const ShortComments = document.querySelectorAll(".comment__label");ShortComments.forEach((ShortComment) => {
const showcomAttr = ShortComment.getAttribute("data-id-for-up-comment");if(eAttr == showcomAttr){ShortComment.classList.toggle("Short_comment");
}});});}});}});})();