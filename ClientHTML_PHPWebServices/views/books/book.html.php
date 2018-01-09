
<?php if($book==""){?>
    <div class="row" style="height: 100vh;margin-bottom:0">
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/books/add')?>">
            <h4 class="green-text">Ajout d'un livre</h4>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="title" name="title" required type="text" class="">
                    <label for="title">Titre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <textarea id="resume" name="resume" required class="materialize-textarea"></textarea>
                    <label for="resume">Résumé</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="isbn" name="isbn" type="text" required class="">
                    <label for="isbn">ISBN</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="quantity" name="quantity" required type="number" class="">
                    <label for="quantity">Quantité</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="picture" name="picture" type="text" class="">
                    <label for="picture">Couverture (fictif)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="publicationdate" required name="publicationdate" required type="date" class="datepicker">
                    <label for="publicationdate">Date de publication</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="category_id" required name="category_id">
                        <option value="" disabled selected>Choisir une catégorie</option>
                        <?php foreach (json_decode($categories) as $category){?>
                            <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                        <?php }?>

                    </select>
                    <label for="category">Catégorie</label>
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
        <?php $book = json_decode($book);?>
        <form class="col s12 center valign" method="POST" action="<?php echo url_for('/books/update/'.$book->id)?>">
            <h4 class="green-text">Mise à jour des données de <?php echo $book->title?></h4>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="title" name="title" value="<?php echo $book->title?>" required type="text" class="">
                    <label for="title">Titre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <textarea id="resume" name="resume" required class="materialize-textarea"></textarea>
                    <label for="resume">Résumé</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="isbn" name="isbn" type="text" value="<?php echo $book->isbn?>" required class="">
                    <label for="isbn">ISBN</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="quantity" name="quantity" required value="<?php echo $book->quantity?>" type="number" class="">
                    <label for="quantity">Quantité</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 value="<?php echo $book->picture?>" s12">
                    <input id="picture" name="picture" type="text" class="">
                    <label for="picture">Couverture (fictif)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <input id="publicationdate" required name="publicationdate" required type="date" class="datepicker">
                    <label for="publicationdate">Date de publication</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m4 offset-m4 s12">
                    <select id="category_id" required name="category_id">
                        <option value="" disabled >Choisir une catégorie</option>
                        <?php foreach (json_decode($categories) as $category){?>
                            <option value="<?php echo $category->id?>" <?php if($category->id == $book->category->id){?>selected<?php } ?> ><?php echo $category->name?></option>
                        <?php }?>

                    </select>
                    <label for="category">Catégorie</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light light-green row center" type="submit" name="action">Modifier</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('#resume').val('<?php echo $book->resume ?>');
            $('#resume').trigger('autoresize');
            var $input = $('.datepicker').pickadate({
                format: 'dd/mm/yyyy'
            })

            var picker = $input.pickadate('picker')
            picker.set('select', '<?php echo date("Y-m-d",strtotime(substr($book->publicationDate,0,19)))?>', { format: 'yyyy-mm-dd' })
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
