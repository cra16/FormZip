var check_arr = [0,0,0,0,0,0];
var Msg=["idMsg","userIdMsg","pwMsg","pscfMsg","stuidMsg","birthMsg"];

//이름 유효성 검사 => 빈칸/공백 사용불가
function NameCheck(){
	var name = document.getElementById("name");

	if(name.value == "")
	{
		document.getElementById("idMsg").style.display="block";
		document.getElementById("idMsg").innerHTML="필수정보입니다";
		check_arr[0]=0;
	}
		
	else if(name.value.indexOf(" ")>0)
	{
		document.getElementById("idMsg").style.display="block";
		document.getElementById("idMsg").innerHTML="이름에 공백을 사용할 수 없습니다.";
		check_arr[0]=0;		
	}

	else{
		document.getElementById("idMsg").style.display="none";
		check_arr[0]=1;		
	}
}


function UserIdCheck(){
	var userid = document.getElementById("userid");

    // 아무것도 입력되지 않을 경우
	if(userid.value == "")
	{
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="필수정보입니다";
		check_arr[1]=0;
	}


	else{
		    for (i=0; i<userid.value.length; i++)
		  	{
		      var ch = userid.value.charAt(i);//문자를 반환(정수형), 범위 검사 가능
		      //입력된 문자를 검사
		 	  if ( ( ch < "a" || ch > "z") && (ch < "A" || ch > "Z") && (ch < "0" || ch > "9" ) )
		      {
				document.getElementById("userIdMsg").style.display="block";
				document.getElementById("userIdMsg").innerHTML="아이디는 영어 소문자와 숫자의 조합으로 입력해주세요";
				check_arr[1]=0;
			  	return;
			  }
		    }	

			// 입력이 5자 미만일 경우
			if(userid.value.length <5)
			{
				document.getElementById("userIdMsg").style.display="block";
				document.getElementById("userIdMsg").innerHTML="5~15자만 사용 가능합니다";
				check_arr[1]=0;
			}

			else{
				document.getElementById("userIdMsg").style.display="none";		
				check_arr[1]=1;
			}
		}

}

function PWCheck(){
	var pw = document.getElementById("pw");
	var confirm = document.getElementById("confirm");
	
    for (i=0; i<pw.value.length; i++)
  	{
      var ch = pw.value.charAt(i);//문자를 반환(정수형), 범위 검사 가능
      //입력된 문자를 검사
 	  if ( ( ch < "a" || ch > "z") && (ch < "A" || ch > "Z") && (ch < "0" || ch > "9" ) )
      {
		document.getElementById("pwMsg").style.display="block";
		document.getElementById("pwMsg").innerHTML="비밀번호는 영어 소문자와 숫자의 조합으로 입력해주세요";
		check_arr[2]=0;
		check_arr[3]=0;
	  return;
	  }

    }	

	if(pw.value.length <5)
	{
		document.getElementById("pwMsg").style.display="block";
		document.getElementById("pwMsg").innerHTML="5~15자만 사용 가능합니다";
		check_arr[2]=0;
		check_arr[3]=0;
		return;
	}

	if(confirm.value == "")
	{
		if(pw.value =="")
		{
			document.getElementById("pwMsg").style.display="block";
			document.getElementById("pwMsg").innerHTML="필수정보입니다";
			check_arr[2]=0;
			check_arr[3]=0;
		}

		else
		{
			document.getElementById("pwMsg").style.display="none";		
		    check_arr[2]=0;
		    check_arr[3]=0;
		}		
	}

	else
	{  
		if(pw.value =="")
		{
			document.getElementById("pwMsg").style.display="block";
			document.getElementById("pwMsg").innerHTML="필수정보입니다";
			check_arr[2]=0;
			check_arr[3]=0;
		}

		else
		{
			if(pw.value != confirm.value)
			{
				document.getElementById("pwMsg").style.display="none";		
		   		document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
				document.getElementById("pscfMsg").style.color="#FF8080";
				check_arr[2]=0;
				check_arr[3]=0;
			}

			else
			{
				document.getElementById("pwMsg").style.display="none";		
		   		document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").style.color="#66FF66";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치합니다";
				check_arr[2]=1;
				check_arr[3]=1;
			}
		}		
	}
}

