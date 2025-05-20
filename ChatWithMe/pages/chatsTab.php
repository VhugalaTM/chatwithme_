<?php 
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }
    $inboxUser=$_SESSION['receiver'];

    //DISPLAYING THE MESSAGES
    $display_msg=$database->prepare("SELECT * FROM messages WHERE (username=:username AND inbox_user=:inbox_user) OR (inbox_user=:username AND username=:inbox_user)");
    $display_msg->bindParam(":username", $userName);
    $display_msg->bindParam(":inbox_user", $inboxUser);
    $display_msg->setFetchMode(PDO::FETCH_ASSOC);
    $display_msg->execute();

    while($msg=$display_msg->fetch()){
        $sender=$msg['username'];
        $receiver=$msg['inbox_user'];
        $content=$msg['message_content'];
        $date=$msg['date_time'];

        if($userName==$sender && $inboxUser==$receiver){
            echo "
                <div class=sent>
                    <table>
                    <tr>
                        <td>
                            $content
                        </td>
                        <td align=right>
                            <a href=deleteSender.php?delMessage=$msg[message_id]>
                                <span class='fa-solid fa-trash'></span>
                            </a>
                
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 class=time>$date</td>
                    </tr>
                    </table>
                </div>
                
            ";
        }elseif($userName==$receiver && $inboxUser==$sender){
            echo "
                <div class=receipient>
                    <div class=receiver>
                        <table>
                            <tr>
                                <td>
                                    $content
                                </td>
                                <td align=right>
                                    <a href=deleteReceiver.php?delReceiver=$msg[message_id]>
                                        <span class='fa-solid fa-trash'></span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 class=r-time>
                                $date 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            ";
        }
    }
    
?>