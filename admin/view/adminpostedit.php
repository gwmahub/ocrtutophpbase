
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-10">
            <h1>Modifier un billet</h1>
        </div>
        <div class="col-sm-2 col-md-2">
            <a class="btn btn-info" href="?p=adminposthome"><< Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <form method="post">
                <div class="form-group">
                    <label for="datecrea">Date création : </label>
                    <input class="form-control" type="text" readonly="readonly" name="datecrea required="required" value="<?php echo dateTimeUs2Fr($postDatas->date_creation); ?>"/>
                </div>
                <div class="form-group">
                    <label for="titre">Titre : </label>
                    <input class="form-control" type="text" name="titre" required="required" value="<?php echo stripslashes($postDatas->titre); ?>"/>
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu : </label>
                    <textarea class="form-control" name="contenu" rows="3" required="required"><?php echo stripslashes($postDatas->contenu); ?></textarea>
                </div>
                <div class="checkbox">
                    <label for="isonline">
                        <input type="checkbox" name="isonline" <?php echo $postDatas->is_online === '1'?'checked="checked"':''; ?> /> <b>Online ?</b>
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                        <input type="submit" class="btn btn-info" name="submit" value="Modifier" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
