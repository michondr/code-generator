<?php
declare(strict_types = 1);
interface LineVersionTransformerInterface
{
    public function transform(FileLine $line): Line;
}