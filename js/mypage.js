var check_arr = [0,0,0];
var Msg=["pw_cur","pw_new","ps_ck"];


//비밀번호 
function passWord(){
	var currnet = document.getElementById("current");
    if(current.value == "")
    {
		document.getElementById("pw_cur").style.display="block";
		document.getElementById("pw_cur").innerHTML="필수정보입니다";
		document.getElementById("pw_cur").style.color="#FF8080";
		check_arr[0]=0;
		
		return;
    }	
	else
	{ check_arr[0]=1;
		document.getElementById("pw_cur").style.display="none";
	  return;
	}
}
function PWCheck(){
	var newp = document.getElementById("newp");
	var nonchar = /^[a-z0-9]{5,15}$/g;


	if(newp.value == "")
    {
		document.getElementById("pw_new").style.display="block";
		document.getElementById("pw_new").innerHTML="필수정보입니다";
		document.getElementById("pw_new").style.color="#FF8080";

		check_arr[1]=0;
		
		return;
    }	
	// 5~20자의 영문 소문자, 숫자가 아닌경우 
	else if (!nonchar.test(newp.value)) {
		document.getElementById("pw_new").style.display="block";
		document.getElementById("pw_new").innerHTML="5~15자의 영문 소문자,숫자만 이용가능합니다.";
		document.getElementById("pw_new").style.color="#FF8080";
     	check_arr[1]=0;
		return;	
	}

	else
	{    document.getElementById("pw_new").style.display="block";
         document.getElementById("pw_new").style.color="#66FF66";
		 document.getElementById("pw_new").innerHTML="사용하실 수 있습니다";
		 check_arr[1]=1;
		 return;					
	}
}
//비밀번호 확인
function PsCfCheck(){
	var pw = document.getElementById("pw");
	var newp = document.getElementById("newp");
	var nonchar = /^[a-z0-9]{5,15}$/g;

	if(pw.value=="")
	{
		document.getElementById("ps_ck").style.display="block";
		document.getElementById("ps_ck").innerHTML="필수정보입니다";
		document.getElementById("ps_ck").style.color="#FF8080";
		check_arr[2]=0;
		return;
	}
	else
	{
		if(pw.value != newp.value)
		{
			document.getElementById("ps_ck").style.display="block";
			document.getElementById("ps_ck").innerHTML="비밀번호가 일치하지 않습니다";
			document.getElementById("ps_ck").style.color="#FF8080";
			check_arr[2]=0;
			return;
			
		}

		else
		{   document.getElementById("ps_ck").style.display="block";
			document.getElementById("ps_ck").style.color="#66FF66";
			document.getElementById("ps_ck").innerHTML="비밀번호가 일치합니다";
			check_arr[2]=1;
            return;
		}
		
	}
}



//전체 
function validateForm() {
	var i=0;
	var count=0;


	for(i=0; i<3; i++){
		if(check_arr[i]==0){
			document.getElementById(Msg[i]).style.display="block";
			document.getElementById(Msg[i]).innerHTML="필수 항목입니다.";
			count++;
		}		
	}

	if(count>0)
	{
		return false;		
	}

}
