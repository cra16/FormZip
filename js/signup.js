var check_arr = [0,0,0,0];


function NameCheck(){
	var name = document.getElementById("name");

	if(name.value == "")
	{
		document.getElementById("idMsg").style.display="block";
		document.getElementById("idMsg").innerHTML="필수정보입니다";
		check_arr[0]=0;
	}
		
	else{
		document.getElementById("idMsg").style.display="none";
		check_arr[0]=1;		
	}
}


function UserIdCheck(){
	var userid = document.getElementById("userid");

	if(userid.value == "")
	{
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="필수정보입니다";
		check_arr[1]=0;
	}
	
	else if(userid.value.length <5)
	{
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="5~20자만 사용 가능합니다";
		check_arr[1]=0;
	}

	else{
		document.getElementById("userIdMsg").style.display="none";		
		check_arr[1]=1;
	}
}

function PWCheck(){
	var pw = document.getElementById("pw");
	var confirm = document.getElementById("confirm");

	if(confirm.value == "")
	{
		if(pw.value =="")
		{
			document.getElementById("pwMsg").style.display="block";
			document.getElementById("pwMsg").innerHTML="필수정보입니다";
			check_arr[2]=0;
		}

		else
		{
			document.getElementById("pwMsg").style.display="none";		
		    check_arr[2]=1;
		}		
	}

	else
	{  
		if(pw.value =="")
		{
			document.getElementById("pwMsg").style.display="block";
			document.getElementById("pwMsg").innerHTML="필수정보입니다";
			check_arr[2]=0;
		}

		else
		{
			if(pw.value != confirm.value)
			{
				document.getElementById("pwMsg").style.display="none";		
		   		check_arr[2]=1;

		   		document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
				document.getElementById("pscfMsg").style.color="#FF8080";
				check_arr[3]=0;
			}

			else
			{
				document.getElementById("pwMsg").style.display="none";		
		   		check_arr[2]=1;

		   		document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").style.color="#66FF66";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치합니다";
				check_arr[3]=1;
			}
		}		
	}
}

function PsCfCheck(){
	var confirm = document.getElementById("confirm");
	var pw = document.getElementById("pw");

	if(pw.value == "")
	{
		if(confirm.value=="")
		{
			document.getElementById("pscfMsg").style.display="block";
			document.getElementById("pscfMsg").innerHTML="필수정보입니다";
			document.getElementById("pscfMsg").style.color="#FF8080";
			check_arr[3]=0;
		}

		else
		{
			document.getElementById("pscfMsg").style.display="block";
			document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
			check_arr[3]=0;
		}
	}


	else
	{
		if(confirm.value=="")
		{
			document.getElementById("pscfMsg").style.display="block";
			document.getElementById("pscfMsg").innerHTML="필수정보입니다";
			document.getElementById("pscfMsg").style.color="#FF8080";
			check_arr[3]=0;
		}

		else
		{
			if(confirm.value != pw.value)
			{
				document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
				document.getElementById("pscfMsg").style.color="#FF8080";
				check_arr[3]=0;
			}

			else
			{
				document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").style.color="#66FF66";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치합니다";
				check_arr[3]=1;
			}
		}
	}
}

function IsFilled(){
	var i=0;

	for(i=0; i<4; i++){
		if(check_arr[i]==0){
			document.getElementById("sbMsg").style.display="block";
			
			document.getElementById("sbMsg").innerHTML="입력사항을 다시 확인해주세요";
			return;
		}		
	}

	document.getElementById("sbMsg").style.display="none";
}





