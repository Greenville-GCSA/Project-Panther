<?php

class Pages_Login extends Abstracts_Pages {

	public $page, $settings;

	public function __construct() {
		$this->page = array(
			'url' => array(
				'title' => 'Login',
				'key' => 'login',
			),
			'tagline' => 'Use the login form below!',
			'wrapper_id' => 'login',
		);
		$this->settings = $this->getSettings();
	}

	public function head () {
		echo '
		<style>
			#login_wrapper {
				font-family: "Englebert", sans-serif;
				display: block;
				margin: 20px 0;
			}
			label {
				font-weight: bold;
				font-size: 30pt;
				color: #999;
			}
			label.active {
				color: #555;
			}
			input {
				font-style: italic;
				font-size: 30pt;
				border: 2px dotted #999;
				padding: 10px;
				background: #e6e6e6;
				color: #999;
			}
			input[type=submit] {
				margin-top: 12px;
			}
			input[type=submit]:hover {
				cursor: pointer;
				color: #555;
			}
			input:focus {
				color: #555;
			}
			#username_field {
			}

			#password_field, #login_field {
				margin-top: 12px;
			}

			.animate_label, label:hover {
				animation: darkToLight 2s; -webkit-animation: darkToLight 2s;
			}
			@keyframes darkToLight {
				from { color: #999; }
				to { color: #555; }
			}
			@-webkit-keyframes darkToLight{
				from { color: #999; }
				to { color: #555; }
			}
		</style>
		<script>
			$(document).ready(function() {
				$("#username").focus();
				$("#username_field label").addClass("animate_label active");
				$("#username").keyup(usernameKeyUpEvent);

				var usernameKeyUpTimer;
				var passwordKeyUpTimer;

				$("#username").focus(function() {
					$("#password_field label").removeClass("active");
					$("#username_field label").addClass("active");
				}).blur(function() {
					$("#username_field label").removeClass("active");
				});
				$("#password").focus(function() {
					$("#username_field label").removeClass("active");
					$("#password_field label").addClass("active");
				}).blur(function() {
					$("#password_field label").removeClass("active");
				});

				function usernameKeyUpEvent() {
				   clearTimeout(usernameKeyUpTimer);
				   usernameKeyUpTimer = setTimeout(showPassword, 1*1000 + 500);
				}

				function passwordKeyUpEvent() {
					clearTimeout(passwordKeyUpTimer);
					passwordKeyUpTimer = setTimeout(showLoginSubmit, 1*1000 + 500);
				}

				function showPassword() {
					$("#username_field label").removeClass("active");
					$("#password_field").slideDown("slow");
					$("#password").focus();
					$("#password_field label").addClass("animate_label active");
					$("#password").keyup(passwordKeyUpEvent);
				}

				function showLoginSubmit() {
					$("#password_field label, #username_field label").removeClass("active");
					$("#login_field").slideDown("slow");
					$("#login_field label").addClass("animate_label active");
				}
			});
		</script>
		';
	}

	public function prepend () {}

	public function content() {
		echo '
		<form action="index.php?page=login" method="post">
			<div id="username_field">
				<label for="username">enter your username here...</label>
				<br>
				<input type="text" id="username" name="username" value="">
			</div>
			<div id="password_field" class="hidden">
				<label for="password" id="password_label">and your password here...</label>
				<br>
				<input type="password" id="password" name="password" value="">
			</div>
			<div id="login_field" class="hidden">
				<label for="login_button">and finally...</label>
				<br>
				<input type="submit" value="login" id="login_button">
			</div>
		</form>
		';
	}

	public function append() {}
}