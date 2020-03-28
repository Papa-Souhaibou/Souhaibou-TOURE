<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/create-compte.css">
    <title>Creation Compte</title>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div id="container">
        <div id="create">
            <div id="left">
                <h1>S'INSCRIRE</h1>
                <p>Pour tester votre niveau de culture generale</p>
                <br>
                <hr>
                <form action="" method="post">
                    <div>
                        <label for="prenom">Prenom</label><br>
                        <input type="text" class="input-field" name="prenom" id="prenom">
                    </div>
                    <div>
                        <label for="nom">Nom</label><br>
                        <input type="text" class="input-field" name="nom" id="nom">
                    </div>
                    <div>
                        <label for="login">login</label><br>
                        <input type="text" class="input-field" name="login" id="login">
                    </div>
                    <div>
                        <label for="pwd">Password</label><br>
                        <input type="password" class="input-field" name="pwd" id="pwd">
                    </div>
                    <div>
                        <label for="co-pwd">Confirmer Password</label><br>
                        <input type="password" class="input-field" name="co-pwd">
                    </div>
                    <div class="file-container">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="file-upload" name="avatar" id="avatar">
                    </div>
                    <button type="submit" class="btn">Creer Compte</button>
                </form>
            </div>
            <div id="right">
                <div id="bottom"></div>
                <div id="circle">

                </div>
                <h2>Avatar du joueur</h2>
            </div>
        </div>
    </div>
</body>
</html>