function PsCfCheck(){
	var confirm = document.getElementById("confirm");
	var pw = document.getElementById("pw");

    for (i=0; i<confirm.value.length; i++)
  	{
      var ch = confirm.value.charAt(i);//문자를 반환(정수형), 범위 검사 가능
      //입력된 문자를 검사
 	  if ( ( ch < "a" || ch > "z") && (ch < "A" || ch > "Z") && (ch < "0" || ch > "9" ) )
      {
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="비밀번호는 영어 소문자와 숫자의 조합으로 입력해주세요";
		document.getElementById("pscfMsg").style.color="#FF8080";
		check_arr[2]=0;
		check_arr[3]=0;
	  return;
	  }

    }	

	if(confirm.value.length <5)
	{
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="5~15자만 사용 가능합니다";
		document.getElementById("pscfMsg").style.color="#FF8080";

		check_arr[2]=0;
		check_arr[3]=0;
		return;
	}

	if(pw.value == "")
	{
		if(confirm.value=="")
		{
			document.getElementById("pscfMsg").style.display="block";
			document.getElementById("pscfMsg").innerHTML="필수정보입니다";
			document.getElementById("pscfMsg").style.color="#FF8080";
			check_arr[2]=0;
			check_arr[3]=0;
		}

		else
		{
			document.getElementById("pscfMsg").style.display="block";
			document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
			document.getElementById("pscfMsg").style.color="#FF8080";
			check_arr[2]=0;
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
			check_arr[2]=0;
			check_arr[3]=0;
		}

		else
		{
			if(confirm.value != pw.value)
			{
				document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
				document.getElementById("pscfMsg").style.color="#FF8080";
				check_arr[2]=0;
				check_arr[3]=0;
			}

			else
			{
				document.getElementById("pscfMsg").style.display="block";
				document.getElementById("pscfMsg").style.color="#66FF66";
				document.getElementById("pscfMsg").innerHTML="비밀번호가 일치합니다";
				check_arr[2]=1;
				check_arr[3]=1;
			}
		}
	}
}

function StuidCheck(){
	var stuid = document.getElementById("stuid");


    // 아무것도 입력되지 않을 경우
	if(stuid.value == "")
	{
		document.getElementById("stuidMsg").style.display="block";
		document.getElementById("stuidMsg").innerHTML="필수정보입니다";
		check_arr[4]=0;
	}

	else{
	   for (i=0; i<stuid.value.length; i++)
	  	{
	      var ch = stuid.value.charAt(i);//문자를 반환(정수형), 범위 검사 가능
	      //입력된 문자를 검사
	 	  if ((ch < "0" || ch > "9" ) )
	      {
			document.getElementById("stuidMsg").style.display="block";
			document.getElementById("stuidMsg").innerHTML="숫자만 입력해주세요";
			check_arr[4]=0;
		  return;
		  }
	    }	

		// 입력이 8자 미만일 경우
		if(stuid.value.length <8)
		{
			document.getElementById("stuidMsg").style.display="block";
			document.getElementById("stuidMsg").innerHTML="학번 8자리를 입력해주세요";
			check_arr[4]=0;
		}

		else{
			document.getElementById("stuidMsg").style.display="none";		
			check_arr[4]=1;
		}

	}


}

function BirthCheck(){
	var birth = document.getElementById("birth");
 	var year=parseInt(birth.value.substring(0,2));
 	var month=parseInt(birth.value.substring(2,4));
 	var day=parseInt(birth.value.substring(4,6));

   for (i=0; i<birth.value.length; i++)
  	{
      var ch = birth.value.charAt(i);//문자를 반환(정수형), 범위 검사 가능
      //입력된 문자를 검사
 	  if ((ch < "0" || ch > "9" ) )
      {
		document.getElementById("birthMsg").style.display="block";
		document.getElementById("birthMsg").innerHTML="숫자만 입력해주세요";
		check_arr[5]=0;
	  return;
	  }
    }	

    // 아무것도 입력되지 않을 경우
	if(birth.value == "")
	{
		document.getElementById("birthMsg").style.display="block";
		document.getElementById("birthMsg").innerHTML="필수정보입니다";
		check_arr[5]=0;
	}



	else if(month < 1 || month > 12)
	{ 
		document.getElementById("birthMsg").style.display="block";
		document.getElementById("birthMsg").innerHTML="생년월일 6자리를 입력해주세요";
		check_arr[5]=0;
	}

	else if(day < 1 || day > 31)
	{ 
		document.getElementById("birthMsg").style.display="block";
		document.getElementById("birthMsg").innerHTML="생년월일 6자리를 입력해주세요";
		check_arr[5]=0;
	} 	
 
 	// 입력이 8자 미만일 경우
	else if(birth.value.length <6)
	{
		document.getElementById("birthMsg").style.display="block";
		document.getElementById("birthMsg").innerHTML="생년월일 6자리를 입력해주세요";
		check_arr[5]=0;
	}

	else{
		document.getElementById("birthMsg").style.display="none";		
		check_arr[5]=1;
	}
}


function IsFilled(){
	var i=0;
	var count=0;
	for(i=0; i<6; i++){
		if(check_arr[i]==0){
			document.getElementById(Msg[i]).style.display="block";
			document.getElementById(Msg[i]).innerHTML="필수 항목입니다.";
			count++;
		}		
	}

	if(count>0)
	{
		document.getElementById("sbMsg").style.display="block";
		document.getElementById("sbMsg").innerHTML="입력사항을 다시 확인해주세요";
		return;		
	}


	document.getElementById("sbMsg").style.display="none";
}




function validateForm() {


	for(i=0; i<6; i++){
		if(check_arr[i]==0){
			return false;
		}		
	}


}