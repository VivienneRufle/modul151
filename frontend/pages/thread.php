<?php
global $cats, $posts;

$cats->getThread($_REQUEST['tid']);

$sql = $cats->db->__query("SELECT * FROM themen WHERE TID = ". $_REQUEST['tid']);
$row = $cats->db->__fetchArray($sql);

$sqlC = $cats->db->__query("SELECT COUNT(*) as maxThread FROM themen WHERE UserID = ". $row['UserID']);
$rowC = $cats->db->__fetchArray($sqlC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-11"><?php echo $cats->getThreadTitle($_REQUEST['tid']); ?></div>
                        <div class="col-md-1"><a href="#" class="btn btn-xs btn-info pull-right">#1</a></div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!-- User-Area //-->
                        <div class="col-md-2 getSpan">
                            <span class="center">
                                <a href="#UserID=<?php echo $row['UserID']; ?>" class="label label-username"><?php echo $cats->getUser($row['UserID']); ?></a>
                                <label class="label rank-benutzer">RANK</label>
                                <img src="http://placehold.it/100x100" class="avatar" />
                                <label class="label label-danger" title="<?php echo $cats->getUser($row['UserID']); ?> ist STATUS">STATUS</label>
                                <label class="label label-infos"><i class="fa fa-female"></i> : GESCHLECHT</label>
                                <label class="label label-infos" title="Registriert seit: <?php $cats->getRegDate($row['UserID']); ?>"><i class="fa fa-calendar"></i> : <?php $cats->getRegDate($row['UserID']); ?></label>
                                <label class="label label-infos" title="Themen: ZAHL"><i class="fa fa-comment"></i> : <?php echo $rowC['maxThread']; ?></label>
                                <label class="label label-infos" title="Beitr&auml;ge: ZAHL"><i class="fa fa-comments"></i> : ZAHL</label>
                                <label>&nbsp;</label>
                                <label class="label label-success" title="BENUTZERNAME hat das Thema er&ouml;ffnet"><i class="fa fa-info"></i> : Ersteller</label>
                            </span>
                        </div>

                        <!-- Post Message //-->
                        <div class="col-md-10">
                            <div class="cMiddle message">
                                <?php echo $cats->getThreadMessage($_REQUEST['tid']); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Buttons //-->
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6 postDate">
                            <label class="label label-infos" title="Erstellt am <?php $cats->getDate($row['CreateDate']); ?> um <?php $cats->getTime($row['CreateDate']); ?> Uhr"><i class="fa fa-calendar"></i> <?php $cats->getDate($row['CreateDate']); ?> &middot; <i class="fa fa-clock-o"></i> <?php $cats->getTime($row['CreateDate']); ?></label>
                        </div>
                        <div class="col-md-6">
                            <div class="postBtn">
                                <a href="#" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> antworten</a>
                                <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-quote-right"></i> zitieren</a>
                                <a href="#" class="btn btn-xs btn-warning"><i class="fa fa-flag"></i> melden</a>
                                <a href="#top" class="btn btn-xs btn-warning"><i class="fa fa-arrow-up"></i> TOP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once("./frontend/pages/posts.php");
?>