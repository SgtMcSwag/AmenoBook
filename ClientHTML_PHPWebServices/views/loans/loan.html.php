
<?php if($loan==""){?>
    <div class="row" style="height: 100vh;margin-bottom:0">
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/loans/add')?>">
            <h4 class="green-text">Ajout d'une catégorie</h4>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="duration" name="duration" required type="number" class="">
                    <label for="duration">Durée</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="startdate" name="startdate" required class="datepicker" type="date">
                    <label for="startdate">Date de début</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="isreturned" required name="isreturned">
                        <option value="false" selected>en attente</option>
                        <option value="true" >rendu</option>
                    </select>
                    <label for="isreturned">&Eacute;tat</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="libraryuser" required name="libraryuser">
                        <option value="" disabled selected>Choisir un utilisateur</option>
                        <?php if($_SESSION['isAdmin'] == true){?>
                            <?php foreach (json_decode($users) as $user){?>
                                <option value="<?php echo $user->id?>"><?php echo $user->login?></option>
                            <?php }?>
                        <?php }else{?>
                            <option value="<?php echo $_SESSION['userId']?>"><?php echo $_SESSION['login']?></option>
                        <?php }?>
                    </select>
                    <label for="libraryuser">Utilisateur</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="book" required name="book">
                        <option value="" disabled selected>Choisir un livre</option>
                        <?php foreach (json_decode($books) as $book){?>
                            <option value="<?php echo $book->id?>"><?php echo $book->title?></option>
                        <?php }?>
                    </select>
                    <label for="book">Livre</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Ajouter</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
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
        <?php $loan = json_decode($loan);?>
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/loans/update/'.$loan->id)?>">
            <h4 class="green-text">Mise à jour des données du prêt de <?php echo $loan->borrowedBook->title ?> à <?php echo $loan->user->login ?></h4>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="duration" name="duration" value="<?php echo $loan->duration?>" required type="number" class="">
                    <label for="duration">Durée</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="startdate" name="startdate" required class="datepicker" type="date">
                    <label for="startdate">Date de début</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="isreturned" required name="isreturned">
                        <option value="false" <?php if(!isset($loan->isReturned)&& $loan->isReturned!="true"){?>selected<?php }?>>en attente</option>
                        <option value="true" <?php if(!isset($loan->isReturned)&& $loan->isReturned=="true"){?>selected<?php }?>>rendu</option>
                    </select>
                    <label for="isreturned">&Eacute;tat</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="libraryuser" required name="libraryuser">
                        <?php if($_SESSION['isAdmin'] == true){?>
                            <option value="" disabled <?php if($loan->user->id==""){?>selected<?php }?>>Choisir un utilisateur</option>
                            <?php foreach (json_decode($users) as $user){?>
                                <option value="<?php echo $user->id?>" <?php if($loan->user->id==$user->id){?>selected<?php }?>><?php echo $user->login?></option>
                            <?php }?>
                        <?php }else{?>
                            <option value="<?php echo $_SESSION['userId']?>"><?php echo $_SESSION['login']?></option>
                        <?php }?>
                    </select>
                    <label for="libraryuser">Utilisateur</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="book" required name="book">
                        <option value="" disabled <?php if($loan->book->id==""){?>selected<?php }?>>Choisir un livre</option>
                        <?php foreach (json_decode($books) as $book){?>
                            <?php var_dump($book)?>
                            <option value="<?php echo $book->id?>" <?php if($loan->book->id==$book->id){?>selected<?php }?>><?php echo $book->title?></option>
                        <?php }?>
                    </select>
                    <label for="book">Livre</label>
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
            picker.set('select', '<?php echo date_format(date_timestamp_set(date_create(),substr($loan->startDate,0,10)),"Y-m-d")?>', { format: 'yyyy-mm-dd' })
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
