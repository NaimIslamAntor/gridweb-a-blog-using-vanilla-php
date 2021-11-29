

const commentEdit = (e) => {
    e.preventDefault();
    //events attribute catching
    let attr = e.currentTarget.getAttribute('data-check');
    let attrComment = e.currentTarget.getAttribute('data-commentlabel');
    const editTextreas = document.querySelectorAll(".edit_textrea");
    const commentPlaces = document.querySelectorAll(".comment__label");
    const dates = document.querySelectorAll(".date");
    const csrfTokenForEditingHolder = e.target.previousElementSibling;
    const csrfTokenForEditing = csrfTokenForEditingHolder.value;

    //textarea creatinh
    
    let textArea = document.createElement('textarea');
    textArea.setAttribute('name', 'commenting');
    textArea.setAttribute('class', 'commentedit');
    textArea.setAttribute('id', 'editcmntid');
//button creating
    let [btnclass1, btnclass2, btnclass3, btnClass4] = ["delete-btn", "delete", "edit_action", "forUpdate"];
    let button = document.createElement("button");
    button.classList.add(btnclass1, btnclass2, btnclass3, btnClass4);

    //fontAwesome icon creating
    let [iconClass1, iconClass2, iconClass3] = ["fas", "fa-pen", "editcmnt"];
    let icon = document.createElement("i");
    icon.classList.add(iconClass1, iconClass2, iconClass3);

    //inserting button label in
    button.appendChild(icon);

    //class none is for hiding the current edit button of the comment section
    e.currentTarget.classList.add("none");
    
    //checking editTextrea data-comment attr mathed or not
    editTextreas.forEach((editTextrea) => {
        let textareaattr = editTextrea.getAttribute('data-comment');
        if(attr == textareaattr){
            textArea.innerHTML = attrComment;
            editTextrea.appendChild(textArea);
            button.setAttribute("data-upDateId", textareaattr);
            editTextrea.appendChild(button);

            //action button for editing the that comment
            button.addEventListener("click", (event) => {
                const eventAttr = event.target.getAttribute("data-upDateId");
                const textareaValue = textArea.value;
                // const csrfTokenForEditingHolder = document.getElementById("update__and__deletecsrf__token");
                // const csrfTokenForEditing = csrfTokenForEditingHolder.value;
                commentPlaces.forEach(place => {
                    placeAttr = place.getAttribute("data-id-for-up-comment");
                    
                    if(eventAttr == placeAttr){
                        
                        /* 
                        firing our javaScript ajax for
                        upadating comment in our database server
                        */
                       const readMore = document.querySelectorAll(".read");
                        let ajaxReqObj = new XMLHttpRequest();
                        ajaxReqObj.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                let updatedCommentVal = textareaValue;
                             
                                place.innerHTML = updatedCommentVal;
                                if(place.innerHTML.length > 480){
                                    place.classList.add("Short_comment");
                                    document.querySelectorAll(".date").forEach((d) => {
                                        const dateAtttr = d.getAttribute("data-read");
                                        if(eventAttr == dateAtttr){
                                            //d.appendChild(div);
                                            if(!d.lastElementChild.classList.contains("checkdiv")){
                                                const div = document.createElement("div");
                                                div.classList.add("checkdiv");
                                                const btn = document.createElement("button");
                                                btn.setAttribute("data-reading", eventAttr);
                                                btn.classList.add("read");
                                                btn.innerHTML = "Read More";
                                                btn.addEventListener("click", (e) => {
                                                    e.preventDefault();
                                                    place.classList.toggle("Short_comment");
                                                    if(e.target.innerHTML == "Read More"){
                                                        e.target.innerHTML = "Read Less";
                                                    }else{
                                                        e.target.innerHTML = "Read More"; 
                                                    }
                                                });
                                                div.appendChild(btn);
                                                d.appendChild(div);
                                               
                                            }
                   
                                        }
                                    });
                                }else{
                                    if(place.classList.contains("Short_comment")){
                                        place.classList.remove("Short_comment");
                                        readMore.forEach(more => {
                                            if(more.getAttribute("data-reading") == eventAttr){
                                                more.parentElement.remove();
                                            }
                                        })

                                    }else{
                                        readMore.forEach(more => {
                                            if(more.getAttribute("data-reading") == eventAttr){
                                                more.parentElement.remove();
                                            }
                                        })
                                    }
                                }

                        //removing that none class form current action edit button once done
                let nones = document.querySelectorAll(".none");
                nones.forEach(none => {
                    let noneAttr = none.getAttribute("data-check");
                    if(eventAttr == noneAttr){
                none.classList.remove("none");
      
                none.setAttribute("data-commentlabel", updatedCommentVal);
                
                    }
                });
                            }
                        }
                        //sending comment informations through ajax
                        ajaxReqObj.open("POST", `in2.php`);
                        ajaxReqObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajaxReqObj.send(`click=${btnClass4}&edittoken=${csrfTokenForEditing}&cmntVal=${textareaValue}&cmntId=${eventAttr}`);

                    }

                    if(eventAttr == textareaattr){
                        textArea.remove();
                        button.remove();
                        
                    }
                    
                });
            });
            
        }
        
    });

}





   


