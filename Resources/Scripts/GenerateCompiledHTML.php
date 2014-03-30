<?php

require('CompileHTML.php');
$compileObj = new CompileHTML();
$compileObj->set_html('		<div data-role="panel" id="<js::replace{nav_id}/>">
			<ul data-role="listview" data-theme="d" data-icon="false">
				<li data-role="list-divider" id="inline-profile">
					<div id="user-avatar"></div>
					<div id="user-name">
						<span class="student-name"></span>
						<br />
						<span class="student-id"></span>
					</div>
					<br class="clear" />
				</li>
				<li class="nav-item">
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-rouble.png" alt="" class="sidebar-icon" />PantherPoints
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-calculator.png" alt="" class="sidebar-icon" />GPA Calculator
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-abacus.png" alt="" class="sidebar-icon" />Chapel Counter
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#building-hours">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-time.png" alt="" class="sidebar-icon" />Building Hours
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-hashtag.png" alt="" class="sidebar-icon" />Social
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
					        <span class="floatleft nav-text">
					            <img src="images/sidebar-icons/icon-at.png" alt="" class="sidebar-icon" />Your Profile
					        </span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
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