<?php

/**
 * Isotope eCommerce for Contao Open Source CMS
 *
 * Copyright (C) 2008-2012 Isotope eCommerce Workgroup
 *
 * @package    Isotope
 * @link       http://www.isotopeecommerce.com
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 */

namespace Isotope\Factory;

class InvoiceTemplate
{

    /**
     * Cache of gallery classes
     * @var array
     */
    private static $arrClasses;

    /**
     * Build an invoice template based on given data
     * @param string
     * @param \Isotope\Interface\IsotopeProductCollection
     * @return Isotope\Interface\IsotopeInvoiceTemplate
     */
    public static function build($strClass, $objCollection)
    {
        // Try config class if none is given
        if ($strClass == '' || !class_exists('\Isotope\Invoice\\' . $strClass)) {
            //$strClass = Isotope::getInstance()->getConfig()->gallery;
        }

        // Use Standard class if no other is available
        if ($strClass == '' || !class_exists('\Isotope\Invoice\\' . $strClass)) {
            $strClass = 'Standard';
        }

        $strClass = '\Isotope\Invoice\\' . $strClass;

        return new $strClass($objCollection);
    }

    /**
     * Find all classes and cache the result
     * @return array
     */
    public static function getClasses()
    {
        if (null === static::$arrClasses) {

            static::$arrClasses = array();
            $arrNamespaces = \NamespaceClassLoader::getClassLoader()->getPrefixes();

            if (is_array($arrNamespaces['Isotope/Invoice'])) {
                foreach ($arrNamespaces['Isotope/Invoice'] as $strPath) {
                    foreach (scan($strPath . '/Isotope/Invoice') as $strFile) {

                        $strClass = pathinfo($strFile, PATHINFO_FILENAME);
                        $strNamespacedClass = '\Isotope\Invoice\\' . $strClass;

                        if (is_a($strNamespacedClass, 'Isotope\Interfaces\IsotopeInvoiceTemplate', true)) {
                            static::$arrClasses[$strClass] = $strNamespacedClass;
                        }
                    }
                }
            }
        }

        return static::$arrClasses;
    }

    /**
     * Return labels for all invoice templates
     * @return array
     */
    public static function getClassLabels()
    {
        $arrLabels = array();

        foreach (static::getCLasses() as $strClass => $strNamespacedClass) {
            $arrLabels[$strClass] = call_user_func(array($strNamespacedClass, 'getClassLabel'));
        }

        return $arrLabels;
    }
}
