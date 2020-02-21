<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\item\Item;

class main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§b[국가전쟁]§f플러그인 가동!! 이루온라인 빙빙제작");
		@mkdir($this->getDataFolder());
		Item::get(351,)
	}
	public function hand(PlayerItemHeldEvent$event){
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "0"){//*검은색
			
			
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "1"){//*빨강색
			$event->getPlayer()->sendTip("체리맛 쿠기");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "2"){//*초록색
			$event->getPlayer()->sendTip("좀비맛 쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "5"){//*자주색
			$event->getPlayer()->sendTip("이루맛쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "6"){//*청록색			
			$event->getPlayer()->sendTip("닌자맛");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "7"){//*연한 회색			
			$event->getPlayer()->sendTip("쿠키앤크림맛 쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "8"){//*회색
			$event->getPlayer()->sendTip("웨어울프맛 쿠키");			
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "9"){//*분홍색
			$event->getPlayer()->sendTip("딸기맛 쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "10"){//*연두색
			$event->getPlayer()->sendTip("키위맛 쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "11"){//*민들레노란색
			$event->getPlayer()->sendTip("천사맛 쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "12"){//*하늘색
			$event->getPlayer()->sendTip("구름맛 쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "13"){//*자홍색
			$event->getPlayer()->sendTip("빙빙맛쿠키");
		}
		if ($event->getItem()->getId() == "351" and $event->getItem()->getDamage() == "14"){//*주황색
			$event->getPlayer()->sendTip("용감한맛 쿠키");
		}
	}
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if ($command->getName() == "쿠키"){
			switch ($args[0]){
				case "상급뽑기":
					switch (mt_rand(1, 7)){
						
					}
				case "중급뽑기":
					switch (mt_rand(1, 9)){
					}	
				case "하급뽑기":
					switch (mt_rand(1, 12)){
					}	
				case "목록":
					$sender->sendMessage("§b============[쿠키목록]=============");
					$sender->sendMessage("해적맛 쿠키     체리맛쿠키     좀비맛쿠키");
					$sender->sendMessage("이루맛쿠키     닌자맛쿠키    쿠키앤크림맛쿠키");
					$sender->sendMessage("웨어울프맛쿠키     딸기맛쿠키     키위맛쿠키");
					$sender->sendMessage("천사맛쿠키     구름맛쿠키     빙빙맛쿠키");
					$sender->sendMessage("§b============[쿠키목록]=============");
			}
		}
	}
}