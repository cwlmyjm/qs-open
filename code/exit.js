function exit(){
	setCookie("username", "", -1);
	setCookie("randomkey", "", -1);
	alert('退出成功：）');
	window.location.href="index.php"; 
	
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}