<?php
defined('TYPO3_MODE') || die();
/***************
 * Default TypoScript
 */
// @extensionScannerIgnoreLine
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'include_template',
    'Configuration/TypoScript',
    'Default TypoScript'
);
