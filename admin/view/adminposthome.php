<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <p><?php echo $msg; ?></p>
            <p class="text-center"><a class="btn btn-info" href="?p=adminpostaction&action=create">Créer un nouveau billet</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table id="postslist-actions" class="table table-striped">
                <thead>
                <tr>
                    <th>Online ?</th>
                    <th>Date</th>
                    <!--<th>Auteur</th>-->
                    <th>Titre</th>
                    <th>Nbre comment.</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($posts){

                    foreach($posts as $post=>$value){
                        ?>
                        <tr>
                            <td><?php echo $post['is_online'] === '1'?'Oui':'Non'; ?></td>
                            <td><?php echo dateTimeUs2Fr($value['date_creation']); ?></td>
                            <!--<td>--><?php //echo htmlspecialchars($value['auteur']); ?><!--</td>-->
                            <td><?php echo htmlspecialchars($value['titre']); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($value['nbcommentsbypost']); ?></td>
                            <td>
                                <div class="btn-group-vertical">
                                    <a type="button" class="btn btn-default" href="?p=adminpostaction&action=view&postid=<?php echo $value['id']; ?>">Afficher</a>
                                    <a type="button" class="btn btn-default" href="?p=adminpostaction&action=edit&postid=<?php echo $value['id'];?>">Editer</a>
                                    <a type="button" class="btn btn-danger" href="?p=adminpostaction&action=delete&postid=<?php echo $value['id'];?>">Supprimer</a>
                                </div>
                            </td>
                        </tr>

                        <?php
                    }//END foreach $posts
                }else{echo '<p class="text-danger">No result found.</p>';}// END if ^posts
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>