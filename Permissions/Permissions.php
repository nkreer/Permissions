<?php

namespace Permissions;

use IRC\Command\CommandInterface;
use IRC\Command\CommandSender;
use IRC\Plugin\PluginBase;
use IRC\User;

class Permissions extends PluginBase{

    public function onCommand(CommandInterface $command, CommandSender $sender, CommandSender $room, array $args){
        $user = User::getUserByNick($this->getConnection(), $args[1]);
        if($user instanceof User and $sender instanceof User){
            switch(strtolower($args[2])){
                case 'add':
                    if($sender->hasPermission("permissions.manage.add")){
                        if(!empty($args[3])){
                            $permission = $args[3];
                            if(!$user->hasPermission($permission)){
                                $user->addPermission($permission);
                                $sender->sendNotice("Added permission to ".$user->getNick());
                                if(!empty($args[4]) and strtolower($args[4]) === "keep"){
                                    $user->remember();
                                }
                            } else {
                                $sender->sendNotice($user->getNick()." already has that permission");
                            }
                        } else {
                            $sender->sendNotice("Argument 3 should not be empty");
                        }
                    } else {
                        $sender->sendNotice("You can't do that");
                    }
                    break;
                case 'remove':
                    if($sender->hasPermission("permissions.manage.remove")){
                        if(!empty($args[3])){
                            $permission = $args[3];
                            if($user->hasPermission($permission)){
                                $user->removePermission($permission);
                                $sender->sendNotice("The permission has been removed.");
                                if(!empty($args[4]) and strtolower($args[4]) === "keep"){
                                    $user->remember();
                                }
                            } else {
                                $sender->sendNotice("The user doesn't have that permission");
                            }
                        } else {
                            $sender->sendNotice("Argument 3 should not be empty");
                        }
                    } else {
                        $sender->sendNotice("You can't do that");
                    }
                    break;
            }
        } else {
            $sender->sendNotice("Unknown user");
        }
    }

}