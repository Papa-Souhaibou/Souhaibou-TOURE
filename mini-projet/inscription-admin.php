<div id="left">
    <h1>S'INSCRIRE</h1>
    <p>Pour tester votre niveau de culture generale</p>
    <br>
    <hr>
    <form action="inscription_control.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="firstname">Prenom</label><br>
            <input type="text" class="admin-input-field" name="firstname" id="firstname">
        </div>
        <div>
            <label for="lastname">Nom</label><br>
            <input type="text" class="admin-input-field" name="lastname" id="lastname">
        </div>
        <div>
            <label for="login">login</label><br>
            <input type="text" class="admin-input-field" name="login" id="login">
        </div>
        <div>
            <label for="password">Password</label><br>
            <input type="password" class="admin-input-field" name="password" id="password">
        </div>
        <div>
            <label for="co-password">Confirmer Password</label><br>
            <input type="password" class="admin-input-field" name="co-password" id="co-password">
        </div>
        <div class="file-container">
            <label for="avatar">Avatar</label>
            <input type="file" class="admin-file-upload" name="avatar" id="avatar">
        </div>
        <button type="submit" class="admin-btn">Creer Compte</button>
    </form>
</div>
<div id="right">
    <div id="bottom"></div>
    <div id="circle">
    </div>
    <h2>Avatar du joueur</h2>
</div>