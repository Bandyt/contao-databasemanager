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
class databasemanager extends BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'databasemanager';

	private $functions;
	
	private function addTable($bolAdd,$intFields,$strTablename,$arrFields)
	{
		if($bolAdd==false)
		{
			$this->Template = new BackendTemplate('dbm_addtable');
			$this->Template->headline='Adding table "' . $strTablename . '" with ' . $intFields . ' fields';
			$this->Template->numFields=$intFields;
			$this->Template->tablename=$strTablename;
			$this->Template->action = 'contao/main.php?do=dbmanager_databasemanager';
		}
		else
		{
			$this->Template = new BackendTemplate('dbm_addtable_result');
			$this->Template->headline='New table ' . $strTablename;
			$this->Template->tablename=$strTablename;
			$this->Template->numFields=$intFields;
			$this->Template->fields=$arrFields;
			$strSQL='CREATE TABLE ' . $strTablename . '(';
			$i=0;
			foreach($arrFields as $field)
			{
				$i++;
				$field=$this->functions->fieldGenerateCreateStatement($field['name'],$field['type'],$field['length'],$field['attributes'],$field['null'],$field['defaulttype'],$field['defaultvalue'],$field['ai']);
				$strSQL.=$field;
				//Add , at the end of line if not the last one
				if($i!=$intFields){$strSQL.=',';}
			}
			$strSQL.=')';
			$this->Template->SQL=$strSQL;
		}
	}
	
	private function listTables()
	{
		$this->Template = new BackendTemplate('dbm_tables');
		$this->Template->headline='Tables';
		$this->Template->backtitle = 'Back';
		$this->Template->explain = 'Here you find all tables in the database. If you want to add a new table, use the "add table" fields.';
		$this->Template->href = $this->getReferer(ENCODE_AMPERSANDS);
		$this->Template->action = 'contao/main.php?do=dbmanager_databasemanager';
		$objTables=$this->Database->listTables();
		foreach($objTables as $table)
		{
			$arrTables[]=array(
				'name'=>$table,
				'detailsurl'=>'contao/main.php?do=dbmanager_databasemanager&mode=tabledetails&name=' . $table,
				'contenturl'=>'contao/main.php?do=dbmanager_databasemanager&mode=tablecontent&name=' . $table
			);
		}
		$this->Template->tables=$arrTables;
	}
	
	private function tableDetails($strTableName)
	{
		$this->Template = new BackendTemplate('dbm_tabledetails');
		$this->Template->headline='Table details: ' . $strTableName;
		$this->Template->table=$strTableName;
		$this->Template->fields=$this->Database->listFields($strTableName);
		$this->Template->tableSize=$this->Database->getSizeOf($strTableName);
		$this->Template->nextId=$this->Database->getNextId($strTableName);
		$objTable=$this->Database->prepare("SELECT count(*) as cnt FROM " . $strTableName)->execute();
		$this->Template->rows=$objTable->cnt;
		//$this->Template->fields=$this->Database->
		
	}
	
	private function tableContent($strTableName)
	{
		$this->Template = new BackendTemplate('dbm_tablecontent');
		$this->Template->headline='Table content: ' . $strTableName;
		$this->Template->submit='Submit';
		
		//Get content
		if($this->Input->post('num_rows')=='' || !$this->Input->post('num_rows')){$limit=30;}else{$limit=$this->Input->post('num_rows');}
		if($this->Input->post('start_row')=='' || !$this->Input->post('start_row')){$start=0;}else{$start=$this->Input->post('start_row');}
		if($this->Input->post('sortby')=='' || !$this->Input->post('sortby')){$sortby='';}else{$sortby=' ORDER BY ' . $this->Input->post('sortby');}
		if($this->Input->post('sort')=='' || !$this->Input->post('sort')){$sort='';}else{$sort=$this->Input->post('sort');}
		if($sort!='' && $sortby!=''){$sorting=$sortby . ' ' . $sort;}else{$sorting='';}
		$strQuery="SELECT * FROM " . $strTableName  . " " . $sorting . " LIMIT " . $start . "," . $limit;
		$objContent=$this->Database->prepare($strQuery)->execute();
		for($i=0;$i<$objQuery->numFields;$i++)
			{
				$arrField=$objQuery->fetchField($i);
				$arrFields[]=$arrField['name'];
			}
		$this->Template->num_rows=$limit;
		$this->Template->start_row=$start;
		$this->Template->sortby=$this->Input->post('sortby');
		$this->Template->sort=$sort;
		$this->Template->fields=$arrFields;
		$this->Template->query=$strQuery;
		while($objContent->next())
		{
			 $arrRows[]=array(
				'row_content'=>$objContent->fetchRow()
			);
		}
		$arrFields=$this->Database->listFields($strTableName);
		$this->Template->fields=$arrFields;
		$this->Template->rows=$arrRows;
	}
	
	/**
	 * Generate module
	 */
	protected function compile()
	{
		$this->import('Database');
		$this->functions = new databasemanager_functions();
		if($this->Input->post('submit')!='')
		{
			$this->log("Submited data with action [" . $this->Input->post('action') . "]", 'databasemanager.compile()', TL_INFO);
			switch($this->Input->post('action'))
			{
				case 'addtable':
					$this->addTable(false,$this->Input->post('num_fields'),$this->Input->post('tablename'),array());
					break;
				case 'addtablewithfields':
					$arrNames=$this->Input->post('name');
					$arrTypes=$this->Input->post('type');
					$arrLength=$this->Input->post('length');
					$arrDefaulttype=$this->Input->post('defaulttype');
					$arrDefaultvalue=$this->Input->post('defaultvalue');
					$arrAttributes=$this->Input->post('attributes');
					$arrNull=$this->Input->post('null');
					$arrIndex=$this->Input->post('index');
					$arrAI=$this->Input->post('auto_increment');
					for($i=0;$i<$this->Input->post('num_fields');$i++)
					{
						$arrFields[]=array(
							'name'=>$arrNames[$i],
							'type'=>$arrTypes[$i],
							'length'=>$arrLength[$i],
							'defaulttype'=>$arrDefaulttype[$i],
							'defaultvalue'=>$arrDefaultvalue[$i],
							'attribute'=>$arrAttributes[$i],
							'null'=>$arrNull[$i],
							'index'=>$arrIndex[$i],
							'ai'=>$arrAI[$i],
						);
					}
					$this->addTable(true,$this->Input->post('num_fields'),$this->Input->post('tablename'),$arrFields);
					break;
			}
		}
		else
		{
			$this->log("No submit. Mode is [" . $this->Input->get('mode') . "]", 'databasemanager.compile()', TL_INFO);
			switch($this->Input->get('mode'))
			{
				case '':
					$this->listTables();
					break;
				case 'listtables':
					$this->listTables();
					break;
				case 'tabledetails':
					$this->tableDetails($this->Input->get('name'));
					break;
				case 'tablecontent':
					$this->tableContent($this->Input->get('name'));
					break;
				case 'addtable':
					$this->addTable(false,$this->Input->post('num_fields'),'',array());
					break;
			}
		}
		
	}
}

?>