
<?php if($author==""){?>
    <div class="row" style="height: 100vh;margin-bottom:0">
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/authors/add')?>">
            <h4 class="green-text">Ajout d'un auteur</h4>
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
                    <input id="nationality" name="nationality" type="text" class="">
                    <label for="nationality">Nationalité</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <textarea id="about" name="about" required class="materialize-textarea"></textarea>
                    <label for="about">&Agrave; propos de </label>
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
                    <select id="type" name="type">
                        <option value="0" selected>Principal auteur</option>
                        <option value="1" >Co-auteur</option>
                    </select>
                    <label for="type">Type</label>
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
    <?php $author = json_decode($author);?>
    <form class="col s12 center valign" method="POST" action="<?php echo url_for('/authors/update/'.$author->id)?>">
        <h4 class="green-text">Mise à jour des données de <?php echo $author->firstName . ' ' . $author->lastName ?></h4>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="firstname" name="firstname" value="<?php echo $author->firstName?>" required type="text" class="">
                <label for="firstname">Prénom</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="lastname" name="lastname" value="<?php echo $author->lastName?>" required type="text" class="">
                <label for="lastname">Nom</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="email" name="email" value="<?php echo $author->email?>" type="email" required class="">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="birthdate" name="birthdate" value="<?php echo $author->birthDate?>" type="date" class="datepicker">
                <label for="birthdate">Date de naissance</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="nationality" name="nationality" value="<?php echo $author->nationality?>" type="text" class="">
                <label for="nationality">Nationalité</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <textarea id="about" name="about" required value="<?php echo $author->about?>" class="materialize-textarea"></textarea>
                <label for="about">&Agrave; propos de </label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <select id="gender" name="gender">
                        <option value="male" <?php if(!isset($author->gender)&& $author->gender!="female"){?>selected<?php }?>>Homme</option>
                        <option value="female" <?php if(isset($author->gender)&& $author->gender=="female"){?>selected<?php }?>>Femme</option>

                </select>
                <label for="gender">Genre</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <select id="type" name="type">
                    <option value="0" <?php if(!isset($author->type)&& $author->type!="COAUTHOR"){?>selected<?php }?>>Principal auteur</option>
                    <option value="1" <?php if(isset($author->type)&& $author->type=="COAUTHOR"){?>selected<?php }?>>Co-auteur</option>
                </select>
                <label for="type">Type</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m4 offset-m4 s12">
                <input id="profilepicture" name="profilepicture" value="<?php echo $author->profilePicture?>" type="text" class="">
                <label for="profilepicture">Photo du profil (fictif)</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Modifier</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#about').val('<?php echo $author->about ?>');
        $('#about').trigger('autoresize');
        var $input = $('.datepicker').pickadate({
            format: 'dd/mm/yyyy'
        })

        var picker = $input.pickadate('picker')
        picker.set('select', '<?php echo date("Y-m-d",strtotime(substr($author->birthDate,0,19)))?>', { format: 'yyyy-mm-dd' })
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
