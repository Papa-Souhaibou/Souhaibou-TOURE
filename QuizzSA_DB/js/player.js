$(function () {
    const form = $("#form");
    const enonce = $("#enonce");
    const point = $("#point");
    const getQuestion = (url) => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, false);
        xhr.send(null);
        return JSON.parse(xhr.responseText);
    }
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
                        <input type="${type}" class="form-control col-1"/>
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
    listQuestion(questions[1],form);
    // console.log(questions);
    
});