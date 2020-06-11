$(function () {
    const form = $("#form #question");
    const enonce = $("#enonce");
    const point = $("#point");
    const tbody = $("#meilleurs tbody");
    const buttonNext = $("#next");
    const buttonPrevious = $("#previous");
    const indexQuestion = $("#indexQuestion");
    const hiddenIndexQuestion = $("#hiddenIndexQuestion");
    const typeQuestion = $("#typeQuestion");
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
    // for (let i = 0; i < nbrQuestion; i++) {
    //     userResponse.push(0);
    // }
    const getQuestion = () => {
        $.ajax({
            type: "POST",
            url: "../models/getUserQuestions.php",
            dataType: "json",
            success: function (questions) {
                listQuestion(questions[0],page,form);
                buttonNext.on("click", function () {
                    (page+1 < questions.length && page+1 < nbrQuestion) ? page += 1 : page = -15;
                    if(page >= 1){
                        $("#previous").removeAttr("disabled");
                    }
                    sendResponses("next");
                    if(page == -15){
                        buttonNext.text("Terminer");
                        buttonNext.attr("id", "terminer");
                        buttonNext.attr("name", "terminer");
                    }
                    listQuestion(questions[page], page, form, userResponse[page]);
                });
                buttonPrevious.on("click", function () {
                    page > 1 ? page -= 1 : $("#previous").attr("disabled", "disabled");
                    if(page == 1){
                        page -= 1;
                    }
                    sendResponses("previous");

                    listQuestion(questions[page], page, form,userResponse[page]);
                });
            }
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
            indexQuestion.text(indiceQuestion+1);
            const type = question.typeQuestion;
            typeQuestion.val(type);
            hiddenIndexQuestion.val(indiceQuestion);
            enonce.text(`${question.ennonceQuestion}`);
            enonce.addClass("p-2");
            point.text(`${question.note} pts`);
            point.addClass("p-2");
            form.html("");
            if (type === "checkbox" || type === "radio"){
                if (response){
                    for (const value of question.choixPossible) {
                        if (response.includes(value) || response == value){
                            const questionField = `
                                <div class="form-group row mt-3">
                                    <input type="${type}" name="${type=="checkbox"?"checkbox[]":"radio"}" class="form-control col-1" value="${value}" checked/>
                                    <div class="col-10">
                                        <label class="col-form-label">${value}</label>
                                    </div>
                                </div>
                            `;
                            wrapper.append(questionField);
                        }else{
                            const questionField = `
                                <div class="form-group row mt-3">
                                    <input type="${type}" name="${type == "checkbox" ? "checkbox[]" : "radio"}" class="form-control col-1" value="${value}"/>
                                    <div class="col-10">
                                        <label class="col-form-label">${value}</label>
                                    </div>
                                </div>
                            `;
                            wrapper.append(questionField);
                        }
                        
                    }
                }else{
                    for (const value of question.choixPossible) {
                        const questionField = `
                            <div class="form-group row mt-3">
                                <input type="${type}" name="${type == "checkbox" ? "checkbox[]" : "radio"}" class="form-control col-1" value="${value}"/>
                                <div class="col-10">
                                    <label class="col-form-label">${value}</label>
                                </div>
                            </div>
                        `;
                        wrapper.append(questionField);
                    }

                }
            }else{
                const value = response != undefined ? response : "";
                const questionField = `
                    <div class="form-group row mt-3">
                        <label class="col-form-label">Votre Reponse : </label>
                        <div class="col-10">
                            <input type="text" name="text" class="form-control col-12" value="${value}"/>
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
    getBestPlayers();
    getQuestion();
    
});