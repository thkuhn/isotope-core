<?php

/**
 * Isotope eCommerce for Contao Open Source CMS
 *
 * Copyright (C) 2009-2012 Isotope eCommerce Workgroup
 *
 * @package    Isotope
 * @link       http://www.isotopeecommerce.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_nc_notification']['palettes']['iso_order_status_change'] = '{title_legend},title,type;{config_legend},iso_collectionTpl,iso_gallery,iso_document';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_nc_notification']['fields']['iso_collectionTpl'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_nc_notification']['iso_collectionTpl'],
    'exclude'               => true,
    'inputType'             => 'select',
    'options_callback'      => array('Isotope\tl_module', 'getCollectionTemplates'),
    'eval'                  => array('mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                   => "varchar(64) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_nc_notification']['fields']['iso_gallery'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_nc_notification']['iso_gallery'],
    'exclude'               => true,
    'inputType'             => 'select',
    'foreignKey'            => 'tl_iso_gallery.name',
    'eval'                  => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                   => "int(10) unsigned NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_nc_notification']['fields']['iso_document'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_nc_notification']['iso_document'],
    'exclude'               => true,
    'inputType'             => 'select',
    'foreignKey'            => 'tl_iso_document.name',
    'eval'                  => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                   => "int(10) unsigned NOT NULL default '0'",
);