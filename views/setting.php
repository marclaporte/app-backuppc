<?php

/**
 * BackupPC view.
 *
 * @category   ClearOS
 * @package    BackupPC
 * @subpackage Views
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2012 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/backuppc/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//  
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('backuppc');

///////////////////////////////////////////////////////////////////////////////
// Password set
///////////////////////////////////////////////////////////////////////////////

echo infobox_highlight(
    lang('backuppc_management_tool'),
    lang('backuppc_management_tool_help') . '<br><br>' .
    "<p align='center'>" .  
    anchor_custom('/backuppc', lang('backuppc_go_to_management_tool'), 'high', array('target' => '_blank')) . 
    "</p>"
);

echo form_open('backuppc');
echo form_header(lang('base_password'));

echo field_password('password', '', lang('base_password'));
echo field_password('verify', '', lang('base_verify'));

echo field_button_set(
    array(form_submit_update('submit', 'high'))
);

echo form_footer();
echo form_close();
