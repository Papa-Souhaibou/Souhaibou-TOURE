const submitButton = document.querySelector("#connexion");
const url = "js/database.json";
const xhr = new XMLHttpRequest();
submitButton.addEventListener("click",(event) => {
    event.preventDefault();
    xhr.onreadystatechange = validate;
    xhr.open("POST",url);
    xhr.send();
});
const validate = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            const login = document.getElementsByName("login").value;
            const password = document.getElementsByName("password").value;
            const content =JSON.parse(xhr.responseText);
            // for (let users in content) {
            //    for (const iterator in users) {
            //        console.log(iterator);
            //    }
            // }
            
            console.log(content.length);
        }
    }
};