const contents = document.querySelectorAll("#displays-pages > div");
for (const content of contents) {
    content.style.display = "none";
}
const menu = document.querySelectorAll("#setting-items > a");
for (const item of menu) {
    item.addEventListener("click", event => {
        for (const content of contents) {
            content.style.display = "none";
        }
        for(const a of menu){
            const aClass = a.classList[0];
            a.setAttribute("class",aClass);
        }
        const itemPreviousClass = event.target.getAttribute("class");
        if(itemPreviousClass === "add"){
            event.target.setAttribute("class",itemPreviousClass+" active add-active");
        }else if(itemPreviousClass === "list"){
            event.target.setAttribute("class",itemPreviousClass+" active list-active");
        }
        const displayDivId = event.target.getAttribute("href");
        let displayValue = "block";
        if(displayDivId === "#create"){
            displayValue = "flex";
        }
        const displayDiv = document.querySelector(displayDivId);
        displayDiv.style.display = displayValue;
    });
}

window.addEventListener("load", event => {
    for (const content of contents) {
        content.style.display = "none";
    }
    const href = window.location.href.split("#")[1] || "liste-question";
    const showContent = document.querySelector("#"+href);
    if (href === "create") {
        showContent.style.display = "flex";
    }else
        showContent.style.display = "block";
});

const number_form = document.querySelector("#number-form");
const submitButtonNumber = number_form.querySelector("button[type=submit]");
const input_field = number_form.querySelector("input");
input_field.addEventListener("input", event => {
    const div = number_form.querySelector("#"+input_field.getAttribute("error"));
    div.textContent = "";
});
submitButtonNumber.addEventListener("click",event => {
    const input = number_form.querySelector("input");
    const div = number_form.querySelector("#"+input.getAttribute("error"));
    if(!input.value){
        div.textContent = "Ce champs est obligatoire";
        event.preventDefault();
    }
    else if(parseInt(input.value) < 5){
        div.textContent = "Le nombre de questions par jeu doit etre superieur ou egal a 5";
        event.preventDefault();
    }
});