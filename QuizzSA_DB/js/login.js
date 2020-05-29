$(function() {
    $("#loginForm").on("submit", function (event) {
        event.preventDefault();
        const userLogin = $("#login").val();
        const userPassword = $("#password").val();
        $.ajax({
            type: "GET",
            url: "controllers/loginController.php",
            data: {
                ulogin: userLogin,
                upassword: userPassword
            },
            success: function (response) {
                let hasError = false
                $("#loginForm input").each(function (index) {
                    $(this).on("input", function () {
                        this.nextElementSibling.textContent = "";
                    });
                    const login = this.value;
                    if(!login){
                        hasError = true;
                        this.nextElementSibling.textContent = "Ce champs est obligatoire";
                    }
                });
                if(!hasError){
                    $("#loginForm").unbind('submit').submit();
                }

            },
            error: function (error) {
                console.log("error : "+error);
                
            }
        });
    });

    // const isPlayer(users,login){
    //     for (const user of users) {
    //         if()
    //     }
    // }
});