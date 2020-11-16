<?php

namespace Covid;

use Covid\Encoders\EncoderFactory;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class OutputRenderer
{
    private const DEFAULT_FORMAT = 'table';

    public function render(array $result, OutputInterface $output, string $format): void
    {
        $result = $format === self::DEFAULT_FORMAT
            ? $this->renderAsTable($result, $output)
            : $this->renderWithEncoder($result, $output, $format);
    }

    private function renderAsTable(array $result, OutputInterface $output): void
    {
        $table = new Table($output);
        [$headers, $rows] = $this->isSingleResult($result)
            ? [array_keys($result), [$result]]
            : [array_keys(reset($result)), $result];

        $table->setHeaders($headers)
            ->setRows($rows)
            ->render();
    }

    private function isSingleResult(array $result): bool
    {
        return is_string(reset(array_keys($result)));
    }

    private function renderWithEncoder(array $result, OutputInterface $output, string $format): void
    {
        $formatter = EncoderFactory::make($format);
        $result = $formatter->encode($result, $format);

        $output->write($result);
    }
}
