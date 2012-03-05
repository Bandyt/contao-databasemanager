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
 * Class databasemanager 
 *
 * @copyright  2012 Andreas Koob 
 * @author     Andreas Koob 
 * @package    Controller
 */
class databasemanager_query extends BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'dbm_query';
	
	/**
	 * Generate module
	 */
	protected function compile()
	{
		$this->import('Database');
		if($this->Input->post('submit')!='')
		{
			$this->Template->query=$this->Input->post('query');
			try
			{
				$objQuery=$this->Database->prepare($this->Input->post('query'))->executeUncached();
				
				for($i=0;$i<$objQuery->numRows;$i++)
				{
					 $arrRows[]=array(
						'row_content'=>$objQuery->fetchRow()
					);
				}
				for($i=0;$i<$objQuery->numFields;$i++)
				{
					$arrField=$objQuery->fetchField($i);
					$arrFields[]=$arrField['name'];
				}
			}
			catch(Exception $e)
			{
				$this->Template->hasErrors=true;
				$this->Template->errors=$e->getMessage();
			}
			
			$this->Template->numRows=$objQuery->numRows;
			$this->Template->numFields=$objQuery->numFields;
			print_r($objQuery->resResult);
			$this->Template->fields=$arrFields;
			$this->Template->rows=$arrRows;
			$this->Template->hasquery='1';
		}
		
		$this->Template->headline='Query database';
		$this->Template->explain='This page let you query contaos database. Enter a SQL query in the field at the bottom and click "query" to see the result.';
	}
}

?>