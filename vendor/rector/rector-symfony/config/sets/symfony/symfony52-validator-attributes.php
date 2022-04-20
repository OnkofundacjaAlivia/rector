<?php

declare (strict_types=1);
namespace RectorPrefix20220420;

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
// @see https://symfony.com/blog/new-in-symfony-5-2-constraints-as-php-attributes
return static function (\Rector\Config\RectorConfig $rectorConfig) : void {
    $services = $rectorConfig->services();
    $services->set(\Rector\Php80\Rector\Class_\AnnotationToAttributeRector::class)->configure([new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Bic'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Blank'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Callback'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\CardScheme'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Cascade'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Choice'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Count'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Country'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Currency'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Date'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\DateTime'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\DisableAutoMapping'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\DivisibleBy'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Email'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\EnableAutoMapping'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\EqualTo'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Expression'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\ExpressionLanguageSyntax'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\File'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\GreaterThan'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\GreaterThanOrEqual'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\GroupSequence'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\GroupSequenceProvider'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Hostname'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Iban'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\IdenticalTo'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Image'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Ip'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Isbn'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\IsFalse'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Isin'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\IsNull'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Issn'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\IsTrue'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Json'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Language'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Length'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\LessThan'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\LessThanOrEqual'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Locale'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Luhn'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Negative'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\NegativeOrZero'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\NotBlank'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\NotCompromisedPassword'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\NotEqualTo'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\NotIdenticalTo'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\NotNull'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Positive'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\PositiveOrZero'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Range'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Regex'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Time'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Timezone'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Traverse'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Type'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Ulid'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Unique'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Url'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Uuid'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Validator\\Constraints\\Valid'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Serializer\\Annotation\\DiscriminatorMap'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Serializer\\Annotation\\Groups'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Serializer\\Annotation\\Ignore'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Serializer\\Annotation\\MaxDepth'), new \Rector\Php80\ValueObject\AnnotationToAttribute('Symfony\\Component\\Serializer\\Annotation\\SerializedName')]);
};
