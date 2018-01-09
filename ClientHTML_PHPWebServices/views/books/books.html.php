
<div class="row col s12" style="height: 96%">
    <h3 class="green-text center">Livres</h3>
    <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?><a class="btn-floating btn-large waves-effect waves-light right green" style="top:10px; right:10px; position: fixed;" href="<?php echo url_for('/books/add')?>"><i class="fa fa-plus"></i></a><?php }?>
    <?php if(empty(json_decode($books))){?>
        <div class="valign-wrapper" style="height: 100%">
            <div class="row center-align">
                <h2 class="col s12">Aucune données pour le moment</h2>
            </div>
        </div>
    <?php }else{ ?>

    <?php foreach (json_decode($books) as $book){?>
        <div class="col s12 m6">
            <div class="card sticky-action">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" style="margin: 0 auto; max-height: 200px; width: auto" src="./public/images/book.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4 valign-wrapper" style="display: flex; justify-content: space-around"><i class="fa fa-book left"></i> <?php echo $book->title ?><i class="fa fa-ellipsis-v right"></i></span>
                    <p class="">Date de publication : <?php echo date("d/m/Y",strtotime(substr($book->publicationDate,0,19)))?></p>
                    <!--<p class="">Date de publication : <?php echo date_format(date_timestamp_set(date_create(),substr($book->publicationDate,0,10)),"d/m/Y")?></p>!-->
                    <p class="">ISBN : <?php echo $book->isbn ?></p>
                    <p class="">Quantité : <?php echo $book->quantity ?></p>
                </div>
                <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){?>
                    <div class="card-action"  style="display: flex; justify-content: space-around">
                        <a class="btn waves-light light-green white-text" href="<?php echo url_for('/books/'.$book->id) ?>">Modifier</a>
                        <?php if(isset($book->category)){?><a class="btn waves-light orange white-text truncate" href="<?php echo url_for('/categories/'.$book->category->id)?>">Catégorie <?php echo $book->category->name?></a><?php } ?>
                        <a class="btn waves-light red white-text" href="<?php echo url_for('/books/delete/'.$book->id) ?>">Supprimer</a>
                    </div>
                <?php }else{?>
                    <div class="card-action"  style="display: flex; justify-content: space-around">
                        <?php if(isset($book->category)){?><a class="btn waves-light orange white-text" href="<?php echo url_for('/categories/'.$book->category->id)?>">Catégorie <?php echo $book->category->name?></a><?php } ?>
                    </div>
                <?php }?>

                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Résumé <i class="fa fa-remove right"></i></span>
                    <p><?php echo $book->resume ?></p>
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
