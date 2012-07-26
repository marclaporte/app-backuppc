<?php

/**
 * BackupPC
 *
 * @category   Apps
 * @package    BackupPC
 * @subpackage Controllers
 * @author     Tim Burgess <trburgess@gmail.com>
 * @copyright  2011-2012 ClearFoundation
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
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * BackupPC Controller.
 *
 * @category   Apps
 * @package    BackupPC
 * @subpackage Controllers
 * @author     Tim Burgess <trburgess@gmail.com>
 * @copyright  2011-2012 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/backuppc/
 */


use \Exception as Exception; 

class BackupPC extends ClearOS_Controller {

	function index() 
	{

        // Load libraries (we have none but they might look like)
        //---------------

        $this->lang->load('backuppc');

        // Load views (default summary.php)
        //--------------

        $views = array(
            'backuppc/server',
            'backuppc/setting'
        );

        $this->page->view_forms($views, lang('backuppc_backup'));

	}

}

?>
