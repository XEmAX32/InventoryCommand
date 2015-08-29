<?php

namespace InventoryCommand;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Compass;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\utils\Config;
use pocketmine\inventory\PlayerInventory;

class Main extends PluginBase implements Listener{

public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->getLogger()->info(TextFormat::GREEN . "CompassCommand Enabled!");
$this->saveDefaultConfig();
}

public function onLoad(){
$this->getLogger()->info(TextFormat::YELLOW . "Loading CompassCommand...");
}

public function onDisable(){
$this->getLogger()->info(TextFormat::RED . "CompassCommand Disabled!");
$this->getConfig()->save();
}

public function onItemHeld(PlayerItemHeldEvent $event){
$player = $event->getPlayer();
$item = $event->getItem();

foreach($this->getConfig()->get("commands1") as $cmd1){
$configitem1 = $this->getConfig()->get("item1");
if($item->getID() == $configitem1){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd1));
       }
     }
$configitem2 = $this->getConfig()->get("item2");
foreach($this->getConfif()->get("commands2") as $cmd2){
if($item->getID() == $configitem2){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd2));
       }
     }
$configitem3 = $this->getConfig()->get("item3");
foreach($this->getConfig()->get("commands3") as $cmd3){
if($item->getID() == $configitem3){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd3));
         }
      }
$configitem4 = $this->getConfig()->get("item4");
foreach($this->getConfig()->get("commands4") as $cmd4){
if($item->getID() == $configitem4){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd4));
         }
      }
$configitem5 = $this->getConfig()->get("item5");
foreach($this->getConfig()->get("commands5") as $cmd5){
if($item->getID() == $configitem5){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd5));
         }
      }
$configitem6 = $this->getConfig()->get("item6");
foreach($this->getConfig()->get("commands6") as $cmd6){
if($item->getID() == $configitem6){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd6));
         }
      }
$configitem7 = $this->getConfig()->get("item7");
foreach($this->getConfig()->get("commands7") as $cmd7){
if($item->getID() == $configitem7){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd7));
         }
      }
$configitem8 = $this->getConfig()->get("item8");
foreach($this->getConfig()->get("commands8") as $cmd8){
if($item->getID() == $configitem8){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd8));
         }
      }
$configitem9 = $this->getConfig()->get("item9");
foreach($this->getConfig()->get("commands9") as $cmd9){
if($item->getID() == $configitem9){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd9));
         }
      }
$configitem10 = $this->getConfig()->get("item10");
foreach($this->getConfig()->get("commands10") as $cmd10){
if($item->getID() == $configitem10){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $player->getName(), $cmd10));
         }
      }
}
public function onInteract(PlayerInteractEvent $event){
    $item = $event->getItem();
    if($item->getId() == Item::COMPASS && ($event->getAction() == PlayerInteractEvent::RIGHT_CLICK_AIR || $event->getAction() == PlayerInteractEvent::RIGHT_CLICK_BLOCK)){
        $player = $event->getPlayer();
        $player->getInventory()->open($player);
    }
}

private function saveInventory(Player $player,Level $level) {
$n = trim(strtolower($player->getName()));
if($n === "") return false;
$d = substr($n,0,1);
if(!is_dir($this->getDataFolder().$d)) mkdir($this->getDataFolder().$d);
$path =$this->getDataFolder().$d."/".$n.".yml";
$cfg = new Config($path,Config::YAML);
$yaml = $cfg->getAll();
$ln = trim(strtolower($level->getName()));
$yaml[$ln] = [];
foreach($player->getInventory()->getContents() as $slot=>&$item) {
$yaml[$ln][$slot] = implode(":",[ $item->getId(),
$item->getDamage(),
$item->getCount() ]);
}
$cfg->setAll($yaml);
$cfg->save();

		return true;
}

private function loadInventory(Player $player,Level $level) {
$n = trim(strtolower($player->getName()));
if($n === "") return false;
$d = substr($n,0,1);
$path =$this->getDataFolder().$d."/".$n.".yml";
if(!is_file($path)) return false;
$cfg = new Config($path,Config::YAML);
$yaml = $cfg->getAll();
$ln = trim(strtolower($level->getName()));
if (!isset($yaml[$ln])) return false;
foreach($yaml[$ln] as $slot=>$t) {
list($id,$dam,$cnt) = explode(":",$t);
$item = Item::get($id,$dam,$cnt);
$player->getInventory()->setItem($slot,$item);
}

		return true;

	}

	public function onLevelChange(EntityLevelChangeEvent $event){
echo __METHOD__.",".__LINE__."\n";//##DEBUG
if($event->isCancelled()) return;
$player = $event->getEntity();
if(!($player instanceof Player)) return;

if($player->isCreative()) return;
if(!$this->saveInventory($player,$event->getOrigin())) return;
$player->getInventory()->clearAll();
if(!$this->loadInventory($player,$event->getTarget())) return;
$slot = $this->getConfig()->get("slot");
$item = $this->getConfig()->get("ID");
$damage = $this->getConfig()->get("Damage");
$ammount = $this->getConfig()->get("Ammount");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot2");
$item = $this->getConfig()->get("ID2");
$damage = $this->getConfig()->get("Damage2");
$ammount = $this->getConfig()->get("Ammount2");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot3");
$item = $this->getConfig()->get("ID3");
$damage = $this->getConfig()->get("Damage3");
$ammount = $this->getConfig()->get("Ammount3");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot4");
$item = $this->getConfig()->get("ID4");
$damage = $this->getConfig()->get("Damage4");
$ammount = $this->getConfig()->get("Ammount4");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot5");
$item = $this->getConfig()->get("ID5");
$damage = $this->getConfig()->get("Damage5");
$ammount = $this->getConfig()->get("Ammount5");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot6");
$item = $this->getConfig()->get("ID6");
$damage = $this->getConfig()->get("Damage6");
$ammount = $this->getConfig()->get("Ammount6");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot7");
$item = $this->getConfig()->get("ID7");
$damage = $this->getConfig()->get("Damage7");
$ammount = $this->getConfig()->get("Ammount7");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot8");
$item = $this->getConfig()->get("ID8");
$damage = $this->getConfig()->get("Damage8");
$ammount = $this->getConfig()->get("Ammount8");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot9");
$item = $this->getConfig()->get("ID9");
$damage = $this->getConfig()->get("Damage9");
$ammount = $this->getConfig()->get("Ammount9");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
$slot = $this->getConfig()->get("slot10");
$item = $this->getConfig()->get("ID10");
$damage = $this->getConfig()->get("Damage10");
$ammount = $this->getConfig()->get("Ammount10");
$level = $event->getLevel();
$world = $this->getConfig()->get("world");
if($level == $world && $slot <= 35){
$player->getInventory()->setItem($slot , Item::get($item, $damage, $ammount));
   }
	}
}
