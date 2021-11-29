(function(){

    const categorySibling = document.querySelectorAll(".category_sibling");
    const lengthOfCateNodes =  categorySibling.length;
    let categoryFriend;

    if(lengthOfCateNodes > 0){
        const lastChildInrText = categorySibling[lengthOfCateNodes - 1];
        const removingComma = lastChildInrText.innerHTML.replace(",", "");
        lastChildInrText.innerHTML = removingComma;

    }else{
        categoryFriend = document.querySelector(".category_friend");
        categoryFriend.remove();
    }

})();