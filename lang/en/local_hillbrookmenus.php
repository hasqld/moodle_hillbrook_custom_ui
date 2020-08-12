<?php
// This file is part of Open Drako - http://opendrako.org/
//
// Open Drako is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Open Drako is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Open Drako.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Hillbrook Menus lang file.
 *
 * @package    local_hillbrookmenus
 * @author     Oliver Jackson <http://www.hillbrook.qld.edu.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright  2020 Oliver Jackson <http://www.hillbrook.qld.edu.au>)
 */

// Plugin Name.
$string['pluginname'] = 'Custom Hillbrook UI';

$string['coursesMenuInfo'] = 'Academic Courses Menu';
$string['coursesMenuInfoDesc'] = 'An academic courses menu item can be added to the bootstrap navigation menu in the top nav-bar. The settings here allow it to be toggled on/off and custom named. A root category ID is needed to identify the category container which holds all the academic courses.<br />If the Configurable Reports Block is installed a menu item can be added to link to a course files report.<br />Similarly, if the Download Centre local plugin is installed a menu item can be added to produce a course files download report.';

$string['activeCourses'] = 'Enable Hillbrook Academic Courses Menu';
$string['strActiveCourses'] = 'Enables Hillbrook academic courses menu item in bootstrap Navigation Menu.';

$string['coursesName'] = 'Academic Courses Menu Name';
$string['strCoursesName'] = 'Menu label for academic courses drop down menu.';

$string['coursesRootCat'] = 'Academic Courses Root Category';
$string['strCoursesRootCat'] = 'Root category for all academic courses.';

$string['showHiddenCourses'] = 'Show Hidden Courses In Academic Courses Menu';
$string['strShowHiddenCourses'] = 'Enables display of hidden courses in academic courses menu item in bootstrap Navigation Menu.';

$string['activeCourseFilesReport'] = 'Enable Course Files Report Item On Academic Courses Menu';
$string['strActiveCourseFilesReport'] = 'Enables course files report item on academic courses menu.<br />Requires the setup of a custom report with the Configurable Report Block.';

$string['courseFilesReportURL'] = 'Course Files Report Base URL';
$string['strCourseFilesReportURL'] = 'Base URL for the course files report to add the course ID to.<br />Example /blocks/configurable_reports/viewreport.php?id=42&courseid=7&filter_courses=';

$string['activeCourseFilesDownload'] = 'Enable Course Files Download Item On Academic Courses Menu';
$string['strActiveCourseFilesDownload'] = 'Enables course files download item on academic courses menu.<br />Requies the Download Centre local plugin first.';

$string['courseFilesDownloadURL'] = 'Course Files Download Base URL';
$string['strCourseFilesDownloadURL'] = 'Base URL for the course download report to add the course ID to.<br />Example /local/downloadcenter/index.php?courseid=';

$string['nonAcademicMenuInfo'] = 'Non-Academic Courses Menu';
$string['nonAcademicMenuInfoDesc'] = 'A non-academic courses menu item can be added to the bootstrap navigation menu in the top nav-bar. The settings here allow it to be toggled on/off and custom named. It will list all courses not found under the root category ID configured for the academic courses menu above.';

$string['activeNonAcademic'] = 'Enable Hillbrook Non-Academic Courses Menu';
$string['strActiveNonAcademic'] = 'Enables Hillbrook non-academic courses menu item in bootstrap Navigation Menu.';

$string['nonAcademicName'] = 'Non-Academic Courses Menu Name';
$string['strNonAcademicName'] = 'Menu label for non-academic courses drop down menu.';

$string['showHiddenNonAcademic'] = 'Show Hidden Courses In Non-Academic Courses Menu';
$string['strShowHiddenNonAcademic'] = 'Enables display of hidden courses in non-academic courses menu item in bootstrap Navigation Menu.';

$string['catManMenuInfo'] = 'Managed Categories Menu';
$string['catManMenuInfoDesc'] = 'A managed categories menu item can be added to the bootstrap navigation menu in the top nav-bar. The settings here allow it to be toggled on/off and custom named. It will list course categories for which the current user has the role of Manager set for the category.';

$string['activeCatManager'] = 'Enable Hillbrook Managed Categories Menu';
$string['strActiveCatManager'] = 'Enables Hillbrook managed categories menu item in bootstrap Navigation Menu. This will list all course categories for which the user has the manager role specifically set on that category';

$string['catManagerName'] = 'Managed Categories Menu Name';
$string['strCatManagerName'] = 'Menu label for managed categories drop down menu.';

$string['customMenuInfo'] = 'Extra Custom Menu';
$string['customMenuInfoDesc'] = 'Because this dodgy local plugin overwrites the built in $CFG variable for custom menus a replication of the theme settings custom menu content is provided here to maintain the custom menu feature. Its content will be added to the end of the menus configured above.';

$string['activeCustomMenu'] = 'Enable Hillbrook Extra Custom Menu';
$string['strActiveCustomMenu'] = 'Enables Hillbrook free custom menu item in bootstrap Navigation Menu. This will render the contents of the text area below as a final menu.';

$string['customMenuContent'] = 'Custom Menu Content';
$string['strCustomMenuContent'] = 'A extra custom menu may be configured here. Enter each menu item on a new line with format: menu text, a link URL (optional, not for a top menu item with sub-items), a tooltip title (optional) and a language code or comma-separated list of codes (optional, for displaying the line to users of the specified language only), separated by pipe characters. Lines starting with a hyphen will appear as menu items in the previous top level menu and ### makes a divider. For example:

<pre>
Custom Menu
-User Profile|/user/profile.php
-Course search|/course/search.php
-###
-FAQ|https://superfaq.xyz/faq
-Qual es su nombre|https://nombre.xyz/queso||es
Mobile app|https://excellentapp.xyz/app|Download our app
</pre>

To prevent bootstrap menu accessibility auto-highlight of first item, add the following initial menu item to hide selectively with css:
<pre>  -HiddenAutoSelect|http://hidden.local| </pre>
Use this css rule to hide:
<pre>  .dropdown-menu a[href="http://hidden.local"] {display: none;} </pre>

The other three menus above automatically add this item to the top of each.
'
;

$string['privacy:metadata'] = 'The Custom Hillbrook Menus plugin does not store any personal data.';
