<?php

namespace RectorPrefix20210825\TYPO3\CMS\Extbase\Mvc;

if (\class_exists('TYPO3\\CMS\\Extbase\\Mvc\\Request')) {
    return;
}
class Request
{
    /**
     * @return string
     */
    public function getControllerExtensionName()
    {
        return 'extensionName';
    }
}
