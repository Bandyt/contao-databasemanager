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
 * -------------------------------------------------------------------------
 * BACK END MODULES
 * -------------------------------------------------------------------------
 */
$GLOBALS['BE_MOD']['dbmanager']['dbmanager_databasemanager']= array
 (
   'callback'   => 'databasemanager'
 );
$GLOBALS['BE_MOD']['dbmanager']['dbmanager_query']= array
 (
   'callback'   => 'databasemanager_query'
 );
/**
 * -------------------------------------------------------------------------
 * FRONT END MODULES
 * -------------------------------------------------------------------------
 *
 * List all front end modules and their class names.
 * 
 *   $GLOBALS['FE_MOD'] = array
 *   (
 *       'group_1' => array
 *       (
 *           'module_1' => 'Contentlass',
 *           'module_2' => 'Contentlass'
 *       )
 *   );
 * 
 * Use function array_insert() to modify an existing CTE array.
 */
 

/**
 * -------------------------------------------------------------------------
 * CONTENT ELEMENTS
 * -------------------------------------------------------------------------
 *
 * List all content elements and their class names.
 * 
 *   $GLOBALS['TL_CTE'] = array
 *   (
 *       'group_1' => array
 *       (
 *           'cte_1' => 'Contentlass',
 *           'cte_2' => 'Contentlass'
 *       )
 *   );
 * 
 * Use function array_insert() to modify an existing CTE array.
 */
 

/**
 * -------------------------------------------------------------------------
 * BACK END FORM FIELDS
 * -------------------------------------------------------------------------
 *
 * List all back end form fields and their class names.
 * 
 *   $GLOBALS['BE_FFL'] = array
 *   (
 *       'input'  => 'Class',
 *       'select' => 'Class'
 *   );
 * 
 * Use function array_insert() to modify an existing FFL array.
 */


/**
 * -------------------------------------------------------------------------
 * FRONT END FORM FIELDS
 * -------------------------------------------------------------------------
 *
 * List all form fields and their class names.
 * 
 *   $GLOBALS['TL_FFL'] = array
 *   (
 *       'input'  => Class,
 *       'select' => Class
 *   );
 * 
 * Use function array_insert() to modify an existing FFL array.
 */


/**
 * -------------------------------------------------------------------------
 * CACHE TABLES
 * -------------------------------------------------------------------------
 *
 * These tables are used to cache data and can be truncated using back end 
 * module "clear cache".
 * 
 *   $GLOBALS['TL_CACHE'] = array
 *   (
 *       'table_1',
 *       'table_2'
 *   );
 * 
 * Use function array_insert() to modify an existing cache array.
 */


/**
 * -------------------------------------------------------------------------
 * HOOKS
 * -------------------------------------------------------------------------
 *
 * Hooking allows you to register one or more callback functions that are 
 * called on a particular event in a specific order. Thus, third party 
 * extensions can add functionality to the core system without having to
 * modify the source code.
 * 
 *   $GLOBALS['TL_HOOKS'] = array
 *   (
 *       'hook_1' => array
 *       (
 *           array('Class', 'Method'),
 *           array('Class', 'Method')
 *       )
 *   );
 * 
 * Use function array_insert() to modify an existing hooks array.
 */


/**
 * -------------------------------------------------------------------------
 * PAGE TYPES
 * -------------------------------------------------------------------------
 *
 * Page types and their corresponding front end controller class.
 * 
 *   $GLOBALS['TL_PTY'] = array
 *   (
 *       'type_1' => 'PageType1',
 *       'type_2' => 'PageType2'
 *   );
 * 
 * Use function array_insert() to modify an existing page types array.
 */
 
?>