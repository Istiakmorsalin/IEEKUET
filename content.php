<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
<?php $user_type=user_type_set(); ?>
<?php set_up_variables("$user_type"); ?>

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
                    <h2><?php if(isset($sel_subject))  echo $sel_subject['menu_name'];
                                 else if(isset($sel_page)) echo $sel_page['menu_name'];
                                    else echo "Select a subject or page to edit or read."?>
                    </h2>
                    <p>
                    <?php
                        if (isset($sel_page)) {
                            echo $sel_page['content'];
                            echo "<br/><br/>";
                            echo "<hr/>";
                            echo "<a href=\"edit_page.php?page={$sel_page['id']} && sub_id={$sel_page['subject_id']}\"";
                            echo ">Edit page</a>";                            
                        }
                    ?>
                    </p>
                </td>
                <td id="m_navigation">
                    <h3><a href="indexd.php">Home</a></h3>
                    <h3><a href="profile.php">Profile</a></h3>
                   
                    <h3><a href="content.php" id="select">View Contents</a></h3>
                    <h3><a href="admin.php">Admin's Page</a></h3>                                        
                    <h3><a href="log_out.php">Logout</a></h3>                    
                </td>
                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>