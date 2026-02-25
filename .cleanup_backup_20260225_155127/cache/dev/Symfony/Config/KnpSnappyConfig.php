<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'KnpSnappy'.\DIRECTORY_SEPARATOR.'PdfConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'KnpSnappy'.\DIRECTORY_SEPARATOR.'ImageConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class KnpSnappyConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $temporaryFolder;
    private $processTimeout;
    private $pdf;
    private $image;
    private $_usedProperties = [];
    private $_hasDeprecatedCalls = false;

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function temporaryFolder($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['temporaryFolder'] = true;
        $this->temporaryFolder = $value;

        return $this;
    }

    /**
     * Generator process timeout in seconds.
     * @default null
     * @param ParamConfigurator|int $value
     * @return $this
     * @deprecated since Symfony 7.4
     */
    public function processTimeout($value): static
    {
        $this->_hasDeprecatedCalls = true;
        $this->_usedProperties['processTimeout'] = true;
        $this->processTimeout = $value;

        return $this;
    }

    /**
     * @default {"enabled":true,"binary":"wkhtmltopdf","options":[],"env":[]}
     * @deprecated since Symfony 7.4
     */
    public function pdf(array $value = []): \Symfony\Config\KnpSnappy\PdfConfig
    {
        $this->_hasDeprecatedCalls = true;
        if (null === $this->pdf) {
            $this->_usedProperties['pdf'] = true;
            $this->pdf = new \Symfony\Config\KnpSnappy\PdfConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "pdf()" has already been initialized. You cannot pass values the second time you call pdf().');
        }

        return $this->pdf;
    }

    /**
     * @default {"enabled":true,"binary":"wkhtmltoimage","options":[],"env":[]}
     * @deprecated since Symfony 7.4
     */
    public function image(array $value = []): \Symfony\Config\KnpSnappy\ImageConfig
    {
        $this->_hasDeprecatedCalls = true;
        if (null === $this->image) {
            $this->_usedProperties['image'] = true;
            $this->image = new \Symfony\Config\KnpSnappy\ImageConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "image()" has already been initialized. You cannot pass values the second time you call image().');
        }

        return $this->image;
    }

    public function getExtensionAlias(): string
    {
        return 'knp_snappy';
    }

    public function __construct(array $config = [])
    {
        if (array_key_exists('temporary_folder', $config)) {
            $this->_usedProperties['temporaryFolder'] = true;
            $this->temporaryFolder = $config['temporary_folder'];
            unset($config['temporary_folder']);
        }

        if (array_key_exists('process_timeout', $config)) {
            $this->_usedProperties['processTimeout'] = true;
            $this->processTimeout = $config['process_timeout'];
            unset($config['process_timeout']);
        }

        if (array_key_exists('pdf', $config)) {
            $this->_usedProperties['pdf'] = true;
            $this->pdf = new \Symfony\Config\KnpSnappy\PdfConfig($config['pdf']);
            unset($config['pdf']);
        }

        if (array_key_exists('image', $config)) {
            $this->_usedProperties['image'] = true;
            $this->image = new \Symfony\Config\KnpSnappy\ImageConfig($config['image']);
            unset($config['image']);
        }

        if ($config) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($config)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['temporaryFolder'])) {
            $output['temporary_folder'] = $this->temporaryFolder;
        }
        if (isset($this->_usedProperties['processTimeout'])) {
            $output['process_timeout'] = $this->processTimeout;
        }
        if (isset($this->_usedProperties['pdf'])) {
            $output['pdf'] = $this->pdf->toArray();
        }
        if (isset($this->_usedProperties['image'])) {
            $output['image'] = $this->image->toArray();
        }
        if ($this->_hasDeprecatedCalls) {
            trigger_deprecation('symfony/config', '7.4', 'Calling any fluent method on "%s" is deprecated; pass the configuration to the constructor instead.', $this::class);
        }

        return $output;
    }

}
