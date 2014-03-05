<?php

require('CompileHTML.php');
$compileObj = new CompileHTML();
$compileObj->set_html('		<div data-role="panel" id="navigation">
			<ul data-role="listview" data-theme="d" data-icon="false">
				<li data-role="list-divider" id="inline-profile">
					<div id="user-avatar">
						<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/t1/c0.12.320.320/p320x320/1560633_10201325361596512_1572126267_n.jpg" alt="" />
					</div>
					<div id="user-name">
						<span class="student-name">Matthew P. Kerle</span>
						<br />
						<span class="student-id">201202055</span>
					</div>
					<br class="clear" />
				</li>
				<li>
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-rouble.png" alt="" class="sidebar-icon" />Dashboard
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-rouble.png" alt="" class="sidebar-icon" />Events
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-rouble.png" alt="" class="sidebar-icon" />PantherPoints
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-calculator.png" alt="" class="sidebar-icon" />GPA Calculator
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-abacus.png" alt="" class="sidebar-icon" />Chapel Counter
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#page-building_hours">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-time.png" alt="" class="sidebar-icon" />Building Hours
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-rouble.png" alt="" class="sidebar-icon" />Social
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="#">
					        <span class="floatleft nav-text">
					            <img src="images/sidebar-icons/icon-user.png" alt="" class="sidebar-icon" />Your Profile
					        </span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li>
					<a href="tel:16186647777">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-phone-call.png" alt="" class="sidebar-icon"/>Call Security
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
			</ul>
		</div>');
echo '<textarea style="width:75%; height: 450px;">', $compileObj->get_html(), '</textarea>';