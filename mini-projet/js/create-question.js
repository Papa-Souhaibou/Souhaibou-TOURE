const questionIputs = document.querySelectorAll("input");
const submitButton = document.querySelector(".btn-submit-question");
const selectElt = document.querySelector("#choix");
const addIcone = document.querySelector(".add-response");
const container = document.querySelector(".display-response");
let nbrResponse = 1;
selectElt.addEventListener("change", event => { 
    if (event.target.hasAttribute("error")) {
        const divId = event.target.getAttribute("error");
        document.querySelector("#" + divId).textContent = "";
    }
    if (selectElt.value != "#" )
        container.innerHTML = "";
    const choiceParent = selectElt.parentNode;
    const error_choix = document.querySelector("#error-choix");
    choiceParent.insertBefore(addIcone,error_choix);
    nbrResponse = 1;
});
const displayErrors = (elt,message) => {
    if (elt.hasAttribute("error")) {
        let getId = elt.getAttribute("error");
        let getDiv = document.querySelector("#" + getId);
        getDiv.textContent = message;
    }
    else {
        console.log("have not error attribute");
    }
}
submitButton.addEventListener("click", event => {
    let errors = false;
    const inputs = document.querySelectorAll("#question-form input[type=text]");
    const nbre = document.querySelector("#point");
    const seletedChoice = selectElt.value;
    let typeOfInput = seletedChoice === "checkbox" ? seletedChoice : "radio";
    const addedInputs = document.querySelectorAll("."+typeOfInput);
    let hasResponse = false;
    let compteurReponse = 0;
    if(addedInputs.length){
        for (const addedInput of addedInputs) {
            if(addedInput.checked){
                if (addedInput.type === "checkbox") {
                    compteurReponse++;
                }
                hasResponse = true;
            }
        }
        if(compteurReponse < 2 && typeOfInput === "checkbox"){
            displayErrors(selectElt, "Veuillez choisir au moins 2 reponses");
            errors = true;
        }
        if(!hasResponse && (typeOfInput === "checkbox" || typeOfInput === "radio")){
            displayErrors(selectElt,"Veuillez choisir une reponse");
            errors = true;
        }
    }
    if(!nbre.value) {
        displayErrors(nbre, "Ce champs est obligatoire");
        errors = true;
    }else if(nbre.value < 1){
        displayErrors(nbre, "Le nombre de point doit etre superieur a 0");
        errors = true;
    }
    if(selectElt.value === "#"){
        displayErrors(selectElt, "Ce champs est obligatoire");
        errors = true;
    }
    for (const input of inputs) {
        if (input.type === "text" || input.type === "number") {
            if(!input.value){
                displayErrors(input, "Ce champs est obligatoire");
                errors = true;
            }
        }
    }
    if(inputs.length === 1){
        displayErrors(selectElt, "Veuillez ajouter une reponse");
        errors = true;
    }
    if(errors){
        event.preventDefault();
    }
});
const createIcone = (url,classes) => {
    const img = document.createElement("img");
    img.src = url;
    for (const elt of classes) {
        img.classList.add(elt);
    }
    return img;
};

const deleteEvent = event => {
    const targetClass = event.target.classList[0];
    const parentTarget = event.target.parentNode;
    if(targetClass === "delete"){
        container.removeChild(parentTarget);
        nbrResponse--;
    }
}
const reorganizeAddedInputs = () => {
    const containerElts = container.querySelectorAll(".response-container");
    const containerEltsSize = containerElts.length;
    for (let i = 0; i < containerEltsSize; i++) {
        const elt = containerElts[i];
        elt.querySelector("label").textContent = `Reponse ${i+1}`;
        let input = elt.querySelectorAll("input");
        input[0].setAttribute("error",`response${i+1}`);
        input[1].setAttribute("value",`${i}`);
        elt.querySelector(".error-question").setAttribute("id",`${i+1}`);
    }
}
addIcone.addEventListener("click", event => {
    if(selectElt.value != "#"){
        const targetClass = event.target.classList[0];
        const response_container = document.createElement("div");
        response_container.setAttribute("class","response-container");
        const divErrorQuestion = document.createElement("div");
        divErrorQuestion.classList.add("error-question");
        const label = document.createElement("label");
        const input = document.createElement("input");
        input.type = "text";
        input.name = "response[]";
        const deleteIcone = createIcone("../img/icones/ic-supprimer.png",["delete","icone"]);
        deleteIcone.addEventListener("click",deleteEvent);
        deleteIcone.addEventListener("click",reorganizeAddedInputs);
        const inputType = document.createElement("input");
        inputType.value = `${nbrResponse - 1}`;
        if (selectElt.value === "checkbox"){
            inputType.type = "checkbox";
            inputType.name = `reponseCheckbox[]`;
            inputType.classList.add("checkbox");
        } else if (selectElt.value === "radio") {
            inputType.type = "radio";
            inputType.name = `reponses`;
            inputType.classList.add("radio");
        } else if(selectElt.value === "text"){
            const addParent = addIcone.parentNode;
            addParent.removeChild(addIcone);
        }
        input.setAttribute("error",`response${nbrResponse}`);
        input.setAttribute("class","response");
        label.setAttribute("for",`id${nbrResponse}`);
        divErrorQuestion.id = `response${nbrResponse}`;
        label.textContent = `Reponse ${nbrResponse}`;
        response_container.appendChild(label);
        response_container.appendChild(input);
        if (selectElt.value != "text")
            response_container.appendChild(inputType);
        response_container.appendChild(deleteIcone);
        response_container.appendChild(divErrorQuestion);
        container.appendChild(response_container);
        nbrResponse++;
    }else {
        if(selectElt.hasAttribute("error")){
            let error = selectElt.getAttribute("error");
            let divElt = document.querySelector("#"+error);
            divElt.textContent = "Veuillez choisir le type de reponse";
        }
    }
})
