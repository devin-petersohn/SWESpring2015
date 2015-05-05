<?php 
            session_start();
            $currstatus = empty($_SESSION['status']) ? false : $_SESSION['status'];
            
            
            if ($currstatus) {
                echo $currstatus;
            }
            else {
                echo "false";
            }
            
            ?>
