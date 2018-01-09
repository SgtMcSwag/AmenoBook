
<div class="row col s12" style="height: 96%">
    <h3 class="green-text center">Emprunts</h3>
    <a class="btn-floating btn-large waves-effect waves-light right green" style="top:10px; right:10px; position: fixed;" href="<?php echo url_for('/loans/add')?>"><i class="fa fa-plus"></i></a>
    <?php if(empty(json_decode($loans))){?>
        <div class="valign-wrapper" style="height: 100%">
            <div class="row center-align">
                <h2 class="col s12">Aucune données pour le moment</h2>
            </div>
        </div>
    <?php }else{ ?>

    <?php foreach (json_decode($loans) as $loan){?>
        <?php if($_SESSION['isAdmin'] == true || $_SESSION['userId'] == $loan->user->id){?>
        <div class="col s12 m6">
            <div class="card sticky-action">
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4 valign-wrapper" style="display: flex; justify-content: space-around">Emprunt de <?php echo $loan->borrowedBook->title?> par <?php echo $loan->user->login?></span>
                    <p>Date de début : <?php echo date("d/m/Y",strtotime(substr($loan->startDate,0,19)))?></p>
                    <p>Durée : <?php echo $loan->duration ?></p>
                    <p>&Eacute;tat : <?php echo ($loan->isReturned)?"rendu":"en attente" ?></p>
                </div>
                <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?>
                    <div class="card-action"  style="display: flex; justify-content: space-around">
                        <a class="btn waves-light light-green white-text" href="<?php echo url_for('/loans/'.$loan->id) ?>">Modifier</a>
                        <a class="btn waves-light red white-text" href="<?php echo url_for('/loans/delete/'.$loan->id) ?>">Supprimer</a>
                    </div>
                <?php }?>
            </div>
        </div>
    <?php } ?>
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
