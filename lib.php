<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Multiple Hillbrook Moodle customisations / hacks.
 * Extend navigation to add Hillbrook Menu options.
 * Insert $USER properties into top of document for referencing
 *   with javascript in certain pages/functions
 *
 * @package    local_hillbrookmenus
 * @author     Oliver Jackson <http://www.hillbrook.qld.edu.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright  2020 Oliver Jackson <http://www.hillbrook.qld.edu.au>)
 */

defined('MOODLE_INTERNAL') || die();

/** 
 * Extend Navigation by overwriting the content of the custommenuitems in $CFG
 * Insert $USER properties into form element by overwriting additionalhtmltopofbody in $CFG
 *
 * @param global_navigation $navigation {@link global_navigation}
 * @return void
 */
function local_hillbrookmenus_extend_navigation(global_navigation $navigation) {
    global $CFG, $USER, $COURSE;

    // get config
    $courseMenuActive = get_config('local_hillbrookmenus', 'activeCourses');
    $nonAcadMenuActive = get_config('local_hillbrookmenus', 'activeNonAcademic');
    $catManagerMenuActive = get_config('local_hillbrookmenus', 'activeCatManager');
    $customMenuActive = get_config('local_hillbrookmenus', 'activeCustomMenu');
    $useCourseFilesReport = get_config('local_hillbrookmenus', 'activeCourseFilesReport');
    $useCourseFilesDownload = get_config('local_hillbrookmenus', 'activeCourseFilesDownload');

    // Start with a Courses menu with the default link if configured
    if ($courseMenuActive) {
        $customMenuItems = add_menu_config_line(get_config('local_hillbrookmenus', 'strActiveCourses'));
        // add an initial menu item to hide selectively with css to "remove" accessibility highlight of first item in bootstrap menu
        // use :: .dropdown-menu a[href="http://hidden.local"] {display: none;}
        $customMenuItems.= add_menu_config_line('-HiddenAutoSelect|http://hidden.local|');
        $customMenuItems.= add_menu_config_line('-All Courses|/course/|');
        $customMenuItems.= add_menu_config_line('-###|#|');
    }

    // Retrieve enrolled courses and add them to the menu arrays if they're visible
    $numcourses = 0;
    $acad_courses = (array) null;
    $acad_courses_list = (array) null;
    $nonacad_courses_list = (array) null;
    if ($courses = enrol_get_my_courses(NULL, 'fullname DESC')) {
        foreach ($courses as $course) {
            // find root category for this course
            global $DB;
            $course_category = $DB->get_record('course_categories',array('id'=>$course->category));
            $category_path = explode('/',$course_category->path);
            $root_category_id = $category_path[1];
            // academic courses in the Courses menu
            if ($root_category_id == get_config('local_hillbrookmenus', 'strCoursesRootCat')) {
                if ($course->visible) {
                    $acad_courses_list[] = array('<i class="fa fa-cubes"></i>'.format_string($course->fullname), '/course/view.php?id='.$course->id, format_string($course->shortname));
                    $numcourses += 1;
                // and hidden course if we have the capability and hidden academic course listing is turned on
                } else if (get_config('local_hillbrookmenus', 'showHiddenCourses') && has_capability('moodle/course:viewhiddencourses', context_system::instance())) {
                    $acad_courses_list[] = array('<i class="fa fa-cubes"></i>'.'<i class="fa fa-cubes"></i>'.format_string($course->fullname), '/course/view.php?id='.$course->id, format_string($course->shortname));
                    $numcourses += 1;
                }
            }
            // non-academic courses in the Non-Academic Menu
            if ($root_category_id != get_config('local_hillbrookmenus', 'strCoursesRootCat')) {
                if ($course->visible) {
                    $nonacad_courses_list[] = array('<i class="fa fa-cubes"></i>'.format_string($course->fullname), '/course/view.php?id='.$course->id, format_string($course->shortname));
                    $numcourses += 1;
                // and hidden course if we have the capability and hidden non-academic course listing is turned on
                } else if (get_config('local_hillbrookmenus', 'showHiddenNonAcademic') && has_capability('moodle/course:viewhiddencourses', context_system::instance())) {
                    $nonacad_courses_list[] = array('<i class="fa fa-cubes"></i>'.format_string($course->fullname), '/course/view.php?id='.$course->id, format_string($course->shortname));
                    $numcourses += 1;
                }
            }
        }

        // sort the course list and add to course menu array
        usort($acad_courses_list, compare_key_0);
        $acad_courses = array_merge($acad_courses_list, $acad_courses);

        // courses were added so we must be logged in so let's add a link to the custom course files report if we have manager capability here
        $courseid = $COURSE->id;
        $coursesn = $COURSE->shortname;
        $coursectxt = context_course::instance($COURSE->id);
        if ($useCourseFilesReport || $useCourseFilesDownload) {
            if ($courseid != 1 && has_capability('moodle/course:update', $coursectxt)) {
                $acad_courses[] = array('###', '#', '');
                if ($useCourseFilesReport) {
                    $acad_courses[] = array('<i class="fa fa-list"></i>Course Files Report', $CFG->wwwroot.get_config('local_hillbrookmenus', 'strCourseFilesReportURL').$courseid, 'Report For '.$coursesn);
                }
                if ($useCourseFilesDownload) {
                    $acad_courses[] = array('<i class="fa fa-list"></i>Course Files Download', $CFG->wwwroot.get_config('local_hillbrookmenus', 'strCourseFilesDownloadURL').$courseid, 'All Files For '.$coursesn);
                }
            }
        }
        // add academic courses menu lines if active
        if ($courseMenuActive) {
            foreach ($acad_courses as $C) {
                $customMenuItems.= add_menu_config_line('-'.$C[0].'|'.$C[1].'|'.$C[2]);
            }
        }
        // add non-academic courses menu and lines (sorted) if active
        usort($nonacad_courses_list, compare_key_0);
        if ($nonAcadMenuActive) {
            $customMenuItems.= add_menu_config_line(get_config('local_hillbrookmenus', 'strActiveNonAcademic'));
            // add an initial menu item to hide selectively with css to "remove" accessibility highlight of first item in bootstrap menu
            // use :: .dropdown-menu a[href="http://hidden.local"] {display: none;}
            $customMenuItems.= add_menu_config_line('-HiddenAutoSelect|http://hidden.local|');
            foreach ($nonacad_courses_list as $C) {
                $customMenuItems.= add_menu_config_line('-'.$C[0].'|'.$C[1].'|'.$C[2]);
            }
        }
    }

    // Array of course categories where user has manager role if configured
    if (user_has_role_assignment($USER->id, 1) && $catManagerMenuActive) {
        $managed_cats = (array) null;

        global $DB;
        // get all course categories (contextlevel=40) where user (userid) has manager role (roleid=1)
        $sql = "SELECT mc.instanceid, cc.name FROM {role_assignments} mra, {context} mc, {course_categories} cc WHERE mra.roleid = :roleid AND mra.userid = :userid AND mc.id = mra.contextid AND mc.contextlevel = :coursecatcontext AND cc.id = mc.instanceid";
        $params['userid'] = $USER->id;
        $params['roleid'] = 1;
        $params['coursecatcontext'] = 40;
        $rs = $DB->get_recordset_sql($sql, $params);
        // for each of these categories create a menu link to view its courses
        foreach ($rs as $record) {
            $menutitle = 'All '.$record->name.' courses';
            $menulabel = $record->name;
            $menuurl = '/course/index.php?categoryid='.$record->instanceid;
            $managed_cats[] = array($menulabel, $menuurl, $menutitle);
        }
        // add other categories menu and lines
        $customMenuItems.= add_menu_config_line(get_config('local_hillbrookmenus', 'strActiveCatManager'));
        // add an initial menu item to hide selectively with css to "remove" accessibility highlight of first item in bootstrap menu
        // use :: .dropdown-menu a[href="http://hidden.local"] {display: none;}
        $customMenuItems.= add_menu_config_line('-HiddenAutoSelect|http://hidden.local|');
        foreach ($managed_cats as $C) {
            $customMenuItems.= add_menu_config_line('-'.$C[0].'|'.$C[1].'|'.$C[2]);
        }
    }

    // Add extra custom menu items if configured
    if ($customMenuActive) {
        $customMenuItems.= get_config('local_hillbrookmenus', 'strCustomMenuContent');
    }
    // SUPER DODGY insert this new custom menu data into site $CFG->custommenuitems config overwriting anything configured in there
    $CFG->custommenuitems = $customMenuItems;

    // SUPER DODGIER append of additionalhtmltopofbody config data with custom Hillbrook html form object
    // hide name data here for use with custom database activity forms and quicklinks block
    
    // check if a user is logged in
    if (isloggedin()) { // && !isguest()) {

        GLOBAL $USER, $CFG;
        $firstname = $USER->firstname;
        $lastname = $USER->lastname;
        $username = $USER->username;
        $userid = $USER->id;

        // print this dodgy form html
        $html .= "\n<!-- dodgy OCJ hack to hide fullname and username etc here for querying with javascript in the database activity for auto form filling -->\n";
        $html .=  '<form name="hbdata_hidden" method="post">'."\n";
        $html .= '<input type="hidden" name="hbdata_firstname" value="'.$firstname.'" />'."\n";
        $html .= '<input type="hidden" name="hbdata_lastname" value="'.$lastname.'" />'."\n";
        $html .= '<input type="hidden" name="hbdata_name" value="'.$firstname.' '.$lastname.'" />'."\n";
        $html .= '<input type="hidden" name="hbdata_code" id="hbdata_code" value="'.$username.'" />'."\n";

        // work on custom profile fields
        require_once("$CFG->dirroot/user/profile/lib.php");
        $hbprofilefields = profile_user_record($userid);
        if (isset($hbprofilefields->yeargroup)) {
            $yeargroup = $hbprofilefields->yeargroup;
            $html .= '<input type="hidden" name="hbdata_yeargroup" id="hbdata_yeargroup" value="'.$yeargroup.'" />'."\n";
        }
        if (isset($hbprofilefields->classgroup)) {
            $classgroup = $hbprofilefields->classgroup;
            $html .= '<input type="hidden" name="hbdata_classgroup" value="'.$classgroup.'" />'."\n";
        }
        if (isset($hbprofilefields->sex)) {
            $gender = $hbprofilefields->sex;
            $html .= '<input type="hidden" name="hbdata_gender" value="'.$gender.'" />'."\n";
        }
        if (isset($hbprofilefields->homeclass)) {
            $homeclass = $hbprofilefields->homeclass;
            $html .= '<input type="hidden" name="hbdata_homeclass" value="'.$homeclass.'" />'."\n";
        }
        
        $html .= "</form>\n";
        $html .= "<!-- end dodgy OCJ hack -->\n";

        // output the OARS login form for use in dashboard HTML block quicklinks
        $html .=<<<EOL
<!-- START ELES LOGIN FORM -->\n<form id="OSScLoginForm" method="POST" action="https://www.studyskillshandbook.com.au/admin/users/login.php?ce=0&group=1&url=http://www.studyskillshandbook.com.au/inside/&clogin=0" target="_blank" style="margin: 0; padding: 0;">\n<input name="do_login" value="Study Skills Handbook" class="ojnav_input" id="ojnav_input" type="hidden">\n<input name="username" value="hillbrook" type="hidden">\n<input name="password" value="removed" type="hidden">\n</form>\n<!-- END ELES LOGIN FORM -->
EOL;
        $html .= "\n";

        // Do the SUPER DODGY addition to the end of site $CFG->additionalhtmltopofbody config
        $CFG->additionalhtmltopofbody = $CFG->additionalhtmltopofbody . $html;
    }

    return TRUE;

}

// format new menu config lines by adding a new line character at the end
function add_menu_config_line($lineText) {
    return $lineText.chr(10);
}

// alphabetically sort array on key 0
function compare_key_0($a, $b) {
    return strnatcmp($a[0], $b[0]);
}
