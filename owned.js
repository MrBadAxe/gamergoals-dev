function add(buttonid, userid, gameid){
	// run external PHP script to add game
	if(userid == '' || gameid == ''){return -1};
	var query = './jsadd.php?userid='+userid+'&gameid='+gameid+'&status=B';

	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
                if(xmlhttp.readyState==4 && xmlhttp.status==200){
                        refreshButton(xmlhttp.responseText, buttonid);
                }else{
                        //document.getElementById("resultsDiv").innerHTML="loading, please wait...";
                }
        }
	xmlhttp.open("POST",query,true);
	xmlhttp.send();
}

function refreshButton(result,buttonid){
	// refresh this div so that it shows that the game is now in your collection
	var btn = document.getElementById(buttonid);
	if(result == "success"){
		btn.setAttribute("class","btn btn-large btn-block btn-success");
		btn.innerHTML="Added!";
		return 0;
	}else{
		btn.setAttribute("class","btn btn-large btn-block btn-danger");
		btn.innerHTML="Error:"+query;
		return -1;
	}
}
