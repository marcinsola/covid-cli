<?php

namespace Covid\Encoders;

use Webmozart\Assert\Assert;
use Covid\Encoders\TableEncoder;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class EncoderFactory
{
    private const JSON  = 'json';
    private const XML   = 'xml';
    private const CSV   = 'csv';
    private const YAML  = 'yaml';
    private const TABLE = 'table';

    private const  CONFIG = [
        self::JSON => JsonEncoder::class,
        self::XML => XmlEncoder::class,
        self::CSV => CsvEncoder::class,
        self::YAML => YamlEncoder::class,
        self::TABLE => TableEncoder::class,
    ];

    public static function make(string $outputFormat): EncoderInterface
    {
        $outputFormat = strtolower(trim($outputFormat));
        Assert::keyExists(static::CONFIG, $outputFormat, "Unknown output format: $outputFormat");
        $className = self::CONFIG[$outputFormat];

        return new $className;
    }
}
