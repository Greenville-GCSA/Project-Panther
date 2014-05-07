<?php
require_once('CompileHTML.php');
$compileObj = new CompileHTML();
$compileObj->set_html('		<div data-role="panel" id="<js::replace{nav_id}/>">
			<ul data-role="listview" data-theme="d" data-icon="false">
				<li data-role="list-divider" id="inline-profile">
					<div id="user-avatar">
						<img src="https://graph.facebook.com/<js::replace{user_id}/>/picture" alt="" class="avatar" />
					</div>
					<div id="user-name">
						<span class="student-name"><js::replace{user_name}/></span>
						<br />
						<span class="student-id"><js::replace{student_id}/></span>
					</div>
					<br class="clear" />
				</li>
				<li class="nav-item">
					<a href="#panther_points" id="nav_panther_points" class="nav-link">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-rouble.png" alt="" class="sidebar-icon" />PantherPoints
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#gpa_calculator" id="nav_gpa_calculator" class="nav-link">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-calculator.png" alt="" class="sidebar-icon" />GPA Calculator
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#chapel_counter" id="nav_chapel_counter" class="nav-link">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-abacus.png" alt="" class="sidebar-icon" />Chapel Counter
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#building_hours" id="nav_building_hours" class="nav-link">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-time.png" alt="" class="sidebar-icon" />Building Hours
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
				<li class="nav-item">
					<a href="tel:16186647777" id="nav_call_security" class="nav-link">
							<span class="floatleft nav-text">
								<img src="images/sidebar-icons/icon-phone-call.png" alt="" class="sidebar-icon"/>Call Security
							</span>
						<span class="ui-icon-carat-r ui-btn-icon-right"></span>
					</a>
				</li>
			</ul>
		</div>');
echo '<textarea style="width:75%; height: 450px;">var nav = \'', $compileObj->get_html(), '\';</textarea>';