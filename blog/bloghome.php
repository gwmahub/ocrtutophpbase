<?php

include_once '../includes/connect.php';
include_once '../lib/fctglobal.php';
include_once '../includes/head.php';
include_once '../includes/header.php';

$msg = isset($_GET['msg'])? $_GET['msg']:'';

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div id="msgBlog">
                <?php
                if($msg === "ok"){
                    ?>
                    <div class="alert alert-success"><p>Your comment has been sent successfully !</p></div>
                    <?php
                }else if($msg === "nok"){
                    ?>
                    <div class="alert alert-danger"><p>Sorry, your comment has not been sent ! Please retry.</p></div>
                    <?php
                }
                ?>
            </div>

            <h1>Blog</h1>
<?php

            //nbre de billets au total
            $nbPosts        = $bdd->query('SELECT COUNT(billets.id) FROM billets')->fetch();
            $postPerPage    = 5;
            $nbPages        = ceil($nbPosts[0]/$postPerPage);
            $page           = isset($_GET['page'])?$_GET['page']:'1';
            $limitBeginAt   = ($page-1)*$postPerPage;
            $previousPage   = $page !== '1' ? $page-1:1;
            $nextPage       = $page < $nbPages ? $page+1:$nbPages;


            $commentsByPost = $bdd->query(' SELECT billets.id, titre, contenu, date_creation,(SELECT COUNT(id_billet) FROM commentaires WHERE id_billet = billets.id) AS nbcommentsbypost
                                            FROM billets
                                            LEFT JOIN commentaires ON (billets.id = commentaires.id_billet)
                                            GROUP BY billets.id
                                            ORDER BY date_creation DESC
                                            LIMIT '.$limitBeginAt.','.$postPerPage);
?>
        <nav>
            <ul class="pagination">
<?php
            echo $page !== '1'? '<li><a href="bloghome.php?page='.$previousPage.'">&lt;&lt;</a><li>':'';
            for($i=1,$c=$nbPages; $i<=$c; $i++){
                echo '<li ' .($page == $i ? 'class="active"': '').'>
                    <a href="bloghome.php?page='.$i.'">'.$i.'</a>
                </li>';
            }
            echo $page < $nbPages? '<li><a href="bloghome.php?page='.$nextPage.'" >&gt;&gt;</a></li>':'';
?>
            </ul>
        </nav>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date post</th>
                    </tr>
                </thead>
                <tbody>
<?php
            while($data = $commentsByPost->fetch()){
?>
                <tr>
                    <td class="postTitle col-sm-3 col-md-3"><h4><?php echo htmlspecialchars($data['titre']); ?></h4></td>
                    <td>
                        <div><?php echo nl2br(htmlspecialchars($data['contenu'])); ?><hr /></div>
                        <a class="btn btn-primary goToCommentForm" role="button" data-toggle="modal" data-target="#postid<?php echo $data['id']; ?>" aria-expanded="false" aria-controls="collapseExample"> <!--href="blogcommentform.php?postid=<?php //echo $data['id']; ?>"-->
                            &gt;&gt;&nbsp;Commenter
                        </a>

                        <div id="postid<?php echo $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h5 class="modal-title"><em><?php echo $data['titre']; ?></em></h5>
                                    </div>
                                    <div class="modal-body">

                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <form class="form-horizontal" action="blogcommentform.php" method="post">
                                                        <div class="form-group">
                                                            <label for="blogpseudo">Pseudo : </label>
                                                            <input type="text" name="blogpseudo" class="form-control" required="required" placeholder="Your pseudo" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="blogcomment">Commentaire : </label>
                                                            <textarea name="blogcomment" class="form-control" required="required" placeholder="Your pseudo" rows="3"></textarea>
                                                            <input type="hidden" name="postid" value="<?php echo $data['id'];; ?>" />
                                                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                                                            <input type="hidden" name="msg" value="<?php echo $msg; ?>" />
                                                        </div>
                                                        <p class="text-center">
                                                            <button type="submit" name="submit" class="btn btn-info">Envoyer</button>
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <a class="btn btn-primary displayComments" role="button" data-toggle="collapse" href="#postId<?php echo $data['id']; ?>" aria-expanded="false" aria-controls="collapseExample">
                            &gt;&gt;&nbsp;Lire les commentaires <span class="badge"><?php echo $data['nbcommentsbypost']; ?></span>
                        </a>

                        <div class="collapse" id="postId<?php echo $data['id']; ?>">
                            <div class="well">

                                <?php
                                if($data['nbcommentsbypost']){
                                    try {
                                        $qCommentsByPost = $bdd->prepare(
                                            'SELECT auteur, commentaire, date_commentaire FROM commentaires WHERE id_billet = :id_billet ORDER BY date_commentaire DESC'
                                        );
                                        $qCommentsByPost->execute(array('id_billet' => $data['id']));
                                        while ($dataComment = $qCommentsByPost->fetch()) {
                                            ?>
                                            <p>
                                                <?php echo dateTimeUs2Fr($dataComment['date_commentaire']); ?>
                                                &gt;&gt;<b><?php echo htmlspecialchars($dataComment['auteur']); ?></b>:<br/>
                                                <?php echo nl2br(htmlspecialchars($dataComment['commentaire'])); ?>
                                            </p>
                                            <?php
                                        }
                                        $qCommentsByPost->closeCursor();

                                    }catch(PDOException $e){
                                        print $e->getMessage();
                                    }
                                }else{
                                    echo '<p>Soyez le premier à commenter cet article</p>';
                                }

?>
                            </div>
                        </div>
                    </td>
                    <td><?php echo dateTimeUs2Fr($data['date_creation']); ?></td>
                </tr>
<?php
            }
            $commentsByPost->closeCursor();
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once '../includes/footer.php';