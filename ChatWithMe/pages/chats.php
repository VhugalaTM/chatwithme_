<?php 
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    if(empty($_SESSION['myUsername'])){
        header("Location: ../access.php");
    }
    if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }

    // ACCESSING THE FRIENDS NAME FROM THE URL
    if(isset($_GET['inboxUser'])){
        $inboxUser=$_GET['inboxUser'];
    }
    $_SESSION['receiver']=$inboxUser;

    $login=$database->prepare("SELECT * FROM user WHERE username=:username");
    $login->bindParam(":username", $inboxUser);
    $login->execute();
    $login_status=$login->fetch();    
    if($login_status==""){
        header("Location: dashboard.php");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="chat.css">
        <link rel="stylesheet" href="../icons/css/all.css">
        <script src="htmx.min.js"></script>
        <title>ChatWithMe</title>
    </head>
    <body>
        <div class='head'>
            <div>
                <span class="logo">ChatWithMe</span><br>
                <span class="signature">Web.by BrokenCafe</span>
            </div>
        </div>
        <div class="main">
            <div class="main-head">
                <div class='friend'>
                    <div class="user">
                        <?php 
                            if(isset($inboxUser)) echo $inboxUser;
                        ?> -
                        <span
                            hx-post="active.php"
                            hx-trigger="load, every 1ms"
                        ></span> 
                    </div>
                </div>
                <div class='navigation'>
                    <button class="friend-list">
                        <a href="dashboard.php">Friend List</a>
                    </button>
                    
                    <button class="logout">
                        <a href="logout.php">Logout</a>
                    </button>
                </div>
            </div>
            
            <div 
                class='chat-tab'
                hx-post="chatsTab.php"
                hx-trigger="load, every 1s"
                hx-on::after-request="
                document.querySelector('.chat-tab').scrollTop=document.querySelector('.chat-tab').scrollHeight
                "
            >  
            </div>
        
            <div class='text-tab'>
                <form method='post' autocomplete='off'>
                    <table width="100%">
                        <tr>
                            <td class="errorTab">
                                <div class='error'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="input">
                                <textarea name="message" placeholder='Type Your Message Here'></textarea>
                            </td>
                            <td class="send" align="right">
                                <button 
                                    hx-post="sendText.php"
                                    hx-target=".error"
                                    hx-on::after-request="
                                        if(document.querySelector('textarea').value!=''){
                                            document.querySelector('textarea').value=''
                                        }
                                    "
                                >
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </td>
                        </tr>
                    </table> 
                </form>
            </div>
        </div>

        <div class='left-side'></div>
        <div class='right-side'></div>
        <div class='footer'></div> 
    </body>
</html>
<script>
    var textarea=document.querySelector(".input textarea");
    textarea.focus();    
</script>
