<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-10">
            <h1>Créer un nouveau billet</h1>
        </div>
        <div class="col-sm-2 col-md-2">
            <a class="btn btn-info" href="?p=adminposthome"><< Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">

            <form method="post">
                <div class="form-group">
                    <label for="titre">Titre : </label>
                    <input class="form-control" type="text" name="titre" required="required" />
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu : </label>
                    <textarea class="form-control" name="contenu" rows="3" required="required"></textarea>
                </div>
                <div class="checkbox">
                    <label for="isonline">
                        <input type="checkbox" name="isonline" checked="checked" required="required"/> <b>Online ?</b>
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                        <input type="submit" class="btn btn-info" name="submit" value="Ajouter" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
