<?php

declare(strict_types=1);

namespace Rector\Tests\Symfony3\Rector\ClassMethod\FormTypeGetParentRector;

use Iterator;
use Rector\Symfony3\Rector\ClassMethod\FormTypeGetParentRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class FormTypeGetParentRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fileInfo): void
    {
        $this->doTestFileInfo($fileInfo);
    }

    /**
     * @return Iterator<SmartFileInfo>
     */
    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    protected function getRectorClass(): string
    {
        return FormTypeGetParentRector::class;
    }
}