
<?php if($category==""){?>
    <div class="row" style="height: 100vh;margin-bottom:0">
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/categories/add')?>">
            <h4 class="green-text">Ajout d'une catégorie</h4>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="name" name="name" required type="text" class="">
                    <label for="name">Nom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <textarea id="description" name="description" required class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Ajouter</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#description').trigger('autoresize');
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
        <?php $category = json_decode($category);?>
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/categories/update/'.$category->id)?>">
            <h4 class="green-text">Mise à jour des données de <?php echo $category->name ?></h4>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="name" name="name" required value="<?php echo $category->name ?>" type="text" class="">
                    <label for="name">Nom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <textarea id="description" name="description" value="<?php echo $category->description ?>" required class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Modifier</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#description').val('<?php echo $category->description ?>');
            $('#description').trigger('autoresize');
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
