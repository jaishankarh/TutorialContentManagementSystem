<?php
$user = $_SESSION['userdata'];
$tp=$DBVARS['tp'];
$site = dbRow('SELECT * FROM '.$tp.'site_info WHERE id=1');
?>

<footer>
                <p><?php echo $site['footer']; ?></p>
</footer>
        </div>
    </body>
</html>
