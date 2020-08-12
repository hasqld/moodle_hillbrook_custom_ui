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
 * Add new custom options in Navigation Menu.
 * Add some user specific form elements to top of document body
 *  for reference with javascript elswhere in Moodle activities.
 *
 * @package    local_hillbrookmenus
 * @author     Oliver Jackson <http://www.hillbrook.qld.edu.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright  2020 Oliver Jackson <http://www.hillbrook.qld.edu.au>)
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2020063000;
$plugin->requires  = 2016120500;
$plugin->component = 'local_hillbrookmenus';
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '1.2';
