$(function () {
    const form = $("#form #question");
    const enonce = $("#enonce");
    const point = $("#point");
    const tbody = $("#meilleurs tbody");
    const buttonNext = $("#next");
    const buttonPrevious = $("#previous");
    const buttonFinish = $("#terminer");
    const indexQuestion = $("#indexQuestion");
    const hiddenIndexQuestion = $("#hiddenIndexQuestion");
    const typeQuestion = $("#typeQuestion");
    const cardBody = $("#card-body");
    buttonFinish.css("display", "none");
    const getNbrQuestion = () => {
        const data = new FormData();
        data.append("nbrQuestion","nbrQuestion")
        const xhr = new XMLHttpRequest();
        xhr.open("POST","../models/userNumber.php",false);
        xhr.send(data);
        return JSON.parse(xhr.responseText);
    };
    const sendResponses = (button) => {
        let formulaire = document.querySelector("#form");
        formulaire = new FormData(formulaire);
        formulaire.append(button, button);
        $.ajax({
            type: "POST",
            url: $("#form").attr("action"),
            cache: false,
            contentType: false,
            processData: false,
            data: formulaire,
            dataType: "json",
            success: function (response) {
                const index = page - 1;
                userResponse[index] = response;
            }
        });
    };
    let page = 0;
    let userResponse = [];
    const nbrQuestion = getNbrQuestion().nombreQuestion;
    // const nbrQuestion = 5;
    const getQuestion = () => {
        $.ajax({
            type: "POST",
            url: "../models/getUserQuestions.php",
            dataType: "json",
            success: function (questions) {
                listQuestion(questions[0],page,form);
                buttonNext.on("click", function () {
                    (page+1 < nbrQuestion) ? page += 1 : page = nbrQuestion;
                    if (page == nbrQuestion){
                        page = nbrQuestion-1;
                        buttonFinish.css("display", "inline-block");
                        buttonNext.css("display", "none");
                    }
                    $("#previous").removeAttr("disabled");
                    sendResponses("next");
                    const reponses = userResponse[page] != undefined ? userResponse[page].reponse : userResponse[page];
                    listQuestion(questions[page], page, form, reponses)
                });
                buttonPrevious.on("click", function () {
                    --page; 
                    if(page <= 0){
                        page = 0
                        $("#previous").attr("disabled", "disabled");
                    }
                    // sendResponses("previous");
                    const reponses = userResponse[page] != undefined ? userResponse[page].reponse : userResponse[page];
                    listQuestion(questions[page], page, form, reponses);
                    buttonNext.css("display", "inline-block");
                    buttonFinish.css("display", "none");
                });
                buttonFinish.on("click", function () {
                    sendResponses("next");
                    checkQuestions(questions,userResponse);
                });
            }
        });
    };
    const displayGoodAnswers = (wrapper,goodAnswers) => {
        wrapper.html("");
        if (goodAnswers.length){
            wrapper.append("<h3 class='text-center'>Les questions que vous avez trouvees :)</h3>");
            for (const question of goodAnswers) {
                const choices = question["choixPossible"];
                const response = question["reponse"];
                const enonce = question["ennonceQuestion"];
                const idQuestion = question["idQuestion"];
                const typeQuestion = question["typeQuestion"]
                createQuestion(wrapper, enonce, typeQuestion, choices, response, idQuestion);
            }
        }else{
            wrapper.append("<h3 class='text-center'>Pas de bonne reponse :(</h3>");
        }
    };
    const displayWrongAnswers = (wrapper,wrongAnswers) => {
        if (wrongAnswers.length){
            wrapper.append("<h3 class='text-center'>Les questions que vous avez faussees :(</h3>");
            for (const wrongAnswer of wrongAnswers) {
                const enonce = wrongAnswer["ennonceQuestion"];
                const elt = `
                    <div class="card col-8 mt-3 mb-3 mr-auto ml-auto bg bg-secondary">
                        <div class="card-body">
                            <h4 class="card-title text-center">${enonce}</h4>
                        </div>
                    </div>
                `;
                wrapper.append(elt);
            }
        }
    }
    const compareArrays = (reponseUtil,questioResponse) => {
        for (const reponse of reponseUtil) {
            if (!questioResponse.includes(reponse)){
                return false;
            }
        }
        return true;
    };
    const checkQuestions = (questions,userResponses) => {
        const goodAnswers = [];
        const wrongAnswers = [];
        for (const response of userResponses) {
            for (const question of questions) {
                if (question.idQuestion == response.idQuestion){
                    if (question.typeQuestion == "text"){
                        const reponseUti = response.reponse.trim().toLowerCase();
                        const questionResponse = question.reponse.trim().toLowerCase();
                        if (reponseUti == questionResponse){
                            goodAnswers.push(question);
                        }else{
                            wrongAnswers.push(question);
                        }
                    } else if (question.typeQuestion == "radio"){
                        const reponseUti = response.reponse;
                        const questionResponse = question.reponse[0];
                        if (reponseUti == questionResponse) {
                            goodAnswers.push(question);
                        } else {
                            wrongAnswers.push(question);
                        }
                    } else if (question.typeQuestion == "checkbox"){
                        if (question.reponse.length != response.reponse.length){
                            wrongAnswers.push(question);
                        }else{
                            const isEqual = compareArrays(response.reponse, question.reponse);
                            if(isEqual){
                                goodAnswers.push(question);
                            }else{
                                wrongAnswers.push(question);
                            }
                        }
                    }
                }
            }
        }
        if (goodAnswers.length){
            const reducer = (accumulator, currentValue) => accumulator += parseInt(currentValue.note);
            const score = goodAnswers.reduce(reducer,0);
            setPlayerScore(score);
        }
        displayGoodAnswers(cardBody, goodAnswers);
        displayWrongAnswers(cardBody, wrongAnswers);
    };
    const setPlayerScore = score => {
        const data = new FormData();
        let idJoueur = $("#score").val();
        data.append("scoreModification","scoreModification");
        data.append("score", score);
        data.append("idJoueur", idJoueur);
        $.ajax({
            type: "POST",
            url: "../models/userNumber.php",
            cache: false,
            contentType: false,
            processData: false,
            data: data
        });
    };
    const getBestPlayers = () => {
        // const form = document.createElement)
        $.ajax({
            type: "POST",
            url: "../models/setPlayers.php",
            data: "score=score",
            dataType: "json",
            success: function (response) {
                insertBestPlyersInTab(tbody, response);
            }
        });
    };
    const insertBestPlyersInTab = (wrapper,bestPlayers) => {
        for (const bestPlayer of bestPlayers) {
            wrapper.append(`
                <tr>
                    <td>${bestPlayer["prenomJoueur"]}</td>
                    <td>${bestPlayer["nomJoueur"]}</td>
                    <td>${bestPlayer["scoreJoueur"]}</td>
                </tr>
            `);
        }
    };
    const listQuestion = (question,indiceQuestion,wrapper,response)  => {
        if(question){
            indexQuestion.text("");
            indexQuestion.text(indiceQuestion+1);
            const type = question.typeQuestion;
            typeQuestion.val(type);
            $("#idQuestion").val(question.idQuestion);
            hiddenIndexQuestion.val(indiceQuestion);
            enonce.text(`${question.ennonceQuestion}`);
            enonce.addClass("p-2");
            point.text(`${question.note} pts`);
            point.addClass("p-2");
            form.html("");
            if (type === "checkbox" || type === "radio"){
                let counter = 0;
                if (response){
                    for (const value of question.choixPossible) {
                        if (response.includes(value) || response == value){
                            const questionField = `
                                <div class="form-group row mt-3">
                                    <input type="${type}" id="${counter}"  name="${type=="checkbox"?"checkbox[]":"radio"}" class="form-control col-1" value="${value}" checked/>
                                    <div class="col-10">
                                        <label class="col-form-label" for="${counter}">${value}</label>
                                    </div>
                                </div>
                            `;
                            wrapper.append(questionField);
                        }else{
                            const questionField = `
                                <div class="form-group row mt-3">
                                    <input type="${type}" id="${counter}" name="${type == "checkbox" ? "checkbox[]" : "radio"}" class="form-control col-1" value="${value}"/>
                                    <div class="col-10">
                                        <label class="col-form-label" for="${counter}">${value}</label>
                                    </div>
                                </div>
                            `;
                            wrapper.append(questionField);
                        }
                        counter++;
                    }
                }else{
                    counter = 0;
                    for (const value of question.choixPossible) {
                        const questionField = `
                            <div class="form-group row mt-3">
                                <input type="${type}" id="${counter}" name="${type == "checkbox" ? "checkbox[]" : "radio"}" class="form-control col-1" value="${value}"/>
                                <div class="col-10">
                                    <label class="col-form-label" for="${counter}">${value}</label>
                                </div>
                            </div>
                        `;
                        wrapper.append(questionField);
                        counter++;
                    }

                }
            }else{
                const value = response != undefined ? response : "";
                const questionField = `
                    <div class="form-group row mt-3">
                        <label class="col-form-label" for="text">Votre Reponse : </label>
                        <div class="col-10">
                            <input type="text" id="text" name="text" class="form-control col-12" value="${value}"/>
                        </div>
                    </div>
                `;
                wrapper.append(questionField);
            }
        }
    };
    const setQuestion = (question,reponse) => {
        question["userResponse"] = reponse;
    };
    const getUserResponse = () => {
        let formulaire = document.querySelector("#form");
        formulaire = new FormData(formulaire);
        formulaire.append("previous", "previous");
        $.ajax({
            type: "POST",
            url: $("#form").attr("action"),
            cache: false,
            contentType: false,
            processData: false,
            data: formulaire,
            dataType: "json",
            success: function (response) {
                userResponse = response;
            }
        });
    }
    const createQuestion = (wrapper,enonce, typeQuestion, choices, response, idQuestion) => {
        let text = `
            <div class="form-group row">
                <input type="text" class="form-control" value="${response}" disabled/>
            </div>
        `;
        let reponse = "";
        for (const choice of choices) {
            if (typeQuestion === "checkbox") {
                if (response.includes(choice)) {
                    reponse += `
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-1" checked disabled/>
                        <div class="col-10">
                            <label class="col-form-label"> ${choice}</label>
                        </div>
                    </div>
                    `;
                } else {
                    reponse += `
                    <div class="form-group row">
                        <input type="checkbox" class="form-control col-1" disabled/>
                        <div class="col-10">
                            <label class="col-form-label"> ${choice}</label>
                        </div>
                    </div>
                    `;
                }
            } else if (typeQuestion === "radio") {
                if (choice == response) {
                    reponse += `
                        <div class="form-group row">
                            <input type="radio" class="form-control col-1" checked disabled/>
                            <div class="col-10">
                                <label class="col-form-label"> ${choice}</label>
                            </div>
                        </div>
                    `;
                } else {
                    reponse += `
                        <div class="form-group row">
                            <input type="radio" class="form-control col-1" disabled/>
                            <div class="col-10">
                                <label class="col-form-label"> ${choice}</label>
                            </div>
                        </div>
                    `;
                }
            }
        }
        let elt = `
            <div class="card col-8 mt-3 mb-3 mr-auto ml-auto bg bg-secondary">
                <div class="card-body">
                    <h4 class="card-title text-center" id="${idQuestion}">${enonce}</h4>
                    ${(typeQuestion == "text") ? text : reponse}
                </div>
            </div>
        `;
        wrapper.append(elt);
    };
    getBestPlayers();
    getQuestion();
    
});