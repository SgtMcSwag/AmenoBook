
<?php if($user==""){?>
    <div class="row" style="height: 100vh;margin-bottom:0">
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/users/add')?>">
            <h4 class="green-text">Ajout d'un Utilisateur</h4>
            <input type="hidden" name="lastconnection" value="<?php echo ($user->lastConnection!="")? date("d/m/Y",strtotime(substr($user->lastConnection,0,19))): "01/01/1970" ?>">
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
            <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Ajouter</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#about').trigger('autoresize');
            var $input = $('.datepicker').pickadate({
                format: 'dd/mm/yyyy'
            })
        }, false);
    </script>
    <?php if(flash_now("error")=="inconnu"){?>
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                Materialize.toast('Erreur survenue', 4000)
            }, false);
        </script>
    <?php } ?>
<?php }else{?>
    <div class="row" style="height: 100vh;margin-bottom:0">
        <?php $user = json_decode($user);?>
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/users/update/'.$user->id)?>">
            <?php if($_SESSION['userId']!=$user->id){?>
                <h4 class="green-text">Mise à jour des données de <?php echo $user->login?></h4>
            <?php } else{ ?>
                <h4 class="green-text">Mise à jour de vos données</h4>
            <?php } ?>
            <input type="hidden" name="lastconnection" value="<?php echo ($user->lastConnection!="")? date("d/m/Y",strtotime(substr($user->lastConnection,0,19))): "01/01/1970" ?>">
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="firstname" name="firstname" value="<?php echo $user->firstName?>" required type="text" class="">
                    <label for="firstname">Prénom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="lastname" name="lastname" value="<?php echo $user->lastName?>" required type="text" class="">
                    <label for="lastname">Nom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="email" name="email" type="email" value="<?php echo $user->email?>" required class="">
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
                    <input id="login" name="login" value="<?php echo $user->login?>" type="text" class="">
                    <label for="login">Login</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="password" name="password" value="<?php echo $user->password?>" type="password" class="">
                    <label for="password">Mot de passe</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="gender" name="gender">
                        <option value="male" <?php if(!isset($user->gender)&& $user->gender!="female"){?>selected<?php }?>>Homme</option>
                        <option value="female" <?php if(isset($user->gender)&& $user->gender=="female"){?>selected<?php }?>>Femme</option>
                    </select>
                    <label for="gender">Genre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="accountstate" name="accountstate">
                        <option value="0" <?php if(!isset($user->accountState)&& $user->accountState!="BLOCKED"){?>selected<?php }?>>Actif</option>
                        <option value="1" <?php if(isset($user->accountState)&& $user->accountState=="BLOCKED"){?>selected<?php }?>>Bloqué</option>
                    </select>
                    <label for="accountstate">Statut du Compte</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="isadmin" name="isadmin">
                        <option value="true" <?php if(!isset($user->isAdmin)&& $user->isAdmin=="false"){?>selected<?php }?>>Oui</option>
                        <option value="false" <?php if(isset($user->isAdmin)&& $user->isAdmin!="false"){?>selected<?php }?>>Non</option>
                    </select>
                    <label for="accountstate">Administrateur</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="profilepicture" name="profilepicture" value="<?php echo $user->profilePicture?>" type="text" class="">
                    <label for="profilepicture">Photo du profil (fictif)</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Modifier</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var $input = $('.datepicker').pickadate({
                format: 'dd/mm/yyyy'
            })

            var picker = $input.pickadate('picker')
            picker.set('select', '<?php echo date("Y-m-d",strtotime(substr($user->birthDate,0,19)))?>', { format: 'yyyy-mm-dd' })
        }, false);
    </script>
    <?php if(flash_now("error")=="inconnu"){?>
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                Materialize.toast('Erreur survenue', 4000)
            }, false);
        </script>
    <?php } ?>
<?php }?>
