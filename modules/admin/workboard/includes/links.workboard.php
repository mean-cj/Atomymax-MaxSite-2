<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################

CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
    adminmenu("admin.php?op=WorkBoardIndex", "WorkBoard", "workboard.gif");


?>