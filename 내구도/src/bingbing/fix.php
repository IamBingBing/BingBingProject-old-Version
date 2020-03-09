<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;

class fix extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(Player $sender, Command $command, string $label, array $args):bool{
        if ($command->getName() == "내구도수리"){
            $item = $sender->getInventory()->getItemInHand();
            $item1 = new Item($item->getId(),$item->getDamage(),$item->getCount());
            $sender->getInventory()->setItemInHand($item1);
            $sender->sendMessage("수리완료");
        }
    }
}