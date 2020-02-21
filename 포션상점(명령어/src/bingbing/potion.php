<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
use pocketmine\entity\Effect;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class potion extends PluginBase implements Listener{
	private $economy;
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("plugin on made by BingBing");
	}
	public function onCommand(CommandSender $player,Command $command, $label, array $args){
		$time = 20*60*5;
		$sender = $player->getName();
		$currentMoney = EconomyAPI::getInstance()->myMoney($sender);
		if($command->getName() == "포션구매"){
			switch ($args[0]){
				case "고급패키지":
					if ($currentMoney<150000){
						$player->sendMessage("돈이 부족합니다");
						break;
					}
					if($currentMoney>=150000){
						EconomyAPI::getInstance()->reduceMoney($sender, 150000);
						$player->addEffect(Effect::getEffect(1)->setAmplifier(1)->setDuration($time));
						$player->addEffect(Effect::getEffect(11)->setAmplifier(1)->setDuration($time));
						$player->addEffect(Effect::getEffect(10)->setAmplifier(1)->setDuration($time));
						$player->addEffect(Effect::getEffect(5)->setAmplifier(1)->setDuration($time));
						$player->sendMessage("고급 패키지 구매완료");
						
						break;
					}
				case"신속":
					if ($currentMoney<10000){
						$sender->sendMessage("돈이 부족합니다");
						break;
					}
					if($currentMoney>10000){
						EconomyAPI::getInstance()->reduceMoney($sender, 10000);
						$player->addEffect(Effect::getEffect(1)->setAmplifier(1)->setDuration($time));
						break;
					}
				case"힘":
					if ($currentMoney<50000){
						$sender->sendMessage("돈이 부족합니다");
						break;
					}
					if ($currentMoney>=50000){
						$this->reduceMoney($sender, 50000);
						$player->addEffect(Effect::getEffect(5)->setAmplifier(1)->setDuration($time));
						break;
					}
				case"저항":
					if ($currentMoney<50000){
						$player->sendMessage("돈이 부족합니다");
						break;
					}
					if ($currentMoney>=50000){
						EconomyAPI::getInstance()->reduceMoney($sender, 50000);
						$player->addEffect(Effect::getEffect(11)->setAmplifier(1)->setDuration($time));
						break;
					}
				case "재생":
					if ($currentMoney<30000){
						$player->sendMessage("돈이 부족합니다");
						break;
					}
					
					if ($currentMoney>=30000){
						EconomyAPI::getInstance()->reduceMoney($sender, 30000);
						$player->addEffect(Effect::getEffect(10)->setAmplifier(1)->setDuration($time));
						break;
					}
					
				case "흡수":
					if ($currentMoney<10000){
						$player->sendMessage("돈이 부족합니다");
						break;
					}
					if ($currentMoney>=10000){
						EconomyAPI::getInstance()->reduceMoney($sender, 10000);
						$player->addEffect(Effect::getEffect(22)->setAmplifier(1)->setDuration($time));
						break;
					}
				case "리스트":
					$player->sendMessage("§b=============[§f포션상점§b]=============");
					$player->sendMessage("§b[§f포션상점§b]§f 고급패키지 -15만원  고급패키지 -15만원");
					$player->sendMessage("§b[§f포션상점§b]§f 신속 -1만원  힘 -5만원  저항 -5만원");
					$player->sendMessage("§b[§f포션상점§b]§f 재생 -1만원  흡수 -5만원  준비중＊");
					$player->sendMessage("§b=============[§f포션상점§b]=============");
					break;
				default:
					$player->sendMessage("§b[§f포션상점§b]§f 사용방법 /포션구매 효과");
					$player->sendMessage("§b[§f포션상점§b]§f 효과 가격표 /포션구매 리스트");
					break;
			}
		}
	}
}
