$(function () {
    const form = $("#form #question");
    const enonce = $("#enonce");
    const point = $("#point");
    const tbody = $("#meilleurs tbody");
    const btnNext = $("#next");
    const btnPrevious = $("#previous");
    const indexQuestion = $("#indexQuestion");
    const getQuestion = (url) => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, false);
        xhr.send(null);
        return JSON.parse(xhr.responseText);
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
    }
    let currentPage = 0;
    if (currentPage == 0){
        btnPrevious.attr("disabled", "disabled");
    }
    if(currentPage >=1){
        btnNext.attr("disabled", "disabled");
    }
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
    const listQuestion = (question,wrapper)  => {
        enonce.text(`${question.ennonceQuestion}`);
        enonce.addClass("p-2");
        point.text(`${question.note} pts`);
        point.addClass("p-2");
        form.html("");
        const type = question.typeQuestion;
        if (type === "checkbox" || type === "radio"){
            for (const value of question.choixPossible) {
                const questionField = `
                    <div class="form-group row mt-3">
                        <input type="${type}" class="form-control col-1" value="${value}"/>
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
                        <input type="text" class="form-control col-12"/>
                    </div>
                </div>
            `;
            wrapper.append(questionField);
        }
    };
    const questions = getQuestion("../models/getUserQuestions.php");
    console.log(questions);
    btnNext.on("click", function () {
        
        currentPage++;
        btnPrevious.removeAttr("disabled");
        listQuestion(questions[currentPage],form);
        indexQuestion.text(currentPage + 1);
    });
    btnPrevious.on("click", function () {
        indexQuestion.text(currentPage);
        if (currentPage + 1 == 2) {
            btnPrevious.attr("disabled", "disabled");
        }else{
        }
        currentPage--;
        btnNext.removeAttr("disabled");
        listQuestion(questions[currentPage],form);
    });
    getBestPlayers();
    listQuestion(questions[currentPage],form);
    indexQuestion.text(currentPage+1);
});