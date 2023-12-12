<?php
session_start(); 

if (!isset($_POST['page'])) {                
	    $display_modal_window = 'signin';  // This variable will be used in 'view_startpage.php'
	    include ('startpage.php');
	    exit();
	}
require('model.php');

if ($_POST['page'] == 'StartPage')
{
	$username= $_POST['username'];
	$password = $_POST['password'];
    $command = $_POST['command'];
    switch($command) {
		case 'SignIn':
			if (isUserValid($username, $password)) {
				$_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $username;
                include 'main.php';
            } 
            else {
				$error_msg_username = '* Wrong username, or';
				$error_msg_password = '* Wrong password';
				$display_modal_window = 'signin';
				include 'startpage.php';
			}
            exit();
            //sign up
		case 'SignUp':
				$username = $_POST['username'];
				$password = $_POST['password'];
				$passwordStrength = $_POST["password_strength"];
				$email = $_POST['email'];
				if($passwordStrength == "Weak" || $passwordStrength == "Moderate")
				{
					$error_msg_username1 = "";
					$error_msg_password1 = "Password is too weak";
					$error_msg_email1 = "";
					$display_modal_window = 'signup';
						include 'startpage.php';
				}
				else if(!doesUserExist($username)){
					if(signUpNewUser($username, $password, $email)){
						$error_msg_username1 = "";
						$error_msg_password1 = "";
						$error_msg_email1 = "";
						$display_modal_window = 'signin';
						include 'startpage.php';
					}
					else{
						$error_msg_username1 = "Sign up failed";
						$error_msg_password1 = "";
						$error_msg_email1 = "";
						$display_modal_window = 'signup';
						include 'startpage.php';
					} 
				}
				// exist account
				else{
					$error_msg_username1 = "Username already existed or,";
					$error_msg_password1 = "Password already existed or,";
					$error_msg_email1 = "Email already existed.";
					$display_modal_window = 'signup';
					include 'startpage.php';
				}
			exit();
		default:
			$error_msg_username = "Username already existed";
			$error_msg_password = "";
			$error_msg_email = "";
			include 'startpage.php';
			exit();
		}
}

// else if ($_POST['page'] == 'MainPage'){
// 		$command = $_POST['command'];
// 	   	if(!isset($_SESSION['signedin'])){
// 			$display_modal_window = "signin";
// 			include 'startpage.php';
// 			exit();
// 		}

// 		$username = $_SESSION['username'];

// 	    switch ($command) {
// 			case 'Home':
// 				include 'profile.php';
// 				exit();
// 				break;	

// 		    case 'PostForums':
// 		    	if(postForums($username, $_POST['question']) == 0)
// 				{
// 					echo "Error";
// 				}
// 				else
// 				{
// 					echo json_encode(displayForums($_POST['question']));
// 				}
// 				exit();
// 				break;

// 			case 'EditForums':
// 				echo editForums($_POST['id'], $_POST['forums']);
// 				exit();
// 				break;	

// 			case 'EditReplyForums':
// 				if($_POST['id_reply'] == ""){
// 					$reply = insertReplyNew($_POST['id_forums'], $_POST['reply']);
// 					echo '<div class="card" id="card-reply-'.$reply[0].'" style="max-width:80%; margin-left:10rem;"><div class="card-header insert-name text-left"><div style="font-size: 2.5rem; font-weight: 500;">Reply - Username: '.getUsernameById($reply[2]).'</div></div><div class="card-body"><table class="table"><tbody><tr><th scope="row">Id</th><th scope="row">Reply</th><th scope="row">UserId</th><th scope="row">Date</th><th scope="row">ForumId</th></tr><tr scope="row"><td scope="row">'.$reply[0].'</td><td scope="row">'.$reply[1].'</td><td scope="row">'.$reply[2].'</td><td scope="row">'.$reply[3].'</td><td scope="row">'.$reply[4].'</td></tr></tbody></table></div><div class="card-footer insert-button text-right" style="padding-right: 5rem;"><button class="editReplyBtn" onclick="editReply('.$reply[0].',\''.$reply[1].'\','.$reply[4].')" type="button">Edit</button> <button class="deleteReplyBtn" onclick="deleteReply('.$reply[0].')" type="button">Delete</button></div></div>';
// 				}
// 				else{
// 					editReplyForums($_POST['id_reply'], $_POST['reply']);
// 				}
// 				exit();
// 				break;

// 			case 'DeleteForums':
// 				echo deleteForums($_POST['id']);
// 				exit();
// 				break;

// 			case 'DeleteReplyForums':
// 				echo deleteReplyForums($_POST['id']);
// 				exit();
// 				break;

// 			case 'SearchForums':
// 				$allForums = getAllForums($_POST['search']);

