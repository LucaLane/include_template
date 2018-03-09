<?php
defined('TYPO3_MODE') || die();

$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['include_template'] = 'template/Configuration/RTE/Default.yaml';

// Define TypoScript as content rendering template
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'includetemplate/Configuration/TypoScript/';
