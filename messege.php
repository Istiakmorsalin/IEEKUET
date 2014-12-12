<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
<?php $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
    <div id="main">
        <table id="structure">
            <tr>
                <td id="navigation">
                <?php content_navigation ($user_type,$sel_page); ?>
                <br/>
                <a href="new_subject.php">+ Add a new subject</a>
                </td>
                <td id="page">
                    <h2><?php
                            if ($_GET['value'] == 1) {
                                echo "The {$_GET['name']} was successfully {$_GET['type']}ed.";
                            }
                            if ($_GET['value'] == 0) {
                                echo "The {$_GET['name']} was not successfully {$_GET['type']}ed.";
                            }

                        ?>
                    </h2>
                    <h3> Select another subject or page to edit.
                    </h3>
                </td>
                <td id="m_navigation">
                    <h3><a href="indexd.php"id="select">Home</a></h3>
                    <h3><a href="profile.php">Profile</a></h3>
                    <h3><a href="admin.php">Admin's Page</a></h3>                    
                    <h3><a href="messeges.php">Messeges</a></h3>
                    <h3><a href="log_out.php">Logout</a></h3>
                </td>
                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>