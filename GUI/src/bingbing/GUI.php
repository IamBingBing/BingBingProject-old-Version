<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\Player;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;

class GUI extends PluginBase implements Listener{
    public function recive(DataPacketReceiveEvent$event){
        $pk = $event->getPacket();
        if ($pk instanceof ModalFormRequestPacket){
            if ($pk instanceof ModalFormResponsePacket && $pk->formId === self::FORM_ID) {
                if ($pk->formData ){
                    
                }
            }
        }
    }
    public function join(PlayerJoinEvent$event){
        $player = $event->getPlayer();
        $json = array();
        $json["type"] = "model";
        $json["title"] = "설정";
        $json["content"] = "콘텐트는 뭘까";
        $json["button1"] = "나 버튼1임";
        $pk = new ModalFormRequestPacket();
        $pk->formId = 1412;
        $pk->formData = json_encode($json);
        $player->dataPacket($pk);
    }
}