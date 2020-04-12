const submitButton = document.querySelector("#connexion");
const url = "js/database.json";
const xhr = new XMLHttpRequest();
const validate = () => {
    submitButton.addEventListener("click",(event) => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const login = document.querySelector("#login").value;
                const password = document.querySelector("#password").value;
                const errors = document.querySelector("#errors");
                errors.style.color = "red";
                errors.style.textAlign = "center";
                if (login === "" || password === ""){
                    event.preventDefault();
                    errors.textContent = "Tout les champs sont obligatoires.";
                }else{
                    const content =JSON.parse(xhr.responseText);
                    let is_this_user_in_admins_group = false;
                    let admins_length = content["admins"].length;
                    let users_lengtth = content["users"].length;
                    for (let i = 0; i < admins_length; i++) {
                        if(content["admins"][i]["login"] === login){
                            is_this_user_in_admins_group = true;
                            if(content["admins"][i]["password"] !== password){
                                errors.textContent = "Login et/ou mot de passe incorrecte.";
                                event.preventDefault();
                            }
                        }
                    }
                    let is_this_user_in_users_group = false;
                    if(!is_this_user_in_admins_group){
                        for (let i = 0; i < users_lengtth; i++) {
                            if(content["users"][i]["login"] === login){
                                is_this_user_in_users_group = true;
                                if (content["users"][i]["password"] !== password) {
                                    errors.textContent = "Login et/ou mot de passe incorrecte.";
                                    event.preventDefault();
                                }
                            }
                        }
                    }
                    if(!is_this_user_in_admins_group && !is_this_user_in_users_group){
                        errors.textContent = "Compte innexistant";
                        event.preventDefault();
                    }
    
                }
            }
        }
    });
};
xhr.onreadystatechange = validate;
xhr.open("POST",url);
xhr.setRequestHeader("X-Requested-With","xmlhttprequest");
xhr.send();