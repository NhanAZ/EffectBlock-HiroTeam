<?php

namespace HiroTeam\blockEffect;

use pocketmine\plugin\PluginBase;

class BlockEffect extends PluginBase {

    protected static $instance;

    protected function onEnable(): void {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new BlockEffectListener($this), $this);
        $this->saveDefaultConfig();
    }
}
