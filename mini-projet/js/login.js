const inputs = document.getElementsByTagName("input");
const form = document.querySelector("#login-form") || document.querySelector("#register-form");
for (const input of inputs) {
    input.addEventListener("input",(event) => {
        if(event.target.hasAttribute("error")){
            const divId = event.target.getAttribute("error");
            document.querySelector("#" + divId).textContent = "";
        }
    });
}
const avatar = document.querySelector("input[type=file]");
if (avatar) {
    avatar.addEventListener("change", () => {
        let avatarWidth = "100%";
        const avatarReader = new FileReader();
        avatarReader.readAsDataURL(avatar.files[0]);
        avatarReader.onloadend = (event) => {
            const circle = document.querySelector("#circle");
            const img = document.createElement("img");
            img.setAttribute("src",event.target.result);
            img.style.width = avatarWidth;
            img.style.height = avatarWidth;
            circle.appendChild(img);
        }
    })

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