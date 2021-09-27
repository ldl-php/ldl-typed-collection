<?php declare(strict_types=1);

/**
 * Validates that the amount of items in a collection must be <COMPARISON> than a certain number
 *
 * Example: Validate that the amount of items in a collection must be lower/equal/greater than than 5
 *
 * @see \LDL\Framework\Base\Constants
 * @see \LDL\Framework\Helper\ComparisonOperatorHelper
 */

namespace LDL\Type\Collection\Validator;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Framework\Base\Constants;
use LDL\Framework\Helper\ComparisonOperatorHelper;
use LDL\Validators\Traits\ValidatorValidateTrait;
use LDL\Validators\ValidatorHasConfigInterface;
use LDL\Validators\ValidatorInterface;

class AmountValidator implements ValidatorInterface, ValidatorHasConfigInterface
{
    use ValidatorValidateTrait;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var string
     */
    private $order;

    /**
     * @var string|null
     */
    private $description;

    public function __construct(
        int $value,
        string $operator,
        string $description=null,
        string $order = Constants::COMPARE_LTR
    )
    {
        if($value <= 0){
            $msg = 'Amount of items for validator "%s" must be a positive integer';
            throw new \InvalidArgumentException($msg);
        }

        ComparisonOperatorHelper::validate($operator);

        $this->amount = $value;
        $this->operator = $operator;
        $this->order = $order;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        if(!$this->description){
            return sprintf(
                'The amount of items in the collection can NOT be "%s" than "%s"',
                $this->operator,
                $this->amount
            );
        }

        return $this->description;
    }

    public function assertTrue($value, $key = null, CollectionInterface $collection = null): void
    {
        $compare = ComparisonOperatorHelper::compare(
            count($collection),
            $this->amount,
            $this->operator,
            $this->order
        );

        if(!$compare){
            return;
        }

        $msg = sprintf(
            'The amount of items in the collection can NOT be "%s" than "%s"',
            $this->operator,
            $this->amount
        );

        throw new Exception\AmountValidatorException($msg);
    }

    public function jsonSerialize(): array
    {
        return $this->getConfig();
    }

    /**
     * @param array $data
     * @return ValidatorInterface
     * @throws Exception\InvalidConfigException
     */
    public static function fromConfig(array $data = []): ValidatorInterface
    {
        if(!array_key_exists('amount', $data)){
            $msg = sprintf("Missing property 'amount' in %s", __CLASS__);
            throw new Exception\InvalidConfigException($msg);
        }

        if(!array_key_exists('operator', $data)){
            $msg = sprintf("Missing property 'operator' in %s", __CLASS__);
            throw new Exception\InvalidConfigException($msg);
        }

        ComparisonOperatorHelper::validate($data['operator']);

        if(!is_string($data['operator'])){
            throw new \InvalidArgumentException(
                sprintf('operator must be of type string, "%s" was given',gettype($data['operator']))
            );
        }

        try{
            return new self(
                (int) $data['amount'],
                $data['operator'],
                $data['description'] ?? null
            );
        }catch(\Exception $e){
            throw new Exception\InvalidConfigException($e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return [
            'amount' => $this->amount,
            'operator' => $this->operator,
            'description' => $this->getDescription()
        ];
    }

}