// 				$card = "";
// 				foreach ($allForums as $key => $item) {
// 					$card .= '<div class="card"><div class="card-header insert-name text-left"><div style="font-size: 2.5rem; font-weight: 500;">Username: '.getUsernameById($item['UserId']).'</div></div><div class="card-body"><table class="table"><tbody><tr><th scope="row">Id</th><th scope="row">Forums</th><th scope="row">UserId</th><th scope="row">Date</th></tr><tr id="'.$item['Id'].'" scope="row"><td scope="row">'.$item['Id'].'</td><td scope="row">'.$item['Forums'].'</td><td scope="row">'.$item['UserId'].'</td><td scope="row">'.$item['Date'].'</td></tr></tbody></table></div><div class="card-footer insert-button text-right" style="padding-right: 5rem;"><button class="replyBtn" type="button" onclick="addReplyForums(this)">Reply</button> ';
// 					if($_SESSION['username'] == getUsernameById($item['UserId'])){
// 						$card .= '<button class="editBtn" type="button" onclick="editForums(this)">Edit</button> <button class="deleteBtn" type="button" onclick="deleteForums(this)">Delete</button>';
// 					}
// 					$card .= '</div></div><br>';
// 					$card .= '<div class="reply" id="reply-'.$item['Id'].'">';
// 					$allReply = getAllReply($item['Id']);
// 					foreach ($allReply as $key1 => $item1) {
// 						$card .= '<div class="card" id="card-reply-'.$item1['Id'].'" style="max-width:80%; margin-left:10rem;"><div class="card-header insert-name text-left"><div style="font-size: 2.5rem; font-weight: 500;">Reply - Username: '.getUsernameById($item1['UserId']).'</div></div><div class="card-body"><table class="table"><tbody><tr><th scope="row">Id</th><th scope="row">Reply</th><th scope="row">UserId</th><th scope="row">Date</th><th scope="row">ForumId</th></tr><tr scope="row"><td scope="row">'.$item1['Id'].'</td><td scope="row">'.$item1['Reply'].'</td><td scope="row">'.$item1['UserId'].'</td><td scope="row">'.$item1['Date'].'</td><td scope="row">'.$item1['ForumId'].'</td></tr></tbody></table></div><div class="card-footer insert-button text-right" style="padding-right: 5rem;">';
// 						if($_SESSION['username'] == getUsernameById($item1['UserId'])){
// 							$card .= '<button class="editReplyBtn" onclick="editReply('.$item1['Id'].',\''.$item1['Reply'].'\','.$item1['ForumId'].')" type="button">Edit</button> <button class="deleteReplyBtn" onclick="deleteReply('.$item1['Id'].')" type="button">Delete</button>';
// 						}
// 						$card .= '</div></div><br>';
// 					}
// 					$card .= '</div><br>';
// 				}
// 				echo $card;
// 				exit();
// 				break;		

// 			case 'DisplayAllForums':
// 				$allForums = getAllForums();
// 				$card = "";
// 				foreach ($allForums as $key => $item) {
// 					$card .= '<div class="card"><div class="card-header insert-name text-left"><div style="font-size: 2.5rem; font-weight: 500;">Username: '.getUsernameById($item['UserId']).'</div></div><div class="card-body"><table class="table"><tbody><tr><th scope="row">Id</th><th scope="row">Forums</th><th scope="row">UserId</th><th scope="row">Date</th></tr><tr id="'.$item['Id'].'" scope="row"><td scope="row">'.$item['Id'].'</td><td scope="row">'.$item['Forums'].'</td><td scope="row">'.$item['UserId'].'</td><td scope="row">'.$item['Date'].'</td></tr></tbody></table></div><div class="card-footer insert-button text-right" style="padding-right: 5rem;"><button class="replyBtn" type="button" onclick="addReplyForums(this)">Reply</button> ';
// 					if($_SESSION['username'] == getUsernameById($item['UserId'])){
// 						$card .= '<button class="editBtn" type="button" onclick="editForums(this)">Edit</button> <button class="deleteBtn" type="button" onclick="deleteForums(this)">Delete</button>';
// 					}
// 					$card .= '</div></div><br>';
// 					$card .= '<div class="reply" id="reply-'.$item['Id'].'">';
// 					$allReply = getAllReply($item['Id']);
// 					foreach ($allReply as $key1 => $item1) {
// 						$card .= '<div class="card" id="card-reply-'.$item1['Id'].'" style="max-width:80%; margin-left:10rem;"><div class="card-header insert-name text-left"><div style="font-size: 2.5rem; font-weight: 500;">Reply - Username: '.getUsernameById($item1['UserId']).'</div></div><div class="card-body"><table class="table"><tbody><tr><th scope="row">Id</th><th scope="row">Reply</th><th scope="row">UserId</th><th scope="row">Date</th><th scope="row">ForumId</th></tr><tr scope="row"><td scope="row">'.$item1['Id'].'</td><td scope="row">'.$item1['Reply'].'</td><td scope="row">'.$item1['UserId'].'</td><td scope="row">'.$item1['Date'].'</td><td scope="row">'.$item1['ForumId'].'</td></tr></tbody></table></div><div class="card-footer insert-button text-right" style="padding-right: 5rem;">';
// 						if($_SESSION['username'] == getUsernameById($item1['UserId'])){
// 							$card .= '<button class="editReplyBtn" onclick="editReply('.$item1['Id'].',\''.$item1['Reply'].'\','.$item1['ForumId'].')" type="button">Edit</button> <button class="deleteReplyBtn" onclick="deleteReply('.$item1['Id'].')" type="button">Delete</button>';
// 						}
// 						$card .= '</div></div><br>';
// 					}
// 					$card .= '</div><br>';
// 				}		
// 				echo $card;
// 				exit();
// 				break;

// 			default:
// 				echo "Unknown command from MainPage<br>";
// 				exit();
// 				break;
// 		}
// 	}

// else{
// 	echo 'Wrong page<br>';
// }
?>
