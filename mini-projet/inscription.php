<div id="create">
    <div id="left">
        <h1>S'INSCRIRE</h1>
        <p>
            <?php
                if(isset($_SESSION["login"])){
                    echo "Pour proposer des quizz";
                }else{
                    echo "Pour tester votre niveau de culture generale";
                }
            ?>
        </p>
        <br>
        <hr>
        <form action="inscription_control.php" method="post" enctype="multipart/form-data" id="register-form">
            <div class="register-input-form">
                <label for="">Prenom</label>
                <input type="text" class="register-input-field" error="firstname" name="firstname">
                <div id="firstname" class="error-form"></div>
            </div>
            <div class="register-input-form">
                <label for="">Nom</label>
                <input type="text" class="register-input-field" error="lastname" name="lastname">
                <div id="lastname" class="error-form"></div>
            </div>
            <div class="register-input-form">
                <label for="">Login</label>
                <input type="text" class="register-input-field" error="login" name="login">
                <div id="login" class="error-form">
                <?php
                    if(isset($_SESSION["errors"]["login"])){
                        echo $_SESSION["errors"]["login"];
                        unset($_SESSION["errors"]["login"]);
                    }
                ?>
                </div>
            </div>
            <div class="register-input-form">
                <label for="">Password</label>
                <input type="password" class="register-input-field" error="password" name="password">
                <div id="password" class="error-form"></div>
            </div>
            <div class="register-input-form">
                <label for="">Confirmer Password</label>
                <input type="password" class="register-input-field" error="co-password" name="co-password">
                <div id="co-password" class="error-form">
                <?php
                    if(isset($_SESSION["errors"]["password"])){
                        echo $_SESSION["errors"]["password"];
                        unset($_SESSION["errors"]["password"]);
                    }
                ?>
                </div>
            </div>
            <div class="register-input-form">
                <label for="" class="in-line">Avatar</label>
                <input type="file" class="avatar-file" error="avatar" name="avatar">
                <div id="avatar" class="error-form">
                <?php
                    if(isset($_SESSION["errors"]["avatar"])){
                        echo $_SESSION["errors"]["avatar"];
                        unset($_SESSION["errors"]["avatar"]);
                    }
                ?>
                </div>
            </div>
            <button type="submit" class="btn-register">Creer compte</button>
        </form>
    </div>
    <div id="right">
        <div id="circle-avatar">
        </div>
        <h2>
            <?php
                if(isset($_SESSION["login"])){
                    echo "Avatar Admin";
                }else{
                    echo "Avatar du joueur";
                }
            ?>
        </h2>
    </div>
</div>