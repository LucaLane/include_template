<?php
namespace Lane\IncludeTemplate\DataProcessing;
use TYPO3\CMS\Core\TypoScript\Parser\TypoScriptParser;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
/**
 * Minimal TypoScript configuration
 * Assign all available typoscript constants for a key to template view, the
 * default key that is used is `page` and the default variable is `constants`.
 *
 * 10 = Cabag\CabagTemplate\DataProcessing\ConstantsProcessor
 *
 *
 * Advanced TypoScript configuration
 *
 * 10 = Cabag\CabagTemplate\DataProcessing\ConstantsProcessor
 * 10 {
 *   key = page
 *   as = constants
 * }
 */
class ConstantsProcessor implements DataProcessorInterface
{
    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        // The key to process
        $key = $cObj->stdWrapValue('key', $processorConfiguration);
        if (empty($key)) {
            $key = 'page';
        }
        // Collect variables
        $flatConstants = $this->getFlatConstants($key);
        $typoScriptParser = GeneralUtility::makeInstance(TypoScriptParser::class);
        $typoScriptParser->parse($flatConstants);
        $typoScriptArray = $typoScriptParser->setup;
        $typoScriptService = GeneralUtility::makeInstance(TypoScriptService::class);
        $constants = $typoScriptService->convertTypoScriptArrayToPlainArray($typoScriptArray);
        // Set the target variable
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration);
        if (!empty($targetVariableName)) {
            $processedData[$targetVariableName] = $constants;
        } else {
            $processedData['constants'] = $constants;
        }
        return $processedData;
    }
    /**
     * @param string $key
     * @return array
     */
    public function getFlatConstants($key)
    {
        $flatvariables = '';
        $prefix = $key . '.';
        if (!isset($GLOBALS['TSFE']->tmpl->flatSetup)
            || !is_array($GLOBALS['TSFE']->tmpl->flatSetup)
            || count($GLOBALS['TSFE']->tmpl->flatSetup) === 0) {
            $GLOBALS['TSFE']->tmpl->generateConfig();
        }
        foreach ($GLOBALS['TSFE']->tmpl->flatSetup as $constant => $value) {
            if (strpos($constant, $prefix) === 0) {
                $flatvariables .= substr($constant, strlen($prefix)) . ' = ' . $value . PHP_EOL;
            }
        }
        return $flatvariables;
    }
}