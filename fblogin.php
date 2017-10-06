<?php
	include "template_head.php";

	//$get_sql = "select * from admin";
	//$result = mysqli_query($link,$get_sql);
	//$result = mysqli_query($link,$get_sql);


?>

<style type="text/css">

#content {
   width: 300px;
   margin: 0px auto;
}


</style>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
        testAPI();
    } else if (response.status === 'not_authorized') {
        //$("#status").html("คุณไม่ได้รับอนุญาตให้ใช้งานเว็บนี้");
        $("#fbloginbt").show();
    } else {
      // The person is not logged into your app or we are unable to tell.
        $("#fbloginbt").show();
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '848155985339713',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
       statusChangeCallback(response);
    });

  };

  /*function loginfb() {
      FB.login(function(response) {
            if (response.authResponse) {
             console.log('Welcome!  Fetching your information.... ');
             FB.api('/me', function(response) {
               console.log('Good to see you, ' + response.name + '.');
             });
            } else {
             console.log('User cancelled login or did not fully authorize.');
            }
      });
  }

  function logoutfb() {
      FB.logout(function(response) {
          // user is now logged out
          console.log('Log out!!!');
        });
  }*/

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
      var pro_img;
      FB.api( "/me/picture?type=large", function (response) {
            if (response && !response.error) {

             $("#fbprofileimg").html("<img src='"+response.data.url+"' alt='' class='img-circle profile_img' />");
             pro_img = response.data.url;
             //alert(pro_img);
             console.log('Welcome!  Fetching your information.... ');
             FB.api('/me?fields=email,first_name, last_name, picture', function(response) {
               //console.log('Successful login for: ' + response.name);
               $("#fbname").html("<b>"+response.first_name+" "+response.last_name+"</b>");
               //$(".fb_pro_img_nav").html("<img src='"+pro_img+"' /> "+response.first_name+" "+response.last_name+"&nbsp;<span class=' fa fa-angle-down'></span>");

               //var data = "fb=1&email="+response.email+"&name="+response.first_name+" "+response.last_name+"&pro_img="+pro_img;

               //alert(data);
               //return false;
               /*$.ajax({
                   type		:	"POST",
                   url		:	"login_verify.php",
                   data		:	data,
                   success	:	function(html) {

                                   //alert(html);
                                   if (html == "1") {
                                       window.location = "main.php";
                                       alert("log in สำเร็จ");
                                   } else if (html == "0") {
                                       alert("ไม่พบข้อมูลหรือคุณกรอก password ผิด");
                                   }

                               }
               });*/
             });
            }
      });

      $("#login_section").show();
      $("#fbloginbt").hide();
   //$(".fb_bt_zone").hide();
   //$(".fb_profile_zone").show();
  }


</script>

<script type="text/javascript">

$(document).ready(function(){



   $("#fbclick").click(function(){

      var user_pic = $("#fbprofileimg img").attr("src");
      var fullname = $("#fbname").text();
		var empn = $("input[name='txt_empn']").val();
		if (empn == ""){
			alert("โปรดใส่เลขประจำตัว");
			return false;
		}
      //alert(user_pic+" "+fullname);
      //alert(encodeURIComponent(user_pic));
      var data = "fb=1&user_pic="+encodeURIComponent(user_pic)+"&fullname="+fullname+"&empn="+empn;

      //alert(data);

      $.ajax({
          type		:	"POST",
          url		:	"login_verify.php",
          data		:	data,
          success	:	function(html) {

                          //alert(html);
                          if (html == "1") {
                              window.location = "index.php";
                              alert("log in สำเร็จ");
                          } else if (html == "0") {
                              alert("ไม่พบข้อมูลหรือคุณกรอก password ผิด");
                          }

                      }
      });
   });

});

</script>
	<!-- <div style="margin : 0px 0px 10px 10px;width:100%">
		<img src="img/hot-item.png" id="hot-item" style="width : 130px;text-align:right" />
	</div> -->

	<div class="panel panel-default">
		<div class="panel-body">

         <!-- <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div> -->
         <div id="content" >
         <div class="panel panel-warning">
            <div class="panel-heading" style="text-align:center"><img src="img/login.png" style="width:30px;" />&nbsp;&nbsp;Log In เข้าใช้งานระบบด้วย Facebook</div>

            <div id="login_section" style="display:none" >
               <div id="login_info" style="text-align:center;padding:10px 10px 10px 10px;" >

                  <span>คุณต้องการใช้ระบบด้วย Facebook บัญชีนี้</span><br>
                  <span id="fbprofileimg"></span>&nbsp;<span id="fbname"></span>
                  <br><br>
						ใส่เลขประจำตัว&nbsp;<input type="text" name="txt_empn" value="" class="form-control" style="text-align:center" />
						<br><br>
                  <img src="img/fblogin.png" id="fbclick" style="cursor:pointer;" />
                  <!-- ><input type="checkbox" name="cb_reme" value="re1"> Remember Me -->
                  <!-- <a href="forget_login.php" id="link_forget" >[ Forget ]</a> -->
                  <div id="login_result">
                  <?php
                     //echo $_COOKIE["login_verify"];
                     /*if (isset($_COOKIE["login_verify"]) and isset($_COOKIE["full_name"])) {
                        if (($_COOKIE["login_verify"] != "") and ($_COOKIE["full_name"] != "")) {
                           echo "<p>";
                           echo "Welcome ".$_COOKIE["full_name"]."<br>";
                           echo "</p>";
                           //echo "Test by Khunponpun";
                        }
                     }*/
                  ?>
                  </div>
               </div>
            </div>

            <div id="fbloginbt" style="text-align:center;margin-top:30px;margin-bottom:30px;display:none">

                  <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                  </fb:login-button> -->

                  <div class="fb-login-button" scope="public_profile,email" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();"></div>
                           <!-- <a href="#" onclick="loginfb();" >Log In</a> -->

                  <div id="status">
                  </div>

                           <!-- <a href="#" onclick="logoutfb();">Log Out</a> -->

            </div>

            </div>

         </div>
		</div>
	</div>




<?php include "template_bot.php"; ?>
