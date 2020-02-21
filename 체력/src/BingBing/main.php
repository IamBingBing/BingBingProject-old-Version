<?php
namespace BingBing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerRespawnEvent;

class main extends PluginBase implements Listener{
	private static $instance;
	
	public function onEnable(){
		$this->getserver()->getpluginManager()->registerevents($this, $this);
		$this->getserver()->getlogger()->info(",,");
		@mkdir($this->getDataFolder());
		$this->item = new Config($this->getDataFolder()."setitem.yml" , Config::YAML,[
				"itemlevel" => "378",
				"itemheal" => "288",
				"heal" => "5"
		]);
		$this->item = $this->item->getAll();
	}
	
	public function getInstance(){
		return self::$instance;
	}
	
	public function onLoad(){
		self::$instance = $this;
	}
	public function save1($name){
		$this->name[$name]->setAll($this->nm[$name]->getAll());
		$this->name[$name]->save();
		
	}
	public function join(PlayerJoinEvent$join){
		if ($join->getPlayer()-> isOp() or !$join->getPlayer()-> isOp()){
		$name = $join->getPlayer()->getName();
		$this->name[$name] = new Config($this->getDataFolder().$name.".yml" , Config::YAML,[
				"healthlevel" => 1,
		]);
		$this->nm[$name] = $this->name[$name]->getAll();
		
		$this->nm[$name] = $this->name[$name]->getAll();
		$b = $this->nm[$name]["health"]*0.25;
		$join->getPlayer()->setMaxHealth($b+20);
			
		}
	} 
	public function ontouch(PlayerInteractEvent$event){
		$name = $event->getPlayer()->getName();
		$id = $event->getItem()->getId();
		$max = $event->getPlayer()->getMaxHealth();
		$health = $event->getPlayer()->getHealth();
		$healthlevel =& $this->nm[$name]["healthlevel"];
		
		if ($id == $this->item["itemlevel"] and $healthlevel <= 400){
			$healthlevel = $healthlevel+1;
			$event->getPlayer()->sendMessage("§b[§f체력레벨§b]§f 현제 레벨은".$healthlevel."§f입니다");
			$event->getPlayer()->getInventory()->removeItem(Item::get($this->item["itemlevel"],0,1));
			$event->getPlayer()->setMaxHealth(20+$healthlevel*0.25);
			
			$this->save1($name);
		}
		else if ($healthlevel >= 400 and $id == $this->item["itemlevel"]  ){
			$event->getPlayer()->sendMessage("§b[§f체력레벨§b]§f 현제 만렙입니다");
		}
		if ($id == $this->item["itemheal"] and $max !== $health){
			$event->getPlayer()->setHealth($health+$this->item["heal"]);
			$event->getPlayer()->sendMessage("§b[체력레벨]§f 현제 당신의 체력은".$health."§f입니다");
			$event->getPlayer()->getInventory()->removeItem(Item::get($this->item["itemheal"],0,1));
		}
	}
	public function respawn(PlayerRespawnEvent$event){
		$name = $event->getPlayer()->getName();
		$healthlevel = $this->nm[$name]["healthlevel"];
		$v = $healthlevel*0.25;
		$event->getPlayer()->setMaxHealth(20+$v);
	}
	public function getHealthlevel($name){
		return $this->nm[$name]["healthlevel"];
	}
	
}