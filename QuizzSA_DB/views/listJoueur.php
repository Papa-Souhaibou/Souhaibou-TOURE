<div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Modifier le status du joueur</h1>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                <form action="../models/setPlayers.php" class="form" id="setForm" method="post">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status </label>
                        <div class="col-sm-9">
                            <select class="mdb-select md-form form-control questionField" name="status" id="type">
                                <option value="" disabled selected>Donnez le status</option>
                                <option value="" id="status"></option>
                            </select>
                            <small class="text-danger"></small>
                        </div>
                    </div>
                    <button type="submit" name="submit" id="" class="btn float-right btn-success">Enregistrer</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
<div class="" id="_listJoueur">
  <div class="col-12 mt-3 mb-3 mr-auto ml-auto">
    <div class="card bg bg-secondary">
      <div class="card-body" id="listJoueurContainer">
        <h3 class="card-title text-center">Liste Joueur</h3>
        <table class="table mb-3">
            <thead>
                <tr>
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Score</th>
                    <th scope="col">Status</th>
                    <th scope="col">Modifier</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div class="row d-flex justify-content-around">
            <button type="button" name="" id="previous" class="btn btn-success btn-lg ">Precedent</button>
            <button type="button" name="" id="next" class="btn btn-success btn-lg ">Suivant</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(function () { 
        const tbody = $("tbody");
        const rowPerPage = 15;
        let currentPage = 1;
        let idPlayer;
        const getUser = (url,limit,offset=15) => {
            const send = new FormData();
            const xhr = new XMLHttpRequest();
            send.append("limit",limit);
            send.append("offset",offset);
            xhr.open("POST", url, false);
            xhr.send(send);
            return JSON.parse(xhr.responseText);
        }
        const insertUser = (wrapper,user) => {
            const trElt = document.createElement("tr");
            const modifColElt = document.createElement("td");
            trElt.id = user.idJoueur;
            for (const key in user) {
                const tdElt = document.createElement("td");
                if(key == "prenomJoueur"){
                    $(tdElt).text(`${user[key]}`);
                    $(trElt).append(tdElt);
                }else if(key === "nomJoueur"){
                    $(tdElt).text(`${user[key]}`);
                    $(trElt).append(tdElt);
                }else if(key == "statusJoueur"){
                    $(tdElt).text(`${user[key]}`);
                    $(trElt).append(tdElt);
                }else if(key == "scoreJoueur"){
                    $(tdElt).text(`${user[key]}`);
                    $(trElt).append(tdElt);
                }
                
            }
            $(modifColElt).html(
                `
                    <img src="../img/ic-liste-active.png" alt="modif" title="Modifier les status du joueur" id="set" class="mr-3">
                    <img src="../img/ic-supprimer.png" alt="del" title="Supprimer ce joueur" id="delete">
                `
            );
            const setElt = modifColElt.querySelector("#set");
            const deleteElt = modifColElt.querySelector("#delete");
            $(setElt).on("click", function (event) {
                const idJoueur = this.parentElement.parentElement.id;
                idPlayer = idJoueur;
                const confirm = window.confirm("voulez vous vraiment modifier le status de ce joueur ?");
                if(confirm){
                    const playerStuatus = getUserStatus(idJoueur) == "actif" ? "bloque" : "actif";
                    $("#status").attr("value", playerStuatus);
                    $("#status").text(playerStuatus);
                    $('#modal').modal('toggle');
                }
            });
            $(deleteElt).on("click", function (event) {
                const idJoueur = this.parentElement.parentElement.id;
                const confirm = window.confirm("voulez vous vraiment supprimer ce joueur ?");
                if(confirm){
                    deletePlayer(idJoueur);
                }
            });
            $(trElt).append(modifColElt);
            
            wrapper.append(trElt);
        };
        const displayUser = users => {
            for (const user of users) {
                insertUser(tbody,user);
            }
        };
        const deletePlayer = idPlayer => {
            const xhr = new XMLHttpRequest;
            const data = new FormData();
            data.append("delete","");
            data.append("idPlayer",idPlayer);
            xhr.open("POST","../models/setPlayers.php");
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200){
                    tbody.html("");
                    const users = getUser("../models/getUsers.php",currentPage + rowPerPage - 1);
                    displayUser(users);
                }
            };
            xhr.send(data);
        };
        const modifyUserStatus = (idPlayer,status) => {
            event.preventDefault();
            const formulaire = document.querySelector("#setForm");
            const hasHiddenInput = formulaire.querySelector("input[type=hidden]");
            if(!hasHiddenInput){
                const hiddenInputElt = document.createElement("input");
                hiddenInputElt.type = "hidden";
                hiddenInputElt.setAttribute("name","idPlayer");
                hiddenInputElt.setAttribute("value",idPlayer);
                formulaire.insertBefore(hiddenInputElt,formulaire.querySelector("button"));
            }
            $.ajax({
                type: "POST",
                url: "../models/setPlayers.php",
                data: $("#setForm").serialize(),
                success: function (response) {
                    tbody.html("");
                    const users = getUser("../models/getUsers.php",currentPage);
                    displayUser(users);
                }
            });
        };
        const getUserStatus = idJoueur => {
            for (const user of users) {
                if(user["idJoueur"] == idJoueur){
                    return user["statusJoueur"];
                }
            }
        };
        const showError = (element, message) => {
            element.nextElementSibling.textContent = message;
        };
        const users = getUser("../models/getUsers.php",currentPage,rowPerPage);
        let number = getUser("../models/userNumber");
        let numberOfPage = Math.ceil(number.number / rowPerPage);
        
        $("#setForm").on("submit", function (event) {
            event.preventDefault();
            const select = this.querySelector("select");
            if(!select.value){
                showError(select,"Ce champs est obligatoire.");
            }else{
                modifyUserStatus(idPlayer,select.value);
            }
        });

        $("#previous").on("click", function () {
            if(currentPage <= 1){
                currentPage = 1;
                $("#previous").attr("disabled", "disabled");
                $("#next").removeAttr("disabled");
            }else{
                currentPage--;
                $("#previous").removeAttr("disabled");
            }
            let limit = currentPage - rowPerPage - 1;
            limit = limit > 0 ? limit: 1;
            // const offset = limit + rowPerPage;
            const users = getUser("../models/getUsers.php",limit);
            tbody.html("");
            displayUser(users);
        });
        $("#next").on("click", function () {
            if(currentPage == numberOfPage){
                $("#next").attr("disabled", "disabled");
            }else{
                $("#next").removeAttr("disabled");
            }
            if(currentPage >= numberOfPage){
                numberOfPage = numberOfPage;
            }else{
                currentPage++;
            }
            $("#previous").removeAttr("disabled");
            const limit = currentPage + rowPerPage - 1;
            const offset = limit + rowPerPage;
            const users = getUser("../models/getUsers.php",limit);
            tbody.html("");
            displayUser(users);
        });
        tbody.html("");
        displayUser(users);
    })
</script>