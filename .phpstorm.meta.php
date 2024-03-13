<?php
namespace PHPSTORM_META
{
    override(\Psr\Container\ContainerInterface::get(0), map([
        '' => '@',
    ]));
    override(\Illuminate\Container\Container::make(0), map([
        '' => '@',
    ]));
}
