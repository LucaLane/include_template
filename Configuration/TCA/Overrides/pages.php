<?php
defined('TYPO3_MODE') || die();

call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'include_template';

    /**
     * Default PageTS
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        '../../../template/Configuration/PageTS/All.txt',
        'Default PageTs'
    );
});
