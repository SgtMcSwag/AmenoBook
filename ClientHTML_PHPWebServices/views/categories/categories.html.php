
<div class="row col s12" style="height: 96%">
    <h3 class="green-text center">Catégories</h3>
    <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?><a class="btn-floating btn-large waves-effect waves-light right green" style="top:10px; right:10px; position: fixed;" href="<?php echo url_for('/categories/add')?>"><i class="fa fa-plus"></i></a><?php }?>
    <?php if(empty(json_decode($categories))){?>
        <div class="valign-wrapper" style="height: 100%">
            <div class="row center-align">
                <h2 class="col s12">Aucune données pour le moment</h2>
            </div>
        </div>
    <?php }else{ ?>

    <?php foreach (json_decode($categories) as $category){?>
        <div class="col s12 m6">
            <div class="card sticky-action">
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4 valign-wrapper" style="display: flex; justify-content: space-around"><?php echo $category->name?></span>
                    <p><?php echo $category->description ?></p>
                </div>
                <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?>
                    <div class="card-action"  style="display: flex; justify-content: space-around">
                        <a class="btn waves-light light-green white-text" href="<?php echo url_for('/categories/'.$category->id) ?>">Modifier</a>
                        <a class="btn waves-light orange white-text" href="<?php echo url_for('/categories/'.$category->id.'/books')?>">Livres</a>
                        <a class="btn waves-light red white-text" href="<?php echo url_for('/categories/delete/'.$category->id) ?>">Supprimer</a>
                    </div>
                <?php }else{?>
                    <div class="card-action"  style="display: flex; justify-content: space-around">
                        <a class="btn waves-light orange white-text" href="<?php echo url_for('/categories/'.$category->id.'/books')?>">Livres associés</a>
                    </div>
                <?php }?>
            </div>
        </div>
    <?php } ?>
    <?php if(flash_now("error")=="suppression" || flash_now("error")=="inconnu"){?>
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                Materialize.toast('Erreur survenue', 4000)
            }, false);
        </script>
    <?php } ?>
    <?php } ?>
</div>
