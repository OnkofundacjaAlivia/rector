<?php

declare (strict_types=1);
namespace Rector\Symfony\Rector\StaticCall;

use RectorPrefix20220420\Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\ObjectType;
use Rector\Core\Contract\PhpParser\NodePrinterInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\Util\StringUtils;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see \Rector\Symfony\Tests\Rector\StaticCall\ParseFileRector\ParseFileRectorTest
 */
final class ParseFileRector extends \Rector\Core\Rector\AbstractRector
{
    /**
     * @var string
     * @see https://regex101.com/r/ZaY42i/1
     */
    private const YAML_SUFFIX_IN_QUOTE_REGEX = '#\\.(yml|yaml)(\'|\\")$#';
    /**
     * @var string
     * @see https://regex101.com/r/YHA05g/1
     */
    private const FILE_SUFFIX_REGEX = '#File$#';
    /**
     * @var string
     * @see https://regex101.com/r/JmNhZj/1
     */
    private const YAML_SUFFIX_REGEX = '#\\.(yml|yaml)$#';
    /**
     * @readonly
     * @var \Rector\Core\Contract\PhpParser\NodePrinterInterface
     */
    private $nodePrinter;
    public function __construct(\Rector\Core\Contract\PhpParser\NodePrinterInterface $nodePrinter)
    {
        $this->nodePrinter = $nodePrinter;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Replaces deprecated Yaml::parse() of file argument with file contents', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
use Symfony\Component\Yaml\Yaml;

$parsedFile = Yaml::parse('someFile.yml');
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Symfony\Component\Yaml\Yaml;

$parsedFile = Yaml::parse(file_get_contents('someFile.yml'));
CODE_SAMPLE
)]);
    }
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Expr\StaticCall::class];
    }
    /**
     * Process Node of matched type
     *
     * @param StaticCall $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if (!$this->isName($node->name, 'parse')) {
            return null;
        }
        if (!$this->isObjectType($node->class, new \PHPStan\Type\ObjectType('Symfony\\Component\\Yaml\\Yaml'))) {
            return null;
        }
        if (!$this->isArgumentYamlFile($node)) {
            return null;
        }
        $funcCall = $this->nodeFactory->createFuncCall('file_get_contents', [$node->args[0]]);
        $node->args[0] = new \PhpParser\Node\Arg($funcCall);
        return $node;
    }
    private function isArgumentYamlFile(\PhpParser\Node\Expr\StaticCall $staticCall) : bool
    {
        $firstArg = $staticCall->args[0];
        if (!$firstArg instanceof \PhpParser\Node\Arg) {
            return \false;
        }
        $possibleFileNode = $firstArg->value;
        $possibleFileNodeAsString = $this->nodePrinter->print($possibleFileNode);
        // is yml/yaml file
        if (\Rector\Core\Util\StringUtils::isMatch($possibleFileNodeAsString, self::YAML_SUFFIX_IN_QUOTE_REGEX)) {
            return \true;
        }
        // is probably a file variable
        if (\Rector\Core\Util\StringUtils::isMatch($possibleFileNodeAsString, self::FILE_SUFFIX_REGEX)) {
            return \true;
        }
        // try to detect current value
        $nodeScope = $possibleFileNode->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::SCOPE);
        if (!$nodeScope instanceof \PHPStan\Analyser\Scope) {
            return \false;
        }
        $nodeType = $nodeScope->getType($possibleFileNode);
        if (!$nodeType instanceof \PHPStan\Type\Constant\ConstantStringType) {
            return \false;
        }
        return (bool) \RectorPrefix20220420\Nette\Utils\Strings::match($nodeType->getValue(), self::YAML_SUFFIX_REGEX);
    }
}
