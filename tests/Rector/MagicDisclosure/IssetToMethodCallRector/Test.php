<?php declare(strict_types=1);

namespace Rector\Tests\Rector\MagicDisclosure\IssetToMethodCallRector;

use Rector\Rector\MagicDisclosure\IssetToMethodCallRector;
use Rector\Testing\PHPUnit\AbstractConfigurableRectorTestCase;

final class Test extends AbstractConfigurableRectorTestCase
{
    public function test(): void
    {
        $this->doTestFileMatchesExpectedContent(
            __DIR__ . '/wrong/wrong.php.inc',
            __DIR__ . '/correct/correct.php.inc'
        );
    }

    protected function provideConfig(): string
    {
        return __DIR__ . '/config/rector.yml';
    }

    /**
     * @return string[]
     */
    protected function getRectorClasses(): array
    {
        return [IssetToMethodCallRector::class];
    }
}
