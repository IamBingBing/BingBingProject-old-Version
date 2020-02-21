<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\math\Vector2;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\network\mcpe\protocol\ExplodePacket;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\item\Item;

class nuclearwar extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        mkdir($this->getDataFolder());
        $this->ydb = new Config($this->getDataFolder()."y.yml",Config::YAML , []);
        $this->y = $this->ydb->getAll();
    }
    public function save(){
        $this->ydb->setAll($this->y);
        $this->ydb->save();
    }
    public function block(BlockPlaceEvent$event){
        $block = $event->getBlock();
        $x =$block->getFloorX();
        $y = $block->getFloorY();
        $z = $block->getFloorZ();
        $player = $event->getPlayer();
        $level = $player->getLevel();
        if ($event->getBlock()->getId() == 49){
            $a = 0;
            while ($a == 40){
                for ($b = 0; $b <= 30; $b++){
                $level->setBlock(new Vector3($x+40, $y+$b , $z+$a), Block::get(49));
                }
                for ($c = 0; $c <= 30; $c++){
                    $level->setBlock(new Vector3($x+40, $y , $z-$a), Block::get(49));
                }
                for ($d = 0; $d <= 30; $d++){
                 
                    $level->setBlock(new Vector3($x+$a, $y , $z+40), Block::get(49));
                }
                for ($e = 0; $e <= 30; $e++){
                    $level->setBlock(new Vector3($x+$a, $y , $z+40), Block::get(49));
                }
                    $a++;
            }
            
        }
        if ($block->getId() == "121"){
            $this->y[count($this->y)] =[];
            $this->y[count($this->y)]["x"] = $x;
            $this->y[count($this->y)]["y"] = $y;
            $this->y[count($this->y)]["z"] = $z;
        }
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool{
        if ($command->getName() == "핵"){
            if ($args[0] == "발사"){
                if (is_numeric($args[1]) and is_numeric($args[2]) and is_numeric($args[3]) and $sender->getInventory()->getItemInHand()->getId() == "369"){
                    $sender->getInventory()->removeItem(Item::get(369,0,1));
                    
                    for ($v = 0; $v <=count($this->y); $v++ ){
                        if ($sender->getLevel()->getBlock(new Vector3($args[1] ,$args[2], $args[3]))->distance(new Vector3($this->y[$v]["x"] , $this->y[$v]["y"] , $this->y[$v]["z"] )) >= 30 or count($this->y) == 0){
                            $sender->sendMessage("적중 완료 ★ ");
                            $p = new ExplodePacket();
                            $p->putVector3f($args[1] ,$args[2], $args[3]);
                            $p->putUnsignedVarLong(64);
                            $sender->getServer()->broadcastPacket($sender->getServer()->getOnlinePlayers(), $p);
                            break;
                        }
                        else {
                            $sender->sendMessage("요격 당했당★ ");
                            
                            unset($this->y[$v]);
                        }
                        
                    }
                }
            }
        }
    
    
    }
    
    
}