<?php

declare (strict_types=1);
namespace RectorPrefix20210510\Symplify\SetConfigResolver\Config;

use RectorPrefix20210510\Symfony\Component\Config\FileLocator;
use RectorPrefix20210510\Symfony\Component\DependencyInjection\ContainerBuilder;
use RectorPrefix20210510\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use RectorPrefix20210510\Symplify\Astral\Exception\ShouldNotHappenException;
use RectorPrefix20210510\Symplify\SetConfigResolver\SetResolver;
use Symplify\SmartFileSystem\SmartFileInfo;
final class SetsParameterResolver
{
    /**
     * @var string
     */
    private const SETS = 'sets';
    /**
     * @var SetResolver
     */
    private $setResolver;
    public function __construct(SetResolver $setResolver)
    {
        $this->setResolver = $setResolver;
    }
    /**
     * @param SmartFileInfo[] $fileInfos
     * @return SmartFileInfo[]
     */
    public function resolveFromFileInfos(array $fileInfos) : array
    {
        $setFileInfos = [];
        foreach ($fileInfos as $fileInfo) {
            $setsNames = $this->resolveSetsFromFileInfo($fileInfo);
            foreach ($setsNames as $setsName) {
                $setFileInfos[] = $this->setResolver->detectFromName($setsName);
            }
        }
        return $setFileInfos;
    }
    /**
     * @return string[]
     */
    private function resolveSetsFromFileInfo(SmartFileInfo $configFileInfo) : array
    {
        if ($configFileInfo->hasSuffixes(['yml', 'yaml'])) {
            throw new ShouldNotHappenException('Only PHP config suffix is supported now. Migrete your Symfony config to PHP');
        }
        return $this->resolveSetsParameterFromPhpFileInfo($configFileInfo);
    }
    /**
     * @return string[]
     */
    private function resolveSetsParameterFromPhpFileInfo(SmartFileInfo $configFileInfo) : array
    {
        // php file loader
        $containerBuilder = new ContainerBuilder();
        $phpFileLoader = new PhpFileLoader($containerBuilder, new FileLocator());
        $phpFileLoader->load($configFileInfo->getRealPath());
        if (!$containerBuilder->hasParameter(self::SETS)) {
            return [];
        }
        return (array) $containerBuilder->getParameter(self::SETS);
    }
}