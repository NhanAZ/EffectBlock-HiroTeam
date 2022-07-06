<?php

namespace HiroTeam\blockEffect;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class BlockEffect extends PluginBase implements Listener {

    public $config;
    protected static $instance;

    protected function onEnable(): void {

        self::$instance = $this;

        $this->getServer()->getPluginManager()->registerEvents(new BlockEffectListener($this), $this);

        @mkdir($this->getDataFolder());
        if (!file_exists($this->getDataFolder() . "config.yml")) {
            $this->saveResource('config.yml');
        }
        $this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);
    }
}
