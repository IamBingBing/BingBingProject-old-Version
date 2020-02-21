<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\event\Event;
use pocketmine\event\player\PlayerBedEnterEvent;

class main extends PluginBase implements Listener{
	private $economy;
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§b[침대]§f학교가기 싫다");
	}
	public function block(PlayerBedEnterEvent$event){
		$m = "§b[침대]§f";
		$event->getPlayer()->sendMessage($m."한숨 자 볼까 ");
	}
	public function leave(PlayerBedEnterEvent$event){
		$m = "§b[침대]§f";
		switch (mt_rand(1 , 5)){
			case 1:
		$event->getPlayer()->sendMessage($m.$name."아 일어나야지 학교 늦었어");
		$event->getPlayer()->sendMessage($m."바빠서 신속이 생겼다");
		$event->getPlayer()->addEffect(Effect::getEffect(1)->setDuration(60)->setAmplifier(1));
		
		break;
			case 2:
		$event->getPlayer()->sendMessage($m.$name."밥먹지말고 학교가!! 학교 늦었어");
		$event->getPlayer()->sendMessage($m."허기가 생긴다");
		$event->getPlayer()->sendMessage($m."피로가 몰려온다");
		$event->getPlayer()->addEffect(Effect::getEffect(9)->setDuration(60)->setAmplifier(1));
		$event->getPlayer()->addEffect(Effect::getEffect(17)->setDuration(20)->setAmplifier(1));
		
		break;
			case 3:
		$event->getPlayer()->sendMessage($m."기분 좋게 일어났다");
		$event->getPlayer()->addEffect(Effect::getEffect(1)->setDuration(60)->setAmplifier(1));
		$event->getPlayer()->setHealth(10000);
		$event->getPlayer()->setFood(10000);
		$event->getPlayer()->addEffect(Effect::getEffect(8)->setDuration(60)->setAmplifier(1));
		break;
			case 4:
				$event->getPlayer()->sendMessage($m."학교에 가지 않는 날이다");
				$event->getPlayer()->addEffect(Effect::getEffect(5)->setDuration(60)->setAmplifier(1));
				$event->getPlayer()->addEffect(Effect::getEffect(1)->setDuration(60)->setAmplifier(1));
				$event->getPlayer()->addEffect(Effect::getEffect(8)->setDuration(60)->setAmplifier(1));
				$event->getPlayer()->addEffect(Effect::getEffect(11)->setDuration(60)->setAmplifier(1));
				$event->getPlayer()->setHealth(10000);
				$event->getPlayer()->setFood(10000);
				break;
			case 5:
				$event->getPlayer()->sendMessage($m."난 다시는 눈을 뜨지 못했다");
				$event->getPlayer()->kill();
				break;
		}
	}
}