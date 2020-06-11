$(function () {
    const form = $("#form #question");
    const enonce = $("#enonce");
    const point = $("#point");
    const tbody = $("#meilleurs tbody");
    const paginationContainer = document.querySelector("#paginationContainer");
    const indexQuestion = $("#indexQuestion");
    const hiddenIndexQuestion = $("#hiddenIndexQuestion");
    const typeQuestion = $("#typeQuestion");
    let currentPage = 1;
    const row = 1;

    const getQuestion = (url) => {
        const xhr = new XMLHttpRequest();
        // $.ajax({
        //     type: "POST",
        //     url: url,
        //     dataType: "json",
        //     success: function (questions) {
        //     }
        // });
    };
    const getQuestionnumber = (url) => {
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
    const listQuestion = (question,indiceQuestion,wrapper)  => {
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
                for (const value of question.choixPossible) {
                    const questionField = `
                        <div class="form-group row mt-3">
                            <input type="${type}" name="${type=="checkbox"?"checkbox[]":"radio"}" class="form-control col-1" value="${value}"/>
                            <div class="col-10">
                                <label class="col-form-label">${value}</label>
                            </div>
                        </div>
                    `;
                    wrapper.append(questionField);
                }
            }else{
                const questionField = `
                    <div class="form-group row mt-3">
                        <label class="col-form-label">Votre Reponse : </label>
                        <div class="col-10">
                            <input type="text" name="text" class="form-control col-12"/>
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
    
    getBestPlayers();
    getQuestion("../models/getUserQuestions.php");
});