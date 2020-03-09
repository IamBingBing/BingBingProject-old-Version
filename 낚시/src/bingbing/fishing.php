<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\item\Item;

class fishing extends PluginBase implements Listener{
    private $time ; 
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
          
    }
    public function join(PlayerJoinEvent$event){
        $name = $event->getPlayer()->getName();
        if(!isset($this->time[$name])){
            $this->time[$name] = "NONE";
        }
    }
    public function touch(PlayerInteractEvent $event){
        $block = $event->getBlock();
        $name = $event->getPlayer()->getName();
        if ($block->getId() == "79" && $event->getItem()->getId() == "346"){
            if ($this->time[$name] == "NONE"){
                $this->time[$name] = time();
                $this->fishing($event->getPlayer());
            }
            else if (time() - $this->time[$name] > 5 ){
                $this->time[$name] = time();
                
                $this->fishing($event->getPlayer());
            }
            else {
                $event->getPlayer()->sendMessage("§b[§f 낚시 §b]§f 아직 쿨타임이 안지났습니당!");
            }
        }
    }
    public function fishing(Player $player){
        switch (mt_rand(1,8)){
            case 1:
                $player->getInventory()->addItem(Item::get(349 , 0 , 1));
                $player->sendMessage("§b[§f 낚시 §b]§f 낚았다");
                
                break;
            case 2:
                $player->getInventory()->addItem(Item::get(460 , 0 , 1));
                $player->sendMessage("§b[§f 낚시 §b]§f 낚았다");
                
                break;
                
            case 3:
                $player->getInventory()->addItem(Item::get(461 , 0 , 1));
                $player->sendMessage("§b[§f 낚시 §b]§f 낚았다");
                
                break;
                
            case 4:
                $player->getInventory()->addItem(Item::get(462 , 0 , 1));
                $player->sendMessage("§b[§f 낚시 §b]§f 낚았다");
                
                break;
            
            case 5:
                $player->getInventory()->addItem(Item::get(350 , 0 , 1));
                $player->sendMessage("§b[§f 낚시 §b]§f 낚았다");
                
                break;
                
            case 6:
                $player->getInventory()->addItem(Item::get(463 , 0 , 1));
                $player->sendMessage("§b[§f 낚시 §b]§f 낚았다");
                
                break;
                
            case 7:
                $player->sendMessage("§b[§f 낚시 §b]§f 잽싼높이었어");
                
                break;
                
            case 8:
                $player->sendMessage("§b[§f 낚시 §b]§f 에잇 쓰래기자나");
                
                break;
                
        }
    }
}