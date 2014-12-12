<?php
   function mysql_prep( $value ) {
	   $magic_quotes_active = get_magic_quotes_gpc();
	   $new_enough_php = function_exists( "mysql_real_escape_string" );
	   if( $new_enough_php ) {
		   if( $magic_quotes_active ) { $value = stripslashes( $value ); }
		   $value = mysql_real_escape_string( $value );
	   } else { 
		   if( !$magic_quotes_active ) { $value = addslashes( $value ); }
	   }
	   return $value;
   }

   function confirm_query ($result_set) { 	
      if (!$result_set) {
          die("Database query failed: " . mysql_error());
      }
   }
   
   function get_all_subjects ($user_type) {
      global $connection;
      $query = "SELECT *
               FROM subjects";
      if ($user_type == "visitors"){
         $query .= " WHERE visible=1";
      }
      $query.= " ORDER BY position ASC";
      $subject_set = mysql_query($query, $connection);
      confirm_query ($subject_set);
      return $subject_set;
   }
   
   function get_all_pages_for_subject ($subject_id, $user_type) {
      global $connection;
      $query = "SELECT *
               FROM pages
               WHERE subject_id={$subject_id} ";
      if ($user_type == "visitors"){
         $query .= "AND visible=1";
      }
      $query .= " ORDER BY position ASC";                        
      $page_set = mysql_query($query ,$connection);
      confirm_query ($page_set);
      return $page_set;
   }
   
   function get_subject_by_id ($subject_id) {
        global $connection;
        $query = "SELECT *
                        FROM subjects
                        WHERE id = {$subject_id}
                        LIMIT 1";
        $result_set = mysql_query ($query, $connection);
        confirm_query($result_set);
        $subject = mysql_fetch_array ($result_set);
        return $subject;
   }
   
   function get_page_by_id ($page_id) {
      global $connection;
      $query = "SELECT *
		      FROM pages
		      WHERE id = {$page_id}
		      LIMIT 1";
      $result_set = mysql_query ($query, $connection);
      confirm_query($result_set);
      $page = mysql_fetch_array ($result_set);
      return $page;
   }
   
   function get_default_page ($subject_id, $user_type) {
      $result=get_all_pages_for_subject ($subject_id, $user_type);
      if ($first_page=mysql_fetch_array($result)) {
	 return $first_page;
      } else return NULL;
   }
   
   function set_up_variables($user_type) {
      global $sel_page;
      global $sel_subject;
      if (isset($_GET['subj'])) {
	$sel_page = get_default_page($_GET['subj'],$user_type);
	$sel_subject = get_subject_by_id ($_GET['subj']);
      } else if (isset($_GET['page'])) {
	$sel_subject = NULL;
	$sel_page = get_page_by_id ($_GET['page']);
	$_GET["subj"]=NULL;
      } else {
	$sel_subject = NULL;
	$sel_page = NULL;
	$_GET["subj"]=NULL;
	$_GET["page"]=NULL;
      }
   }
      
   
   function navigation ($user_type,$sel_page) {
      echo "<ul class=\"subjects\">";    
   	   $subject_set = get_all_subjects($user_type);
	       $address = "index" ;
	       $address_page = "index";
	   while ($subject = mysql_fetch_array($subject_set)) {
	       echo "<li ";
	       if ($_GET["subj"]==$subject["id"])
	       echo "class= \"selected\"";
	       echo "><a href=\"{$address}.php?subj=" . urlencode($subject["id"]) . "\">{$subject["menu_name"]}</a></li>";
		  $page_set = get_all_pages_for_subject($subject["id"],$user_type);   
		  echo "<ul class=\"pages\">";
		  while ($page = mysql_fetch_array($page_set)) {
		     echo "<li ";
		     if ($sel_page['id']==$page["id"])
		     echo "class= \"selected\"";
		     echo "><a href=\"{$address_page}.php?page=" . urlencode($page["id"]) . "\">{$page["menu_name"]}</a></li>";
		  }
		  echo "</ul>";
	    }
      echo "</ul>";	    
   }
   
   function content_navigation ($user_type,$sel_page) {
      echo "<ul class=\"subjects\">";    
   	   $subject_set = get_all_subjects($user_type);
	       $address = "edit_subject";
	       $address_page = "content";
	   while ($subject = mysql_fetch_array($subject_set)) {
	       echo "<li ";
	       if ($_GET["subj"]==$subject["id"])
	       echo "class= \"selected\"";
	       echo "><a href=\"{$address}.php?subj=" . urlencode($subject["id"]) . "\">{$subject["menu_name"]}</a></li>";
		  $page_set = get_all_pages_for_subject($subject["id"],$user_type);   
		  echo "<ul class=\"pages\">";
		  while ($page = mysql_fetch_array($page_set)) {
		     echo "<li ";
		     if ($sel_page['id']==$page["id"])
		     echo "class= \"selected\"";
		     echo "><a href=\"{$address_page}.php?page=" . urlencode($page["id"]) . "\">{$page["menu_name"]}</a></li>";
		  }
		  echo "</ul>";
	    }
      echo "</ul>";	    
   }
   function redirect_to ($location) {
      if ($location != NULL) {  
         header ("Location: $location");
         exit;
      }
   }
   
   function error_checking_in_form ($field_name,$errors) {
      $value=0;
      foreach ($errors as $error) {
	 if ($error == $field_name) {
	    $value=1;
	    return $value;   
	 } else $value=0;
      }
      return $value;
   }
   
   function user_type_set () {
      if (isset ($_SESSION['admin_value'])) {
	 if ($_SESSION['admin_value']==1) {
	    $user_type = "admins";
	 } else $user_type = "members";
      } else $user_type = "visitors";
      
      return $user_type;
   }
   
   function checking_authority () {
      if (isset ($_SESSION['admin_value']) && $_SESSION['admin_value'] !=1) {
		redirect_to ("a_messege.php");
      }
   }
   
   function get_everything_of_user ($user_id,$connection) {
      $query= "SELECT *
	    FROM users
	    WHERE id = {$user_id}";
      $result = mysql_query ($query, $connection);
      if ($result) {
	 $result_set=mysql_fetch_array($result);
	 return $result_set;
      } else echo "error." . mysql_error();
   }
   
   function get_username_by_id ($user_id, $connection) {
        if ($user_id == 0) {
            $user_name = "SGIPC ";
            return $user_name;
        } else {
            $query= "SELECT user_name
                FROM users
                WHERE id = {$user_id}";
            $result = mysql_query ($query, $connection);
            if ($result) {
                $result_set=mysql_fetch_array($result);
                return $result_set['user_name'];
            } else echo "error." . mysql_error();
        }
   }
   
   function show_all_comments_for_a_page($id,$connection) {
      echo "<br/>";
      $query = "SELECT content, user_id, date, time, id
	      FROM comments
	      WHERE page_id = {$id}
	      ORDER BY position ASC" ;
      $result_set = mysql_query($query , $connection);
      while ($result = mysql_fetch_array ($result_set)) {
	  $user_name = get_username_by_id ($result ['user_id'],$connection);
	  echo "<p id=\"comments\"><a href='profile.php?user_id={$result['user_id']}'>{$user_name}";
          echo ":";
            if (($result['user_id'] == $_SESSION['user_id']) || $_SESSION['admin_value']==1) {
                echo "<a href=\"delete_comment.php?id={$result['id']}&&page={$id}\" id='delete' onclick=\"return confirm('Are you sure you want to delete this comment?');\">delete</a>";
            }
	  echo "<div id= \"comment_texts\"><i>{$result['content']}</i></div>";
	  echo " <br/><div id=\"time\">{$result['time']}";
	  echo  ", {$result['date']}</div><br/><br/></p>";
      }
   }
   
   function get_all_comments_by_page_id ($page_id,$connection) {
        $query = "SELECT *
                FROM comments
                WHERE page_id = {$page_id}";
        $comment_set = mysql_query ($query, $connection);
        if ($comment_set) {
            return $comment_set;
        } else {
            echo "database failed" . mysql_error();
        }
   }
   
    function delete_all_comments_for_page($page_id,$connection) {
        $query = "DELETE FROM comments
                WHERE page_id = {$page_id}";
        $result = mysql_query ($query, $connection);
        return $result;
    }
   
    function get_all_messeges ($connection) {
        $query = "SELECT *
                FROM messeges";
        $result_set = mysql_query ($query, $connection);
        return $result_set;
    }
    
    function return_all_unviewed_messege_for_id ($user_id, $connection) {
        $query = "SELECT reciever_id
                FROM messeges
                WHERE status=0";
        $result_set = mysql_query ($query, $connection);
        $count =0;
        while ($result = mysql_fetch_array($result_set)) {
            if ($result['reciever_id'] == $user_id) {
                $count++;
            }
        }
        return $count;        
    }
    
    function change_status_of_messege($id, $connection) {
        $query = "UPDATE messeges
                SET status = 1
                WHERE reciever_id = {$id}";
        $result = mysql_query ($query, $connection);
        if (!$result) {
            echo "database error" . mysql_error();
        }
        
    }
    
    function ab_jg($string) {
        $final_string = "8d5574j0sv1kj54";
        $string = 356 * $string;
        $string = $string+15478;
        $middle = 5*$string;
        $final_string .= $middle;
        $final_string .= "5a44j41k85";
        return $final_string;
    }
    
    function de_ab_jg($en_str) {
        $en_count_1 = strlen($en_str);
        $en_count_2 = ceil($en_count_1/15);    
        $de_str_1 = "";
        $splitted_str = str_split($en_str , 15);
        for ($i = 1; $i<$en_count_2; $i++) {
            $de_str_1 .= $splitted_str[$i];
        }
        $de_str_2 = strrev($de_str_1);
        $en_count_2 = strlen($de_str_2);
        $en_count_3 = ceil($en_count_2/10);    
        $de_str_3 = "";
        $splitted_str_2 = str_split($de_str_2 , 10);
        for ($i = 1; $i<$en_count_3; $i++) {
            $de_str_3 .= $splitted_str_2[$i];
        }
        $de_str_4 = strrev($de_str_3);
        $final_str = ((($de_str_4/5)-15478)/356);
        return $final_str;
    }
    
    function cookie_auth ($address) {
        global $connection;
        if (isset($_COOKIE['remember'])) {
            $id = de_ab_jg($_COOKIE['remember']);
            $query = "SELECT user_name, admin_value
                    FROM users
                    WHERE id = {$id}";    
            $result_set = mysql_query($query,$connection);
            confirm_query($result_set);
            if ( mysql_num_rows($result_set)==1 ) {
                $result = mysql_fetch_array($result_set);
                $_SESSION['user_name'] = $result['user_name'];
                $_SESSION['user_id'] = $id;
                $_SESSION['admin_value'] = $result['admin_value'];
                if ($address == "log_in") {
                    redirect_to ("index.php");
                }
            }
        }        
    }
    
    function notification ($user_id,$connection) {
        $count = return_all_unviewed_messege_for_id($user_id,$connection);
        if ($count!=0) {
            echo "({$count})";
        }                         
    }

    function matching_user_name ($user_name, $connection) {
        $query = "SELECT user_name
                FROM users
                WHERE user_name = '{$user_name}'";
        $result = mysql_query ($query , $connection);
        if (mysql_num_rows($result) == 0) {
            return 1;
        } else
            return 0;
    }
?>