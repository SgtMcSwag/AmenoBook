<div class="row col s12" style="height: 96%">
    <h3 class="green-text center">Auteurs</h3>
    <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?><a class="btn-floating btn-large waves-effect waves-light right green" style="top:10px; right:10px; position: fixed;" href="<?php echo url_for('/authors/add')?>"><i class="fa fa-plus"></i></a><?php }?>
    <?php if(empty(json_decode($authors))){?>
        <div class="valign-wrapper" style="height: 100%">
            <div class="row center-align">
                <h2 class="col s12">Aucune données pour le moment</h2>
            </div>
        </div>
<?php }else{ ?>


    <?php foreach (json_decode($authors) as $author){?>
        <div class="col s12 m6">
            <div class="card sticky-action">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" style="margin: 0 auto; max-height: 200px; width: auto" src="./public/images/test.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4 valign-wrapper" style="display: flex; justify-content: space-around"><?php if($author->gender == "female"){ ?><i class="fa fa-female left"></i><?php }else{ ?> <i class="fa fa-male left"></i> <?php } ?> <?php echo $author->firstName.' '.$author->lastName ?><i class="fa fa-ellipsis-v right"></i></span>
                    <p class="">Date de naissance : <?php echo date("d/m/Y",strtotime(substr($author->birthDate,0,19)))?></p>
                    <p class="">Email : <?php echo $author->email ?></p>
                    <p class="">Nationalité : <?php echo $author->nationality ?></p>
                    <p class="">Type : <?php echo $author->type ?></p>
                </div>
                <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?>
                <div class="card-action"  style="display: flex; justify-content: space-around">
                    <a class="btn waves-light light-green white-text" href="<?php echo url_for('/authors/'.$author->id) ?>">Modifier</a>
                    <a class="btn waves-light red white-text" href="<?php echo url_for('/authors/delete/'.$author->id) ?>">Supprimer</a>
                </div>
                <?php }?>

                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Description <i class="fa fa-remove right"></i></span>
                    <p><?php echo $author->about ?></p>
                </div>
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
