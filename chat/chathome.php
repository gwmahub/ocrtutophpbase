<?php

include_once '../includes/connect.php';
include_once '../lib/fctglobal.php';
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once 'chatrequests.php';

?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h1>Mini chat</h1>
                <div class="chat">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Date</th>
                            <th><span class="label label-default">Pseudo :</span></th>
                            <th><span class="label label-default">Message :</span></th>
                        </tr>
                        <?php
                        // récupération et affichage des messages
                        while ($data = $getChatMessages->fetch()) {
                            ?>
                            <tr>
                                <td><?php echo dateTimeUs2Fr($data['datecrea']); ?></td>
                                <td><?php echo stripslashes(htmlspecialchars($data['pseudo'])); ?></td>
                                <td><?php echo stripslashes(htmlspecialchars($data['message'])); ?></td>
                            </tr>
                            <?php
                        }
                        $getChatMessages->closeCursor();
                        ?>
                        </tbody>
                    </table>

                </div><!-- END .chat -->
                <div class="formsender">
                    <form action="chatcheckdata.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <input id="pseudochat" class="form-control" type="text" name="pseudochat" required="required" placeholder="Votre pseudo:" value="<?php echo isset($_COOKIE['pseudo'])?$_COOKIE['pseudo']:''; ?>"/>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="messagechat" autofocus />
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-info pull-right">Envoyer >></button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div><!-- END .row -->
    </div><!-- END .container -->


<?php
include_once '../includes/footer.php';