$(function () {
    let clicked = "dashboard";
    const responseContainer = document.querySelector("#response-container");
    let nbr_response = 0;
    
    const createRespnse = (type,index) => {
        let name = "";
        let selection = "";
        if(type === "checkbox"){
            name = "checkbox[]";
            selection = "slected[]";
        } else if (type === "radio"){
            name = "radio[]";
            selection = "slected";
        }else if(type === "text"){
            name = "text";
        }
        const input = `
            <div class="checkbox-inline" style="text-align:center;">
                <input type="${type}" classe="form-control" value="${index}" name="${selection}">
            </div>
            `;
        const response = new DOMParser().parseFromString(
            `
            <div class="form-group row">
                <label for="${index}" class="col-sm-2 col-form-label">Reponse ${index+1}</label>
                <div class="col-sm-8">
                    <input type="text" name="${name}" id="${index}" class="form-control questionField" placeholder="Votre Reponse" aria-describedby="helpId">
                    <small class="text-danger"></small>
                </div>
                ${(type=="checkbox" || type=="radio")?input:""}
                <img src="../img/ic-supprimer.png" class="delete-response" alt="Icone supprimer reponse.">
            </div>
            `,"text/html"
        );
        
        const img = response.body.querySelector("img");
        $(img).on("click", function () {
            deleteResponse(this);
            nbr_response--;
            reorganizeResponse();
        });
        responseContainer.appendChild(response.body.firstChild);
    };
    const deleteResponse = (img) => {
        const parent = img.parentNode;
        $(parent).remove();
    };
    const reorganizeResponse = () => {
        const containerElts = responseContainer.querySelectorAll("div.form-group");
        const containerEltsSize = containerElts.length;
        for (let i = 0; i < containerEltsSize; i++) {
            const elt = containerElts[i];
            elt.querySelector("label").textContent = `Reponse ${i + 1}`;
            let input = elt.querySelectorAll("input");
            input[0].setAttribute("error", `response${i + 1}`);
            input[1].setAttribute("value", `${i}`);
            // elt.querySelector(".error-question").setAttribute("id", `${i + 1}`);
        }
    };
    const removeAll = wrapper => {
        $(wrapper).html("");
    };
    const showError = (element, message) => {
        element.nextElementSibling.textContent = message;
    };

    $("#_createQuestion").css("display", "flex");
    $("#navbarAdmin a").each(function () {
        $(this).click(function (e) {
            clicked = this.id;
            $(".displayed").css("display", "none");
            $(".displayed").removeClass("displayed");
            $(`#_${clicked}`).addClass("displayed");
            if (clicked == "createAdmin") {
                $(`#_${clicked}`).css("display", "block");
            } else {
                $(`#_${clicked}`).css("display", "flex");
            }
        });
    });
    $("#subscribeForm").on("submit", function (event) {
        event.preventDefault();
        const userLogin = $("#inputLogin").val();
        const userPassword = $("#inputPassword").val();
        let hasError = false;
        $("#subscribeForm input").each(function () {
            $(this).on("input", function () {
                showError(this, "");
            });
            const value = this.value;
            if (!value) {
                hasError = true;
                showError(this, "Ce champs est obligatoire");
            } else {
                if (this.type == "password" && this.value != userPassword) {
                    hasError = true;
                    showError(this, "Les deux mot de passe ne correspondent pas.")
                }
            }
        });
        if (!hasError) {
            const xhr = new XMLHttpRequest();
            let form = document.querySelector("#subscribeForm");
            form = new FormData(form);
            xhr.open("POST", "../models/getUsersList.php");
            xhr.onreadystatechange = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        const players = JSON.parse(xhr.responseText);
                        let isfound = false;
                        for (const player of players) {
                            if (player["loginJoueur"]) {
                                if (player["loginJoueur"] == userLogin) {
                                    isfound = true;
                                    showError(document.querySelector("#inputLogin"), "Ce compte existe deja.");
                                    return;
                                }
                            } else if (player["loginAdmin"]) {
                                if (player["loginAdmin"] == userLogin) {
                                    isfound = true;
                                    showError(document.querySelector("#inputLogin"), "Ce compte existe deja.");
                                    return;
                                }
                            }
                        }
                        if (!isfound) {
                            $("#subscribeForm").unbind("submit").submit();
                        }
                    }
                }
            };
            xhr.send(form);
        }
    });
    $("#inputAvatar").change(function (e) {
        e.preventDefault();
        if (this.type == "file") {
            let authorizedExtension = ["png", "jpeg", "jpg"];
            let fileExtension = this.value.split(".")[1];
            const avatarWidth = "200px";
            if (authorizedExtension.includes(fileExtension)) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(this.files[0]);
                fileReader.onloadend = event => {
                    $("#showAvatar").html(
                        `<img src=${event.target.result} width=${avatarWidth} height=${avatarWidth} alt=avatar/>`
                    );
                    $("#showAvatar").css("display", "block");
                };
            } else {
                hasError = true;
                showError(this, "Veuillez uploader une image");
            }
        }
    });
    $("#questionForm").on("submit", function (event) {
        event.preventDefault();
        let hasEmptyField = false;
        $("#questionForm .questionField").each(function () {
            $(this).on("input", function () {
                showError(this, "");
            });
            if (!this.value) {
                hasEmptyField = true;
                showError(this, "Ce champs est obligatoire.");
            }else if(this.type == "number"){
                if(parseInt(this.value) < 1){
                    showError(this, "La note minimale est de 1.");
                }
            }
        });
        if(!hasEmptyField){
            console.log("Good");
            $("#questionForm").unbind("submit").click();
        }
    });
    $(".add-response").on("click", function () {
        const select = document.querySelector("#type");
        if (!select.value) {
            showError(select, "Veuillez choisir le type de reponse");
        } else if (select.value === "checkbox") {
            createRespnse(select.value, nbr_response);
            nbr_response++;
        } else if (select.value === "radio") {
            createRespnse(select.value, nbr_response);
            nbr_response++;
        }
        else {
            createRespnse(select.value, nbr_response);
            nbr_response++;
        }
    });

    $("#type").on("change", function () {
        showError(this, "");
        removeAll(responseContainer);
    });
    $(window).on('resize', function () {
        var win = $(this); //this = window
        const avatar = document.querySelector("#showAvatar");
        if (win.width() <= 990) {
            avatar.parentNode.style.display = "none";
        } else {
            avatar.parentNode.style.display = "block";
        }
    });
    // window.addEventListener("load", () => {
    //     $('#adminContainer').load(`./${clicked}.php`);
    // });
    // const href = window.location.href.split("#")[1] || "dasboard";
    // console.log(href);
    
});