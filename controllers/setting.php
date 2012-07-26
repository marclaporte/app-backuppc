<?php

/**
 * BackupPC controller.
 *
 * @category   Apps
 * @package    BackupPC
 * @subpackage Controllers
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

// Exceptions
//-----------

use \clearos\apps\base\Engine_Exception as Engine_Exception;

clearos_load_library('base/Engine_Exception');

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * BackupPC setting controller.
 *
 * @category   Apps
 * @package    BackupPC
 * @subpackage Controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2012 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/backuppc/
 */

class Setting extends ClearOS_Controller
{
    /**
     * BackupPC default controller
     *
     * @return view
     */

    function index()
    {
        // Load libraries
        //---------------

        $this->load->library('backuppc/BackupPC');
        $this->lang->load('backuppc');

        // Set validation rules
        //---------------------
         
        if ($this->input->post('submit')) {
            $this->form_validation->set_policy('password', 'backuppc/BackupPC', 'validate_password', TRUE);
            $this->form_validation->set_policy('verify', 'backuppc/BackupPC', 'validate_password', TRUE);
        }

        $form_ok = $this->form_validation->run();

        // Extra validation
        //-----------------

        if ($this->input->post('submit')) {
            $password = $this->input->post('password');
            $verify = $this->input->post('verify');
        }

        if ($form_ok) {
            if ($password !== $verify) {
                $this->form_validation->set_error('new_verify', lang('base_password_and_verify_do_not_match'));
                $this->form_validation->set_error('verify', lang('base_password_and_verify_do_not_match'));
                $form_ok = FALSE;
            }
        }

        // Handle form submit
        //-------------------

        if (($this->input->post('submit')) && $form_ok) {
            try {
                $this->backuppc->set_password('backuppc', $password);

                $this->page->set_message(lang('backuppc_password_updated'), 'info');
                redirect('/backuppc');
            } catch (Exception $e) {
                $this->page->view_exception($e);
            }
        }

        // Load view data
        //---------------

        // Load views
        //-----------

        $this->page->view_form('backuppc/setting', $data, lang('backuppc_database'));
    }
}
