<?php 
    session_start();
    include 'dbConnection.php';
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
    
    //PREVENTS A USER FROM USING THIS PAGE AFTER LOGGING OUT
    if(empty($_SESSION['myUsername'])){
        header("Location: ../access.php");
    }
     if(!empty($_SESSION['myUsername'])){
        $userName=$_SESSION['myUsername'];
    }

    //DISPLAYING THE USER NAME
    $userInfo=$database->prepare("SELECT * FROM user WHERE username=:username");
    $userInfo->bindParam(':username', $userName);
    $userInfo->execute();
    $info=$userInfo->fetch();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="dashboard1.css">
        <link rel="stylesheet" href="../icons/css/all.css">
        <script src='htmx.min.js'></script>
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
            <!--        USER DETAILS AND NAV      -->
            <div class='username'>
                <div>
                    <?php
                        if($info['username']==""){
                            header("Location: ../access.php");
                        }
                        echo $info['username'], ' - ', $info['login_status']; 
                    ?>
                </div>
                <button>
                    <a href="logout.php">Logout</a>
                </button>
            </div>

            <!--        SEARCH TAB      -->
            <div class='search'>
                <form method='post' id="search-form">
                    <input type="text" name='friend' placeholder='search a friend' autocomplete='off' class="myInput">
                    <button 
                        name='add' 
                        id="searchBtn"
                        hx-post="backend/dashboardBack.php"
                        hx-target=".error"
                        hx-on::after-request="
                            if(document.querySelector('.myInput').value!=''){
                                document.querySelector('.myInput').value=''
                            }
                        "
                    >
                        <i class="fas fa-add"></i>
                    </button>
                </form>
                <div class="error"></div>
            </div>

            <div class='inbox'>
                <div 
                    class='count-friends'
                    hx-post="backend/countFriends.php"
                    hx-trigger="load, every 1s"
                ></div>
                <div 
                    class="friendList"
                    hx-post="backend/friendList.php"
                    hx-trigger="load, every 1s"
                >
                </div>
            </div>
            <div class='delete-footer'>
                <button>
                    <?php 
                        echo "<a href=deleteUser.php?username=$info[username]>Delete Account</a>";
                    ?>
                </button>
            </div>
        </div>
        
        <div class='left-side'></div>
        <div class='right-side'></div>
        <div class='footer'></div>
    </body>
</html>
