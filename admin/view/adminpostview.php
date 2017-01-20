
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-10">
            <h1>Visualiser un billet</h1>
        </div>
        <div class="col-sm-2 col-md-2">
            <a class="btn btn-info" href="?p=adminposthome"><< Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <p><span class="label label-info">Date</span></p>
           <p> <?php echo dateTimeUs2Fr($post->date_creation); ?></p>
        </div>
        <div class="col-sm-4 col-md-4">
            <p><span class="label label-info">Titre</span></p>
            <p><?php echo$post->titre; ?></p>
        </div>
        <div class="col-sm-6 col-md-6">
            <p><span class="label label-info">Contenu</span></p>
            <p><?php echo$post->contenu; ?></p>
        </div>
    </div>
</div>