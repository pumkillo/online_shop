<?php
interface MiddlewareInterface
{
    public static function check(): void;
    public static function is(): bool;
}