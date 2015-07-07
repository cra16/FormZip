var check_arr = [0,0,0,0,0,0,0];


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


function StuIdCheck(){
	var stuId = document.getElementById("stuId");

	if(stuId.value == "")
	{
		document.getElementById("stuIdMsg").style.display="block";
		document.getElementById("stuIdMsg").innerHTML="필수정보입니다";
		check_arr[1]=0;
	}
		
	else{
		document.getElementById("stuIdMsg").style.display="none";
		check_arr[1]=1;
		}		
}


function PhoneCheck(){
	var phone_num = document.getElementById("phone_num");

	if(phone_num.value == "")
	{
		document.getElementById("phoneMsg").style.display="block";
		document.getElementById("phoneMsg").innerHTML="필수정보입니다";
		check_arr[2]=0;
	}
		
	else{
		document.getElementById("phoneMsg").style.display="none";	
		check_arr[2]=1;
		}	
}

function UserIdCheck(){
	var userid = document.getElementById("userid");

	if(userid.value == "")
	{
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="필수정보입니다";
		check_arr[3]=0;
	}
		
	else{
		document.getElementById("userIdMsg").style.display="none";		
		check_arr[3]=1;
	}
}

function PWCheck(){
	var pw = document.getElementById("pw");

	if(pw.value == "")
	{
		document.getElementById("pwMsg").style.display="block";
		document.getElementById("pwMsg").innerHTML="필수정보입니다";
		check_arr[4]=0;
	}
		
	else{
		document.getElementById("pwMsg").style.display="none";		
		check_arr[4]=1;
	}
}

function PsCfCheck(){
	var confirm = document.getElementById("confirm");
	var pw = document.getElementById("pw");

	if(pw.value == "")
	{
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="필수정보입니다";
		check_arr[5]=0;
	}

	else if(confirm.value != pw.value)
	{
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
		check_arr[5]=0;
	}
		
	else if(confirm.value == pw.value)
	{
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").style.color="#66FF66";
		document.getElementById("pscfMsg").innerHTML="비밀번호가 일치합니다";
		check_arr[5]=1;
	}

	else{
		document.getElementById("pscfMsg").style.display="none";		
		check_arr[5]=0;
	}
}

function IsFilled(){
	var i=0;

	for(i=0; i<6; i++){
		if(check_arr[i]==0){
			document.getElementById("sbMsg").style.display="block";
			
			document.getElementById("sbMsg").innerHTML="입력사항을 다시 확인해주세요";
			return;
		}		
	}

	document.getElementById("sbMsg").style.display="none";
}





