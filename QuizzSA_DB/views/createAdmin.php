<?php
  session_start();
  include_once("../models/databaseAccess.php");
  $admin = $adminManager->getAdmin($_SESSION["userLogin"]);
  $idAmin  = $admin->getIdAdmin();
?>
<div class="modal fade" id="subscribe-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="title">Inscription</h1>
        <button type="button" class="close" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body" id="msg">
        <form action="../controllers/subscribeController.php" class="form" id="subscribeForm" method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <div class="col-sm-8">
                <label for="inputLastname">Nom</label>
                <input type="text" class="form-control" id="inputLastname" name="lastname" placeholder="Nom" value="<?= @$_SESSION["lastname"] ?>">
                <small class="text-danger"></small>
                </div>
                <div class="col-sm-4">
                <div class="ml-4 showAvatar" id="showAvatar">

                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-8">
                <label for="inputfirstname">Prenom</label>
                <input type="text" class="form-control" name="firstname" id="inputfirstname" placeholder="Prenom" value="<?= @$_SESSION["firstname"] ?>">
                <small class="text-danger"></small>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-8">
                <label for="inputLogin">Login</label>
                <input type="text" class="form-control" name="login" id="inputLogin" placeholder="Login" value="<?= @$_SESSION["login"] ?>">
                <small class="text-danger"></small>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-8">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" value="<?= @$_SESSION["password"] ?>">
                <small class="text-danger"></small>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-8">
                <label for="inputConfirmPassword">Confirm Your Password</label>
                <input type="password" class="form-control" name="co-password" id="inputConfirmPassword" placeholder="Confirm Your Password" value="<?= @$_SESSION["coPassword"] ?>">
                <small class="text-danger"></small>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-8">
                <label for="inputAvatar">Avatar</label>
                <input type="file" name="avatar" class="form-control" id="inputAvatar">
                <small class="text-danger"></small>
              </div>
            </div>
            <div class="text-center col-sm-8">
              <button type="submit" class="btn mainBg btn-lg" name="submit" id="subscribtionSubmit">S'inscrire</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="col-12 ml-auto mr-auto mt-3 mb-3" id="_createAdmin">
    <div class="card rounded-lg">
      <div class="card-body">
        <h3 class="card-title text-center">Liste Admin</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Prenom</th>
              <th>Nom</th>
              <th>Login</th>
              <th>Modifier</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<script>
  $(function () {
    let idAdministrateur;
    const tbody = $("tbody");
    const getAdmins = () => {
      $.ajax({
          type: "POST",
          url: "../models/getUsersList.php",
          data: "admin=admin",
          dataType: "json",
          success: function (response) {
            tbody.html("");
            tbody.append(`
              <tr>
                <th></th>
                <th>Ajouter un Admin</th>
                <th><img src="../img/ic-ajout-reponse.png" alt="Ajouter un admin" id="addAdmin"></th>
                <th></th>
              </tr>
            `);
            for (const admin of response) {
              insertAdmin(tbody,admin);
            }
          }
      });
    };
    const showError = (element, message) => {
        element.nextElementSibling.textContent = message;
    };
    const resetForm = form => {
      const inputs = form.querySelectorAll("input");
      for (const input of inputs) {
        input.value = "";
      }
    };
    const insertAdmin = (wrapper,admin) => {
      const trElt = document.createElement("tr");
      const modifColElt = document.createElement("td");
      const idAdmin = admin.idAdmin;
      trElt.id = idAdmin;
      for (const key in admin) {
        const tdElt = document.createElement("td");
        if(key == "prenomAdmin"){
          $(tdElt).text(`${admin[key]}`);
          $(trElt).append(tdElt);
        }else if(key === "nomAdmin"){
          $(tdElt).text(`${admin[key]}`);
          $(trElt).append(tdElt);
        }else if(key == "loginAdmin"){
          $(tdElt).text(`${admin[key]}`);
          $(trElt).append(tdElt);
        }
          
      }
      $(modifColElt).html(
          `
            <img src="../img/ic-liste-active.png" alt="modif" title="Modifier cet admin" id="set" class="mr-3">
            <img src="../img/ic-supprimer.png" alt="del" title="Supprimer cet admin" id="delete">
          `
      );
      const setElt = modifColElt.querySelector("#set");
      const deleteElt = modifColElt.querySelector("#delete");
      $(setElt).on("click", function (event) {
          const confirm = window.confirm("voulez vous vraiment modifier cet admin ?");
          if(confirm){
            resetForm($("#subscribeForm").get(0));
            $("#title").text("Modifier un administrateur");
            $('#subscribe-modal').modal('toggle');
            $("#subscribtionSubmit").attr("type", "button");
            idAdministrateur = idAdmin;
          }
      });
      $(deleteElt).on("click", function (event) {
          const confirm = window.confirm("voulez vous vraiment supprimer cet admin ?");
          if(confirm){
              const adminId = "<?php echo $idAmin; ?>";
              if(adminId != idAdmin){
                deleteAdmin(idAdmin);
              }else{
                alert("Pour le momement vous ne pouvez pas supprimer votre propre compte");
              }
          }
      });
      $(trElt).append(modifColElt);
      
      wrapper.append(trElt);
    };
    const formSubscribtion = (modif,idAdmin) => {
      const userLogin = $("#inputLogin").val();
      const userPassword = $("#inputPassword").val();
      let hasError = false;
      $("#subscribeForm input").each(function () {
        $(this).on("input", function () {
          showError(this, "");
        });
        const value = this.value;
        if (!value) {
          hasError = true;
          showError(this, "Ce champs est obligatoire");
        } else {
          if (this.type == "password" && this.value != userPassword) {
            hasError = true;
            showError(this, "Les deux mot de passe ne correspondent pas.")
          }
        }
      });
      if (!hasError) {
        const xhr = new XMLHttpRequest();
        $("#subscribtionSubmit").attr("name", "submit");
        let form = document.querySelector("#subscribeForm");
        form = new FormData(form);
        xhr.open("POST", "../models/getUsersList.php");
        xhr.onreadystatechange = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
              const players = JSON.parse(xhr.responseText);
              let isfound = false;
              for (const player of players) {
                if (player["loginJoueur"]) {
                  if (player["loginJoueur"] == userLogin) {
                    isfound = true;
                    showError(document.querySelector("#inputLogin"), "Ce compte existe deja.");
                    return;
                  }
                } else if (player["loginAdmin"]) {
                  if (player["loginAdmin"] == userLogin) {
                    isfound = true;
                    showError(document.querySelector("#inputLogin"), "Ce compte existe deja.");
                    return;
                  }
                }
              }
              if (!isfound) {
                var form = new FormData(document.querySelector("#subscribeForm"));
                var avatar = document.querySelector("#inputAvatar");
                if(modif){
                  form.append("modifAdmin","modifAdmin");
                  form.append("idAdmin",idAdmin);
                }
                form.append("avatar",avatar.files[0]);
                form.append("submit","submit");
                $.ajax({
                  type: "POST",
                  url: "../controllers/subscribeController.php",
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form,
                  success: function (response) {
                    const msg = `
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> Cet administrateur a ete cree avec success.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    `;
                    $(msg).insertBefore("#subscribeForm");
                    getAdmins();
                  }
                });
                // $("#subscribeForm").unbind("submit").submit();
              }
            }
          }
        };
        xhr.send(form);
      }
    };
    const deleteAdmin = idAdmin => {
      const xhr = new XMLHttpRequest;
      const data = new FormData();
      data.append("deleteAdmin","delete");
      data.append("idAdmin",idAdmin);
      $.ajax({
        type: "POST",
        url: "../models/setPlayers.php",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        dataType: "dataType",
        success: function (response) {
          getAdmins();
        }
      });
    };
    $("#subscribeForm").on("submit", function (event) {
      event.preventDefault();
      formSubscribtion();
    });
    $("#inputAvatar").change(function (event) {
      event.preventDefault();
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
    $(window).on('resize', function () {
      var win = $(this); //this = window
      const avatar = document.querySelector("#showAvatar") || null;
      if(avatar){
        if (win.width() <= 990) {
          avatar.parentNode.style.display = "none";
        } else {
          avatar.parentNode.style.display = "block";
        }
      }
    });
    $("#addAdmin").on("click", function () {
      $("#title").text("Ajouter un administrateur");
      resetForm($("#subscribeForm").get(0));
      $("#subscribe-modal").modal("toggle");
    });
    $("#subscribtionSubmit").on("click", function () {
      formSubscribtion("modifAdmin",idAdministrateur);
      $("#subscribtionSubmit").attr("type", "submit");
    });
    getAdmins();
  });
</script>