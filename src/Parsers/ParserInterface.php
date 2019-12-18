<?php

namespace Arquivei\Events\Sender\Parsers;

interface ParserInterface
{
    public function parse(): self;

    public function toArray(): array;

    public function toJson(): string;
}
