<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
    <div id="main">
        <table id="structure">
            <tr>
                <td id="navigation">
                </td>
                <td id="page">
                    <h2>
                         
                        <?php
                            if (isset($_GET['msg'])) {
                                echo "Messege!";
                            } else {
                                echo "Sorry" . !$_SESSION['user_name'];
                            }
                        ?>
                    </h2>
                    <h3>
                        <?php
                            if (isset($_GET['msg'])) {
                                echo "You are already a member. You don't need to again sign up.";
                            } else {
                            echo "You don't have permission to see this page!";
                            }
                        ?>
                    </h3>
                    <p>
                        <a href="indexd.php">Return to home</a>
                    </p>                    
                </td>
                </td>
                <td id="m_navigation">
                    
                </td>
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>