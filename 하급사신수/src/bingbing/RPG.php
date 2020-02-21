<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\entity\Effect;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\Position;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\Creature;
use pocketmine\Player;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageEvent;

class RPG extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		$this->cooltime["player"] = new Config($this->getDataFolder()."cool.yml",Config::YAML);
		$this->cool["player"] = $this->cooltime["player"]->getAll();
	}
	
	
	
	public function join(PlayerJoinEvent$event){
		$name = $event->getPlayer()->getName();
		$this->cool["player"][$name]= array();
		$this->cool["player"][$name]["cool"] =0;
		$this->cool["player"][$name]["lastcool"] =0;
		$this->cool["player"][$name]["coolg"] =0;
		$this->cool["player"][$name]["lastcoolg"] = 0;
$event->getPlayer()->setScale(2);
	}
	
	
	
	
	
	
	public function touch(PlayerInteractEvent$event){
	    $name = $event->getPlayer()->getName();
	    $x = $event->getPlayer()->getFloorX();
	    $z = $event->getPlayer()->getFloorZ();
	    $player1 = $event->getPlayer();
	    $cool =& $this->cool["player"][$name]["cool"];
	    $coolg =& $this->cool["player"][$name]["coolg"];
	    $lastcool =& $this->cool["player"][$name]["lastcool"];
	    $lastcoolg =& $this->cool["player"][$name]["lastcoolg"];
	    /* DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
	    DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
	    DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	    
	    
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() !== "15" and $event->getItem()->getDamage() !== "0"){ // 분홍 염료
			
			
			$y = $player1->getFloorY();
			if ($cool == "0"){
				if (! $event->getPlayer()->isSneaking()){
				    $cool = time();
				    
				    foreach ($this->getServer()->getOnlinePlayers() as $player ){
				        $x1 = $player->getPlayer()->getFloorX();
				        $z1 = $player->getPlayer()->getFloorZ();
				        if ($x1 <$x+5 and $x-5 <$x1 and $z1 <$z+5 and $z-5 <$z1 and $player->getLevel()->getName() == $player1->getPlayer()->getLevel()){
				            $player->setHealth($player->getHealth() - 3);
				            $event->getPlayer()->addEffect(Effect::getEffect(1)->setAmplifier(1)->setDuration(20*5));
				            $player->sendMessage("§b[§f사신수§b] 사신수를 사용하엿습니다. 주변 플레이어가 데미지를 받습니다 .");
				            for ($b =0; $b < 100; $b++){
				                $x3 = mt_rand($x-5, $x+5);
				                $y3 = mt_rand($y-0.5, $y+0.5);
				                $z3 = mt_rand($z-5, $z+5);
				                $event->getPlayer()->getLevel()->addParticle(new FlameParticle(new Vector3($x3,$y3,$z3)));
				            }
				            $cool = "0";
				            $lastcool = 0;
				        }
				        
				    }
					
					
				}
			}
			else if (!$player1->getPlayer()->isSneaking()){
				
			    $lastcool = time();
				$aa= $lastcool - $cool;
				if ($aa >= 60){
					foreach ($this->getServer()->getOnlinePlayers() as $player ){
						$x1 = $player->getPlayer()->getFloorX();
						$z1 = $player->getPlayer()->getFloorZ();
						if ($x1 <$x+5 and $x-5 <$x1 and $z1 <$z+5 and $z-5 <$z1){
						    $player->setHealth($player->getHealth() - 3);
						    $event->getPlayer()->addEffect(Effect::getEffect(1)->setAmplifier(1)->setDuration(20*5));
						    $player->sendMessage("§b[§f사신수§b] 사신수를 사용하엿습니다. 주변 플레이어가 데미지를 받습니다 .");
						    for ($b =0; $b < 100; $b++){
						        $x3 = mt_rand($x-5, $x+5);
						        $y3 = mt_rand($y-0.5, $y+0.5);
						        $z3 = mt_rand($z-5, $z+5);
						        $event->getPlayer()->getLevel()->addParticle(new FlameParticle(new Vector3($x3,$y3,$z3)));
						    }
						    $cool = "0";
							$lastcool = 0;
						}
							
						}
					}
				
				else {
				    $aa= $lastcool - $cool;
				    $a1 = 60-$aa;
					$event->getPlayer()->sendMessage("§b[§f사신수§b]§f 아직 쿨타임이".$a1."남았습니다");
				}
			}
			if ($coolg == "0"){
				
				
				if ( $event->getPlayer()->isSneaking()){
					$coolg = time();
				foreach ($this->getServer()->getOnlinePlayers() as $player ){
					$x1 = $player->getPlayer()->getFloorX();
					$z1 = $player->getPlayer()->getFloorZ();
					if ($x1 <$x+5 and $x-5 <$x1 and $z1 <$z+5 and $z-5 <$z1 and $player->getName() != $player1->getName()){
						
							$player->setHealth($player->getHealth() -6);
							$player->addEffect(Effect::getEffect(2)->setAmplifier(4)->setDuration(20*5));
							$event->getPlayer()->addEffect(Effect::getEffect(1)->setAmplifier(6)->setDuration(20*5));
							$event->getPlayer()->setHealth($event->getPlayer()->getHealth()+5);
							for ($b =0; $b < 100; $b++){
							    $x3 = mt_rand($x-5, $x+5);
							    $y3 = mt_rand($y-0.5, $y+0.5);
							    $z3 = mt_rand($z-5, $z+5);
							    $event->getPlayer()->getLevel()->addParticle(new FlameParticle(new Vector3($x3,$y3,$z3)));
							}
							$player->sendMessage("§b[§f사신수§b] 사신수를 사용하엿습니다. 주변 플레이어가 데미지를 받고 구속상태가 됩니다 .");
						
					}
				}
				}
				
			}
			else if ($player1->getPlayer()->isSneaking()){
				$lastcoolg = time();
				$agg = $lastcoolg - $coolg;
				if ($agg >= 60){
					
					foreach ($this->getServer()->getOnlinePlayers() as $player ){
						$x1 = $player->getPlayer()->getFloorX();
						$z1 = $player->getPlayer()->getFloorZ();
						if ($x1 <$x+5 and $x-5 <$x1 and $z1 <$z+5 and $z-5 <$z1 and $player->getName() != $player1->getName()){
						    $player->setHealth($player->getHealth() - 6);
						    $player->addEffect(Effect::getEffect(2)->setAmplifier(4)->setDuration(20*5));
						    $event->getPlayer()->setHealth($event->getPlayer()->getHealth()+5);
						    $event->getPlayer()->addEffect(Effect::getEffect(1)->setAmplifier(6)->setDuration(20*5));
						    for ($b =0; $b < 100; $b++){
						        $x3 = mt_rand($x-5, $x+5);
						        $y3 = mt_rand($y-0.5, $y+0.5);
						        $z3 = mt_rand($z-5, $z+5);
						        $event->getPlayer()->getLevel()->addParticle(new FlameParticle(new Vector3($x3,$y3,$z3)));
						    }
						    $player->sendMessage("§b[§f사신수§b] 사신수를 사용하엿습니다. 주변 플레이어가 데미지를 받고 구속상태가 됩니다 .");
								
							
						}
					}
				}
				else {
				    $agg = $lastcoolg - $coolg;
				    $ag1 = 60- $agg;
					$event->getPlayer()->sendMessage("§b[§f사신수§b]§f 아직 쿨타임이".$ag1."남았습니다");
				}
			}
		}
		/* DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
		 DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
		 DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
		
		
		
	}
}		