$(function() {
    $("#loginForm").on("submit", function (event) {
        event.preventDefault();
        const userLogin = $("#login").val();
        const userPassword = $("#password").val();
        let hasError = false
        $("#loginForm input").each(function (index) {
            $(this).on("input", function () {
                showError(this, "");
            });
            const login = this.value;
            if(!login){
                hasError = true;
                showError(this, "Ce champs est obligatoire")
            }
        });
        if(!hasError){
            const xhr = new XMLHttpRequest();
            let form = document.querySelector("#loginForm");
            form = new FormData(form);
            xhr.open("POST","models/getUsers.php");
            xhr.onreadystatechange = () => {
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status == 200){
                        const player = JSON.parse(xhr.responseText);
                        if(player["error"]){
                            showError(document.querySelector("#login"),"Compte innexistant");
                        }else{
                            if(player["passwordJoueur"]){
                                if(player["passwordJoueur"] == userPassword){
                                    $("#loginForm").unbind("submit").submit();
                                }else{
                                    showError(document.querySelector("#password"),"Mot de passe incorrecte");
                                }
                            } else if (player["passwordAdmin"]){
                                if(player["passwordAdmin"] == userPassword){
                                    $("#loginForm").unbind("submit").submit();
                                }else{
                                    showError(document.querySelector("#password"),"Mot de passe incorrecte");
                                }
                            }
                        }
                        
                    }
                }
            };
            xhr.send(form);
        }
    });
    $("#subscribeForm").on("submit", function (event) {
        event.preventDefault();
        const userLogin = $("#inputLogin").val();
        const userPassword = $("#inputPassword").val();
        let hasError = false;
        $("#subscribeForm input").each(function () {
            $(this).on("input", function () {
                showError(this, "");
            });
            const value = this.value;
            if(!value){
                hasError = true;
                showError(this,"Ce champs est obligatoire");
            }else{
                if(this.type == "password" && this.value != userPassword){
                    hasError = true;
                    showError(this, "Les deux mot de passe ne correspondent pas.")
                }
            }
        });
        if(!hasError){
            const xhr = new XMLHttpRequest();
            let form = document.querySelector("#subscribeForm");
            form = new FormData(form);
            xhr.open("POST","models/getUsersList.php");
            xhr.onreadystatechange = () => {
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status == 200){
                        const players = JSON.parse(xhr.responseText);
                        let isfound = false;
                        for (const player of players) {
                            if(player["loginJoueur"]){
                                if(player["loginJoueur"] == userLogin){
                                    isfound = true;
                                    showError(document.querySelector("#inputLogin"),"Ce compte existe deja.");
                                    return;
                                }
                            }else if(player["loginAdmin"]){
                                if(player["loginAdmin"] == userLogin){
                                    isfound = true;
                                    showError(document.querySelector("#inputLogin"), "Ce compte existe deja.");
                                    return;
                                }
                            }
                        }
                        if(!isfound){
                            $("#subscribeForm").unbind("submit").submit();
                        }
                    }
                }
            };
            xhr.send(form);
        }
    });
    $("#inputAvatar").change(function (e) { 
        e.preventDefault();
        if (this.type == "file") {
            let authorizedExtension = ["png", "jpeg", "jpg"];
            let fileExtension = this.value.split(".")[1];
            const avatarWidth = "200px";
            if (authorizedExtension.includes(fileExtension)) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(this.files[0]);
                fileReader.onloadend = event => {
                    $("#showAvatar").html(
                        `<img src=${event.target.result} width=${avatarWidth} height=${avatarWidth} alt=avatar/>`
                    );
                    $("#showAvatar").css("display", "block");
                };
            } else {
                hasError = true;
                showError(this, "Veuillez uploader une image");
            }
        }
    });
    const showError = (element,message) => {
        element.nextElementSibling.textContent = message;
    };
    $(window).on('resize', function () {
        var win = $(this); //this = window
        const avatar = document.querySelector("#showAvatar");
        if (win.width() <= 990) { 
            avatar.parentNode.style.display = "none";
        }else{
            avatar.parentNode.style.display = "block";
        }
    });
});