$(function () {
    let clicked = "listQuestion";
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
        $(".add-response").css("display", "inline-block");
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
    const displayQuestion = JSONquestions => {
        const wrapper = document.querySelector("#listQuestionContainer");
        for (const question of JSONquestions) {
            const choices = question["choixPossible"].split(",");
            const response = question["reponse"].split(",") || question["reponse"];
            const enonce = question["ennonceQuestion"];
            const idQuestion = question["idQuestion"];
            const typeQuestion = question["typeQuestion"]
            createQuestion(wrapper,enonce, typeQuestion, choices, response, idQuestion);
        }
    };
    const deleteQuestion = idParentElt => {
        // const container = document.getElementById(idParentElt).parentElement.parentElement;
        // $(container).hide();
        const sup = window.confirm("Voulez vous vraiment supprimer cette question ?");
        if(sup){
            const data = new FormData();
            data.append("delete",idParentElt);
            const xhr = new XMLHttpRequest();
            xhr.open("POST","../models/getQuestionsList.php");
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200){
                    const container = document.getElementById(idParentElt).parentElement.parentElement
                    container.remove();
                }
            };
            xhr.send(data);
        }
    };
    const modifyQuestion = idParentElt => {
        const confirm = window.confirm("voulez vous vraiment modifier cette question ?");
        if(confirm){
            // $('.modale').css('display', 'flex');
        }
    };
    const createQuestion = (wrapper,enonce, typeQuestion, choices, response, idQuestion) => {
        let text = `
            <div class="form-group row">
                <input type="text" class="form-control" value="${response}" disabled/>
            </div>
        `;
        let reponse = "";
        for (const choice of choices) {
            if(typeQuestion === "checkbox"){
                if(response.includes(choice)){
                    reponse += `
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-sm-2" checked disabled/>
                        <div class="col-sm-10">
                            <label class="col-form-label"> ${choice}</label>
                        </div>
                    </div>
                    `;
                }else{
                    reponse += `
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-sm-2" disabled/>
                        <div class="col-sm-10">
                            <label class="col-form-label"> ${choice}</label>
                        </div>
                    </div>
                    `;
                }
            } else if (typeQuestion === "radio"){
                if(choice == response){
                    reponse += `
                        <div class="form-group row">
                            <input type="radio" class="form-control col-sm-2" checked disabled/>
                            <div class="col-sm-10">
                                <label class="col-form-label"> ${choice}</label>
                            </div>
                        </div>
                    `;
                }else{
                    reponse += `
                        <div class="form-group row">
                            <input type="checkbox" class="form-control col-sm-2" disabled/>
                            <div class="col-sm-10">
                                <label class="col-form-label"> ${choice}</label>
                            </div>
                        </div>
                    `;
                }
            }
        }
        let elt = `
            <div class="card col-sm-6 mt-3 mb-3 mr-auto ml-auto">
                <div class="card-body">
                    <h4 class="card-title text-center" id="${idQuestion}">${enonce} <img src="../img/ic-liste-active.png" alt="image modifier" class="modify-question" title="Modifier la question"/> <img class="delete-question" src="../img/ic-supprimer.png" alt="image corbeille" title="Supprimer la question"></h4>
                    ${(typeQuestion == "text") ? text:reponse}
                </div>
            </div>
        `;
        const parse = new  DOMParser();
        elt = parse.parseFromString(elt, "text/html");
        const delteImgElt = elt.body.querySelector(".delete-question");
        const modifyImgElt = elt.body.querySelector(".modify-question");
        const idParentQuestion = modifyImgElt.parentNode.id;
        $(delteImgElt).on("click", function () {
            deleteQuestion(idParentQuestion);
        });
        $(modifyImgElt).on("click", function () {
            modifyQuestion(idParentQuestion);
        });
        wrapper.appendChild(elt.body.firstChild);
    };
    const showAllQuestions = () => {
        const xhr = new XMLHttpRequest();
        const form = new FormData();
        form.append("list", "listQuestion");
        xhr.open("POST", "../models/getQuestionsList.php");
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const questions = JSON.parse(xhr.responseText);
                const html = `<h3 class="card-title text-center">Liste Question</h3>`;
                $("#listQuestionContainer").html(html);
                displayQuestion(questions);
                console.log(JSON.parse(xhr.responseText));
            }
        };
        xhr.send(form);
        $("#listQuestionContainer").css("overflow-y", "auto");
    };
    const formSubscribtion = () => {
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
    };
    $("#subscribeForm").on("submit", function (event) {
        event.preventDefault();
        formSubscribtion();
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
            } else if (this.type == "number") {
                if (parseInt(this.value) < 1) {
                    showError(this, "La note minimale est de 1.");
                }
            }
        });
        if (!hasEmptyField) {
            console.log("Good");
            $("#questionForm").unbind("submit").click();
        }
    });
    $("#numForm").on("submit", function (event) {
        let hasError = false;
        
        $("#numForm input").each(function () {
            $(this).on("input", function () {
                showError(this,"");
            });
            if(!this.value){
                hasError = true;
                showError(this, "Ce champs est obligatoire.");
            }else if(this.value < 10){
                hasError = true;
                showError(this, "Le nombre de question minimale/jeu est 10.");
            }
            if(hasError){
                event.preventDefault();
            }
        });
    });
    // $("#_listQuestion").css("display", "flex");
    $("#navbarAdmin a").each(function () {
        $(this).click(function (e) {
            clicked = this.id;
            // $(".displayed").css("display", "none");
            // $(".displayed").removeClass("displayed");
            // $(`#_${clicked}`).addClass("displayed");
            // if (clicked == "createAdmin") {
            //     $(`#_${clicked}`).css("display", "block");
            //     console.log(clicked);
                
            // } else {
            //     $(`#_${clicked}`).css("display", "flex");
            // }
            if (clicked === "createQuestion") {
                $("#adminContainer").load("../views/createQuestion.php", function () {
                    // showAllQuestions();
                });
            }else if (clicked == "listQuestion") {
                $("#adminContainer").load(`./${clicked}`, function () {
                    showAllQuestions();
                });
            }else if(clicked == "createAdmin"){
                $("#adminContainer").load("./../views/createAdmin.php",function () {

                });
            }
        });
        // clicked = this.id;
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
            $(".add-response").css("display", "none");
            nbr_response++;
        }
    });

    $("#type").on("change", function () {
        showError(this, "");
        $(".add-response").css("display", "inline-block");
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
    window.addEventListener("load", () => {
        $('#adminContainer').load(`./${clicked}.php`);
    });
    // const href = window.location.href.split("#")[1] || "dasboard";
    // console.log(href);
    
});