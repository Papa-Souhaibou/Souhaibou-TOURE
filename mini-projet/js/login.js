const inputs = document.getElementsByTagName("input");
const form = document.querySelector("#login-form");
for (const input of inputs) {
    input.addEventListener("input",(event) => {
        if(event.target.hasAttribute("error")){
            const divId = event.target.getAttribute("error");
            document.querySelector("#" + divId).textContent = "";
        }
    });
}
form.addEventListener("submit",(event) => {
    let error = false;
    for (const input of inputs) {
        if(!input.value){
            if(input.hasAttribute("error")){
                const divId = input.getAttribute("error");
                const div = document.getElementById(divId);
                div.textContent = "Ce champs est obligatoire.";
            }
            error = true;
        }
    }
    if (error) {
        event.preventDefault();
        
    }
});