<div class="row" style="height: 100vh;margin-bottom:0">
    <form class="col s12 center valign" method="POST" action="<?php echo url_for('/register')?>">
        <h4 class="green-text">Ajout d'un Utilisateur</h4>
        <input type="hidden" name="lastconnection" value="01/01/1970">
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="firstname" name="firstname" required type="text" class="">
                <label for="firstname">Prénom</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="lastname" name="lastname"required type="text" class="">
                <label for="lastname">Nom</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="email" name="email" type="email" required class="">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="birthdate" name="birthdate" required type="date" class="datepicker">
                <label for="birthdate">Date de naissance</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="login" name="login" type="text" class="">
                <label for="login">Login</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="password" name="password" type="password" class="">
                <label for="password">Mot de passe</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <select id="gender" name="gender">
                    <option value="male" selected>Homme</option>
                    <option value="female" >Femme</option>

                </select>
                <label for="gender">Genre</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <select id="accountstate" name="accountstate">
                    <option value="0" selected>Actif</option>
                    <option value="1" >Bloqué</option>
                </select>
                <label for="accountstate">Statut du Compte</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <select id="isadmin" name="isadmin">
                    <option value="true" selected>Oui</option>
                    <option value="false" >Non</option>
                </select>
                <label for="accountstate">Administrateur</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="profilepicture" name="profilepicture" type="text" class="">
                <label for="profilepicture">Photo du profil (fictif)</label>
            </div>
        </div>
        <a class="btn waves-effect waves-light light-green darken-4 row center" href="<?php echo url_for('/login')?>" name="action">
            <i class="fa fa-arrow-left"></i> Retour sur la page de connexion
        </a>
        <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Ajouter</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#about').trigger('autoresize');

    }, false);
</script>
<?php if(flash_now("error")=="inconnu"){?>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            Materialize.toast('Erreur survenue', 4000)
        }, false);
    </script>
<?php } ?>