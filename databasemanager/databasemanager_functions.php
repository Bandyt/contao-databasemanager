<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2012 Andreas Koob 
 * @author     Andreas Koob 
 * @package    databasemanager 
 * @license    LGPL 
 * @filesource
 */


/**
 * Class databasemanager_functions
 *
 * @copyright  2012 Andreas Koob 
 * @author     Andreas Koob 
 * @package    Controller
 */
class databasemanager_functions extends frontend
{
	public function __construct()
	{
		$this->import('Database');
	}
	
	public function fieldGenerateCreateStatement($name, $type, $length, $attributes, $null, $defaulttype, $defaultvalue, $auto_increment)
	{
		$strSQL='`' . $name . '` ' . $type;
		//TODO: Check length
		if($length!=''){$strSQL.='(' . $length . ')';}
		//TODO: Check attributes
		if($attributes!='NONE'){$strSQL.=' ' . $attributes;}
		//TODO: Check null
		if($null!=''){$strSQL.=' NULL';}else{$strSQL.=' NOT NULL';}
		//TODO: Check default
		if($defaulttype!='None'){
			$strSQL.=' DEFAULT ';
			if($defaulttype=='NULL'){$strSQL.="'NULL'";}
			if($defaulttype=='asdefined'){$strSQL.="'" . $defaultvalue . "'";}
		}
		//TODO: Check auto_increment
		if($auto_increment!=''){$strSQL.=' AUTO_INCREMENT';}
		return $strSQL;
	}
}

?>