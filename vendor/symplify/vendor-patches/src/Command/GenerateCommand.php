<?php

declare (strict_types=1);
namespace RectorPrefix20210706\Symplify\VendorPatches\Command;

use RectorPrefix20210706\Symfony\Component\Console\Input\InputInterface;
use RectorPrefix20210706\Symfony\Component\Console\Output\OutputInterface;
use RectorPrefix20210706\Symplify\PackageBuilder\Composer\VendorDirProvider;
use RectorPrefix20210706\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand;
use RectorPrefix20210706\Symplify\PackageBuilder\Console\ShellCode;
use RectorPrefix20210706\Symplify\VendorPatches\Composer\ComposerPatchesConfigurationUpdater;
use RectorPrefix20210706\Symplify\VendorPatches\Console\GenerateCommandReporter;
use RectorPrefix20210706\Symplify\VendorPatches\Differ\PatchDiffer;
use RectorPrefix20210706\Symplify\VendorPatches\Finder\OldToNewFilesFinder;
use RectorPrefix20210706\Symplify\VendorPatches\PatchFileFactory;
final class GenerateCommand extends \RectorPrefix20210706\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand
{
    /**
     * @var \Symplify\VendorPatches\Finder\OldToNewFilesFinder
     */
    private $oldToNewFilesFinder;
    /**
     * @var \Symplify\VendorPatches\Differ\PatchDiffer
     */
    private $patchDiffer;
    /**
     * @var \Symplify\VendorPatches\Composer\ComposerPatchesConfigurationUpdater
     */
    private $composerPatchesConfigurationUpdater;
    /**
     * @var \Symplify\PackageBuilder\Composer\VendorDirProvider
     */
    private $vendorDirProvider;
    /**
     * @var \Symplify\VendorPatches\PatchFileFactory
     */
    private $patchFileFactory;
    /**
     * @var \Symplify\VendorPatches\Console\GenerateCommandReporter
     */
    private $generateCommandReporter;
    public function __construct(\RectorPrefix20210706\Symplify\VendorPatches\Finder\OldToNewFilesFinder $oldToNewFilesFinder, \RectorPrefix20210706\Symplify\VendorPatches\Differ\PatchDiffer $patchDiffer, \RectorPrefix20210706\Symplify\VendorPatches\Composer\ComposerPatchesConfigurationUpdater $composerPatchesConfigurationUpdater, \RectorPrefix20210706\Symplify\PackageBuilder\Composer\VendorDirProvider $vendorDirProvider, \RectorPrefix20210706\Symplify\VendorPatches\PatchFileFactory $patchFileFactory, \RectorPrefix20210706\Symplify\VendorPatches\Console\GenerateCommandReporter $generateCommandReporter)
    {
        $this->oldToNewFilesFinder = $oldToNewFilesFinder;
        $this->patchDiffer = $patchDiffer;
        $this->composerPatchesConfigurationUpdater = $composerPatchesConfigurationUpdater;
        $this->vendorDirProvider = $vendorDirProvider;
        $this->patchFileFactory = $patchFileFactory;
        $this->generateCommandReporter = $generateCommandReporter;
        parent::__construct();
    }
    protected function configure() : void
    {
        $this->setDescription('Generate patches from /vendor directory');
    }
    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute($input, $output) : int
    {
        $vendorDirectory = $this->vendorDirProvider->provide();
        $oldAndNewFileInfos = $this->oldToNewFilesFinder->find($vendorDirectory);
        $composerExtraPatches = [];
        $addedPatchFilesByPackageName = [];
        foreach ($oldAndNewFileInfos as $oldAndNewFileInfo) {
            if ($oldAndNewFileInfo->isContentIdentical()) {
                $this->generateCommandReporter->reportIdenticalNewAndOldFile($oldAndNewFileInfo);
                continue;
            }
            // write into patches file
            $patchFileRelativePath = $this->patchFileFactory->createPatchFilePath($oldAndNewFileInfo, $vendorDirectory);
            $composerExtraPatches[$oldAndNewFileInfo->getPackageName()][] = $patchFileRelativePath;
            $patchFileAbsolutePath = \dirname($vendorDirectory) . \DIRECTORY_SEPARATOR . $patchFileRelativePath;
            // dump the patch
            $patchDiff = $this->patchDiffer->diff($oldAndNewFileInfo);
            if (\is_file($patchFileAbsolutePath)) {
                $message = \sprintf('File "%s" was updated', $patchFileRelativePath);
                $this->symfonyStyle->note($message);
            } else {
                $message = \sprintf('File "%s" was created', $patchFileRelativePath);
                $this->symfonyStyle->note($message);
            }
            $this->smartFileSystem->dumpFile($patchFileAbsolutePath, $patchDiff);
            $addedPatchFilesByPackageName[$oldAndNewFileInfo->getPackageName()][] = $patchFileRelativePath;
        }
        $this->composerPatchesConfigurationUpdater->updateComposerJsonAndPrint(\getcwd() . '/composer.json', $composerExtraPatches);
        if ($addedPatchFilesByPackageName !== []) {
            $message = \sprintf('Great! %d new patch files added', \count($addedPatchFilesByPackageName));
            $this->symfonyStyle->success($message);
        } else {
            $this->symfonyStyle->success('No new patches were added');
        }
        return \RectorPrefix20210706\Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
    }
}