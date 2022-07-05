<?php

namespace HiroTeam\blockEffect;

use HiroTeam\blockEffect\BlockEffect;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;

class BlockEffectListener implements Listener {

    private $main;
    public function __construct(BlockEffect $main) {
        $this->main = $main;
    }

    public function onBlock(PlayerMoveEvent $event) {
        $player = $event->getPlayer();

        foreach ($this->main->config->getAll() as $item => $parametre) {
            $poisonBlock = $parametre['block'];

            $block = $player->getLevel()->getBlock($event->getPlayer()->subtract(0, 1, 0));

            $effect = $parametre['effect'];
            $effect = explode(":", $effect);

            $minute = $effect[1] * 20;

            if ($poisonBlock == $block->getId() . ":" . $block->getDamage()) {

                $potionEffect = new EffectInstance(Effect::getEffect($effect[0]), $minute, $effect[2], $parametre['visible']);
                $player->addEffect($potionEffect);
            }
        }
    }
}
