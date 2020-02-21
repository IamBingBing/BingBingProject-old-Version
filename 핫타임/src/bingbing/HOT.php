<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\entity\Item;

class HOT extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command  $command, string $label, array $args):bool{
        if ($command->getName() == "hot"){
            switch ($args[0]){
                case "시작":
                    $sender->getServer()->broadcastMessage("§4[§f세뉴어타임§4]§f 세뉴어 타임시작!!");
                    return true;
                    break;
                case "종료":
                    $sender->getServer()->broadcastMessage("§4[§f세뉴어타임§4]§f 세뉴어 타임종료!!");
                    return true;
                    break;
            
                case "아이템주기":
                    $sender->getServer()->broadcastMessage("§4[§f세뉴어타임§4]§f 세뉴어 타임보상으로 아이템코드 ".$args[1]."을 ".$args[2]."지급 받았습니다");
                    $id = explode(":", $args[1]);
                        foreach ($sender->getServer()->getOnlinePlayers() as $player){
                            if (isset($id[1])){
                                $sender->getInventory()->addItem(\pocketmine\item\Item::get($id[0],$id[1],$args[2]));
                                return true;
                            }
                            else {
                                $sender->getInventory()->addItem(\pocketmine\item\Item::get($id[0],0 ,$args[2]));
                                return true;
                            }
                        }
                
                default:
                    $sender->sendMessage("/hot 시작/종료 / 아이템주기");
                    return true;
            }
        }
    }
}