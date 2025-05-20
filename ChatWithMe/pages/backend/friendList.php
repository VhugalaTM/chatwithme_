<?php 
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

    $username=$_SESSION['myUsername'];

    $result=$database->prepare("SELECT * FROM inbox WHERE username=:username");
    $result->bindParam(":username", $username);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    while($data=$result->fetch()){
        $login=$database->prepare("SELECT * FROM user WHERE username=:username");
        $login->bindParam(":username", $data['inbox_user']);
        $login->execute();
        $login_status=$login->fetch();

        echo "
            <table>
                <tr>
                    <td class=inbox-user>
                        $data[inbox_user]
                    </td>
                    <td class=msg-btn>
                        <button>
                            <a href=chats.php?inboxUser=$data[inbox_user]>message</a>
                        </button>
                    </td>
                    <td class=trash-btn>
                        <a href=deleteInbox.php?id=$data[inbox_id]>
                            <span class='fa-solid fa-trash'></span>    
                        </a>
                    </td>
                    <td class=status>
                        <div>
                            $login_status[login_status]
                        </div>
                    </td>
                </tr>
            </table>
        ";
    }
    
?>
