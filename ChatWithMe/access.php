<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="access.css">
        <link rel="stylesheet" href="icons/css/all.css">
        <title>ChatWithMe</title>
    </head>
    <body>
        <div class='head'>
            <div>
                <span class='logo'>ChatWithMe<span><br>
                <span class='signature'>Web.by BrokenCafe</span>
            </div>
        </div>

        <!--    LOGIN    -->
        <div class='main'>
            <div class='login'>
                <form method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="login-form">
                    <table width=100%>
                        <tr>
                            <td class='login-head'>
                                <div>Login</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='error'>
                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class='login-user'>
                                <input type="text" name='username' placeholder='username' autocomplete='off' value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class='login-password'>
                                <input type="password" name='password' placeholder='password' autocomplete='off' value="<?php if(isset($_POST['password'])) echo htmlentities($_POST['password']); ?>" id="password" >
                                <i class='fa fa-eye'></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="login-btn">
                                <button type='submit' name='login' id="login">Login</button>
                                <button onClick="window.location.reload()">
                                    clear entries
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class='login-update'>
                                <button id="bottom">
                                    <a href="#update">update password</a>
                                </button>
                            </td>
                        </tr>
                    </table>                    
                </form>
            </div>
            <br>

            <!--    REGISTRATION     -->
            <div class="r-main">
                <div class='register'>
                    <form method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="register-form">
                        <table width="100%">
                            <tr>
                                <td class='register-head'>
                                    <div>Register</div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="error2">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="register-user"> 
                                    <input type="text" name='r-username' placeholder='username' autocomplete='off' value="<?php if(isset($_POST['r-username'])) echo htmlentities($_POST['r-username']); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class='hint'>
                                    <div>enter a max of 15 characters</div>
                                </td>
                            </tr>
                            <tr>
                                <td class='back-user'>
                                    <input type="password" name='r-username-2' placeholder='backup username' autocomplete='off' value="<?php if(isset($_POST['r-username-2'])) echo htmlentities($_POST['r-username-2']); ?>" id="backuser">
                                    <i class='fa fa-eye' id="backuserEye"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class='hint'>
                                    <div>enter a max of 50 characters</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="register-password">
                                    <input type="password" name='r-password' placeholder='password' autocomplete='off' value="<?php if(isset($_POST['r-password'])) echo htmlentities($_POST['r-password']); ?>" id="r-password">
                                    <i class='fa fa-eye' id="r-passEye"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class='hint'>
                                    <div>enter a max of 50 characters</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="register-btn">
                                    <button type='submit' name='register' id="register">Register</button>
                                    <button onClick="window.location.reload()">
                                        clear entries
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <br>

            <!--    CHANGE PASSWORD    -->
            <div id='update'>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="update-form">
                    <table width="100%">
                        <tr>
                            <td class="update-head">
                                <div>Change password</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='error3'></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="update-user">
                                <input type="password" autocomplete='off' placeholder='backup username' name='u_username' value="<?php if(isset($_POST['u_username'])) echo htmlentities($_POST['u_username']); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="update-password">
                                <input type="password" autocomplete='off' placeholder='new password' name='u_password' value="<?php if(isset($_POST['u_password'])) echo htmlentities($_POST['u_password']); ?>" id="u-password"/>
                                <i class="fa fa-eye" id="u-eye"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="update-btn">
                                <button type='submit' name='update' id="updateBtn">
                                    Update
                                </button>
                                <button onClick="window.location.reload()">
                                    clear entries
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
    
    /*                            LOGIN SCRIPTING                        */

    /*          AJAX FOR LOGING IN               */
    var loginBtn=document.getElementById("login");
    var formLogin=document.getElementById("login-form");
    var loginError=document.querySelector(".login .error");

    formLogin.onsubmit=(a)=>{
        a.preventDefault();
    }

    loginBtn.onclick=()=>{
        var backAccess=new XMLHttpRequest();
        backAccess.open("POST", "backAccess.php", true);
        backAccess.onload=()=>{
            if(backAccess.readyState==XMLHttpRequest.DONE){
                if(backAccess.status==200){
                    var data=backAccess.response;
                    if(data=="logged"){
                        location.href="pages/dashboard.php";
                    }else{
                        loginError.style.display="block";
                        loginError.textContent=data;
                    }
                }
            }
        }
        var loginData=new FormData(formLogin);
        backAccess.send(loginData);
    }

    /*          LOGIN PASSWORD VISIBILITY TOGGLE       */
    var password = document.querySelector("#password");
    var eyeIcon = document.querySelector(".fa-eye");

    eyeIcon.onclick = ()=>{
        if(password.type == "password"){
            password.type='text';
            eyeIcon.style.color="orange";
        }else{
            password.type='password';
            eyeIcon.style.color="white";
        }
    }


    /*                            REGISTER SCRIPTING                        */

    /*           AJAX FOR REGISTERING        */
    var registerForm=document.getElementById("register-form");
    var registerBtn=document.getElementById("register");
    var registerError=document.querySelector(".register .error2");

    registerForm.onsubmit=(b)=>{
        b.preventDefault();
    }
    registerBtn.onclick=()=>{
        var backAccess=new XMLHttpRequest();
        backAccess.open("POST", "backAccess2.php", true);
        backAccess.onload=()=>{
            if(backAccess.readyState==XMLHttpRequest.DONE){
                if(backAccess.status==200){
                    var data=backAccess.response;
                    if(data=="registered"){
                    }else{
                        registerError.style.display="block";
                        registerError.textContent=data;
                    }
                }
            }
        }
        var registerData=new FormData(registerForm);
        backAccess.send(registerData);
    }


    /*          REGISTER PASSWORD VISIBILITY TOGGLE       */
    var user=document.getElementById("backuser");
    var eyeIcon2=document.getElementById("backuserEye");

    eyeIcon2.onclick = () =>{
        if(user.type=="password"){
            user.type="text";
            eyeIcon2.style.color="orange";
        }else{
            user.type="password";
            eyeIcon2.style.color="white";
        }
    }

    var password2=document.getElementById("r-password");
    var eyeIcon3=document.getElementById("r-passEye");

    eyeIcon3.onclick = () =>{
        if(password2.type=="password"){
            password2.type="text";
            eyeIcon3.style.color="orange";
        }else{
            password2.type="password";
            eyeIcon3.style.color="white";
        }
    }    
    
    /*                            UPDATING PASSWORD SCRIPTING                        */

    /*          AJAX FOR UPDATING PASSWORD       */
    var updateForm=document.getElementById("update-form");
    var updateBtn=document.getElementById("updateBtn");
    var updateError=document.querySelector("#update-form .error3");

    updateForm.onsubmit=(c)=>{
        c.preventDefault();
    }
    updateBtn.onclick=()=>{
        var backAccess=new XMLHttpRequest();
        backAccess.open("POST","backAccess3.php", true);
        backAccess.onload=()=>{
            if(backAccess.readyState==XMLHttpRequest.DONE){
                if(backAccess.status==200){
                    var data=backAccess.response;
                    if(data=="updated"){
                    }else{
                        updateError.style.display="block";
                        updateError.textContent=data;
                    }
                }
            }
        }
        var updateData=new FormData(updateForm);
        backAccess.send(updateData);
    }

    /*          CHANGE PASSWORD          */
    var password3=document.getElementById("u-password");
    var eyeIcon4=document.getElementById("u-eye");

    eyeIcon4.onclick = () =>{
        if(password3.type=="password"){
            password3.type="text";
            eyeIcon4.style.color="orange";
        }else{
            password3.type="password";
            eyeIcon4.style.color="white";
        }
    }    


</script>
