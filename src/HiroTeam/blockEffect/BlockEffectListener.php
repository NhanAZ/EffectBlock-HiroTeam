<?php

namespace HiroTeam\blockEffect;

use HiroTeam\blockEffect\BlockEffect;
use pocketmine\data\bedrock\EffectIdMap;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;

class BlockEffectListener implements Listener {

    private BlockEffect $main;

    public function __construct(BlockEffect $main) {
        $this->main = $main;
    }

    public function onBlock(PlayerMoveEvent $event) {
        $player = $event->getPlayer();

        foreach ($this->main->getConfig()->getAll() as $item => $parametre) {
            $poisonBlock = $parametre['block'];

            $block = $player->getWorld()->getBlock($event->getPlayer()->getPosition()->down());

            $effect = $parametre['effect'];
            $effect = explode(":", $effect);

            $minute = $effect[1] * 20;

            if ($poisonBlock == $block->getId() . ":" . $block->getMeta()) {

                $potionEffect = new EffectInstance(EffectIdMap::getInstance()->fromId((int)$effect[0]), $minute, $effect[2], $parametre['visible']);
                $player->getEffects()->add($potionEffect);
            }
        }
    }
}
