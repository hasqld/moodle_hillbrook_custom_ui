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
 * Settings Custom Hillbrook Menus local plugin.
 *
 * @package    local_hillbrookmenus
 * @author     Oliver Jackson <http://www.hillbrook.qld.edu.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright  2020 Oliver Jackson <http://www.hillbrook.qld.edu.au>)
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_hillbrookmenus', get_string('pluginname', 'local_hillbrookmenus'));

    // This is the descriptor for the Courses Menu
    $name = 'local_hillbrookmenus/coursesMenuInfo';
    $heading = get_string('coursesMenuInfo', 'local_hillbrookmenus');
    $information = get_string('coursesMenuInfoDesc', 'local_hillbrookmenus');
    $settings->add(new admin_setting_heading($name, $heading, $information));

    // Courses Menu
    $name = 'local_hillbrookmenus/activeCourses';
    $title = get_string('activeCourses', 'local_hillbrookmenus');
    $description = get_string('strActiveCourses', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // Courses Menu Name
    $name = 'local_hillbrookmenus/strActiveCourses';
    $title = get_string('coursesName', 'local_hillbrookmenus');
    $description = get_string('strCoursesName', 'local_hillbrookmenus');
    $default = 'Courses|#|Enrolled Courses';
    $settings->add(new admin_setting_configtext($name, $title, $description, $default));

    // Courses Root Category Filter
    $name = 'local_hillbrookmenus/strCoursesRootCat';
    $title = get_string('coursesRootCat', 'local_hillbrookmenus');
    $description = get_string('strCoursesRootCat', 'local_hillbrookmenus');
    $default = '';
    $settings->add(new admin_setting_configtext($name, $title, $description, $default));

    // Courses Menu - Show Hidden Items
    $name = 'local_hillbrookmenus/showHiddenCourses';
    $title = get_string('showHiddenCourses', 'local_hillbrookmenus');
    $description = get_string('strShowHiddenCourses', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // Courses Files Report Item
    $name = 'local_hillbrookmenus/activeCourseFilesReport';
    $title = get_string('activeCourseFilesReport', 'local_hillbrookmenus');
    $description = get_string('strActiveCourseFilesReport', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // Courses Files Report URL Base
    $name = 'local_hillbrookmenus/strCourseFilesReportURL';
    $title = get_string('courseFilesReportURL', 'local_hillbrookmenus');
    $description = get_string('strCourseFilesReportURL', 'local_hillbrookmenus');
    $default = '';
    $settings->add(new admin_setting_configtext($name, $title, $description, $default));

    // Courses Files Download Item
    $name = 'local_hillbrookmenus/activeCourseFilesDownload';
    $title = get_string('activeCourseFilesDownload', 'local_hillbrookmenus');
    $description = get_string('strActiveCourseFilesDownload', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // Courses Files Download URL Base
    $name = 'local_hillbrookmenus/strCourseFilesDownloadURL';
    $title = get_string('courseFilesDownloadURL', 'local_hillbrookmenus');
    $description = get_string('strCourseFilesDownloadURL', 'local_hillbrookmenus');
    $default = '';
    $settings->add(new admin_setting_configtext($name, $title, $description, $default));

    // This is the descriptor for the Non-Academic Menu
    $name = 'local_hillbrookmenus/nonAcademicMenuInfo';
    $heading = get_string('nonAcademicMenuInfo', 'local_hillbrookmenus');
    $information = get_string('nonAcademicMenuInfoDesc', 'local_hillbrookmenus');
    $settings->add(new admin_setting_heading($name, $heading, $information));

    // NonAcademic Menu
    $name = 'local_hillbrookmenus/activeNonAcademic';
    $title = get_string('activeNonAcademic', 'local_hillbrookmenus');
    $description = get_string('strActiveNonAcademic', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // NonAcademic Menu Name
    $name = 'local_hillbrookmenus/strActiveNonAcademic';
    $title = get_string('nonAcademicName', 'local_hillbrookmenus');
    $description = get_string('strNonAcademicName', 'local_hillbrookmenus');
    $default = 'Non-Academic|#|Additional Courses';
    $settings->add(new admin_setting_configtext($name, $title, $description, $default));

    // NonAcademic Menu - Show Hidden Items
    $name = 'local_hillbrookmenus/showHiddenNonAcademic';
    $title = get_string('showHiddenNonAcademic', 'local_hillbrookmenus');
    $description = get_string('strShowHiddenNonAcademic', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // This is the descriptor for the Category Manager Menu
    $name = 'local_hillbrookmenus/catManMenuInfo';
    $heading = get_string('catManMenuInfo', 'local_hillbrookmenus');
    $information = get_string('catManMenuInfoDesc', 'local_hillbrookmenus');
    $settings->add(new admin_setting_heading($name, $heading, $information));

    // Category Manager Menu
    $name = 'local_hillbrookmenus/activeCatManager';
    $title = get_string('activeCatManager', 'local_hillbrookmenus');
    $description = get_string('strActiveCatManager', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // Category Manager Menu Name
    $name = 'local_hillbrookmenus/strActiveCatManager';
    $title = get_string('catManagerName', 'local_hillbrookmenus');
    $description = get_string('strCatManagerName', 'local_hillbrookmenus');
    $default = 'Other|#|Subject Areas Management';
    $settings->add(new admin_setting_configtext($name, $title, $description, $default));

    // This is the descriptor for the Extra Custom Menu
    $name = 'local_hillbrookmenus/customMenuInfo';
    $heading = get_string('customMenuInfo', 'local_hillbrookmenus');
    $information = get_string('customMenuInfoDesc', 'local_hillbrookmenus');
    $settings->add(new admin_setting_heading($name, $heading, $information));

    // Extra Custom Menu
    $name = 'local_hillbrookmenus/activeCustomMenu';
    $title = get_string('activeCustomMenu', 'local_hillbrookmenus');
    $description = get_string('strActiveCustomMenu', 'local_hillbrookmenus');
    $default = 0;
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, $default));

    // Extra Custom Menu Content
    $name = 'local_hillbrookmenus/strCustomMenuContent';
    $title = get_string('customMenuContent', 'local_hillbrookmenus');
    $description = get_string('strCustomMenuContent', 'local_hillbrookmenus');
    $default = '';
    $settings->add(new admin_setting_configtextarea($name, $title, $description, $default));

    $ADMIN->add('localplugins', $settings);
}
