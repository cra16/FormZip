var check_arr = [0,0,0,0,0,0];
var Msg=["idMsg","userIdMsg","pwMsg","pscfMsg","stuidMsg","birthMsg"];
var checking=0;


//이름 유효성 검사 => 공백 / 한글 또는 영어 대소문자외에 불가
function NameCheck(){
	var name = document.getElementById("name");
	var nonchar = /[^가-힣ㄱ-ㅎㅏ-ㅣa-zA-Z]/gi;

	//공백인 경우
	if(name.value == "")
	{
		document.getElementById("idMsg").style.display="block";
		document.getElementById("idMsg").innerHTML="필수정보입니다";
		document.getElementById("idMsg").style.color="#FF8080";

		check_arr[0]=0;
	}

	//한글이나 영어가 아닌 경우
	else if (nonchar.test(name.value)) {
		document.getElementById("idMsg").style.display="block";
		document.getElementById("idMsg").innerHTML="이름에는 한글,영문 대소문자를 이용해주세요";
		document.getElementById("idMsg").style.color="#FF8080";
		check_arr[0]=0;		
	}

	//그 외
	else
	{
		document.getElementById("idMsg").style.display="none";
		check_arr[0]=1;		 
	}
}

function check_id(){
	var myWindow;
	var userid = document.getElementById("userid");
	var nonchar = /^[a-z0-9]{5,20}$/g;
	var w = (screen.availWidth-250)/2;
	var h = (screen.availHeight-100)/2;
	checking=1;

	//공백인 경우
	if(userid.value == "")
	{
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="필수 항목입니다.";
		document.getElementById("userIdMsg").style.color="#FF8080";
		check_arr[1]=0;
	}

	// 5~20자의 영문 소문자, 숫자가 아닌경우 
	else if (!nonchar.test(userid.value)) {
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="5~20자의 영문 소문자,숫자만 이용가능합니다.";
		document.getElementById("userIdMsg").style.color="#FF8080";

		check_arr[1]=0;	
	}

	else{

	myWindow=window.open("check_id.php?id="+document.getElementById('userid').value,
	"IDcheck", 'left='+w+',top='+h+',width='+250+',height='+100+',toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no');
	}
}

// 아이디 유효성 검사=>공백 / 5~20자의 영문 소문자, 숫자이외에 불가
function UserIdCheck(){
	var userid = document.getElementById("userid");
	var nonchar = /^[a-z0-9]{5,20}$/g;
	checking=0;
	//공백인 경우
	if(userid.value == "")
	{
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="필수 항목입니다.";
		document.getElementById("userIdMsg").style.color="#FF8080";

		check_arr[1]=0;
		return;
	}

	// 5~20자의 영문 소문자, 숫자가 아닌경우 
	else if (!nonchar.test(userid.value)) {
		document.getElementById("userIdMsg").style.display="block";
		document.getElementById("userIdMsg").innerHTML="5~20자의 영문 소문자,숫자만 이용가능합니다.";
		document.getElementById("userIdMsg").style.color="#FF8080";
		check_arr[1]=0;	
		return;	
	}

	else
	{
		document.getElementById("userIdMsg").style.display="none";		
		check_arr[1]=1;
	}
}

//비밀번호 
function PWCheck(){
	var pw = document.getElementById("pw");
	var confirm = document.getElementById("confirm");
	var nonchar = /^[a-z0-9]{5,15}$/g;

	if(pw.value == "")
    {
		document.getElementById("pwMsg").style.display="block";
		document.getElementById("pwMsg").innerHTML="필수정보입니다";
		check_arr[2]=0;
		check_arr[3]=0;
		return;
    }	
	// 5~20자의 영문 소문자, 숫자가 아닌경우 
	else if (!nonchar.test(pw.value)) {
		document.getElementById("pwMsg").style.display="block";
		document.getElementById("pwMsg").innerHTML="5~15자의 영문 소문자,숫자만 이용가능합니다.";
		check_arr[2]=0;
		check_arr[3]=0;
		return;	
	}
  
	else if(confirm.value == "")
	{
		document.getElementById("pwMsg").style.display="none";		
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

//비밀번호 확인
function PsCfCheck(){
	var confirm = document.getElementById("confirm");
	var pw = document.getElementById("pw");
	var nonchar = /^[a-z0-9]{5,15}$/g;

	if(confirm.value=="")
	{
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="필수정보입니다";
		document.getElementById("pscfMsg").style.color="#FF8080";
		check_arr[2]=0;
		check_arr[3]=0;
		return;
	}

	// 5~20자의 영문 소문자, 숫자가 아닌경우 
	else if (!nonchar.test(confirm.value)) {
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="5~15자의 영문 소문자,숫자만 이용가능합니다.";
		check_arr[2]=0;
		check_arr[3]=0;
		return;	
	}

	else if(pw.value == "")
	{
		document.getElementById("pscfMsg").style.display="block";
		document.getElementById("pscfMsg").innerHTML="비밀번호가 일치하지 않습니다";
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

//학번
function StuidCheck(){
	var stuid = document.getElementById("stuid");
	var checkid=document.all.checkid.value;
	var nonchar =  /^[0-9]{8,8}/gi;


    // 아무것도 입력되지 않을 경우
	if(stuid.value == "")
	{
		document.getElementById("stuidMsg").style.display="block";
		document.getElementById("stuidMsg").innerHTML="필수정보입니다";
		check_arr[4]=0;
		return;
	}

	else if (!nonchar.test(stuid.value)) {
		document.getElementById("stuidMsg").style.display="block";
		document.getElementById("stuidMsg").innerHTML="학번 8자리를 입력해 주세요";
		check_arr[4]=0;		
		return;
	}

	else{
		document.getElementById("stuidMsg").style.display="none";		
		check_arr[4]=1;
	}
}

//생년월일
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


//전체 
function validateForm() {
	var checkid=document.all.checkid.value;
	var i=0;
	var count=0;

	if(checking==0){
	document.getElementById("userIdMsg").style.display="block";
	document.getElementById("userIdMsg").innerHTML="필수 항목입니다.";
	check_arr[1]=0;
	}

	for(i=0; i<6; i++){
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


	if(checkid==0){
	document.getElementById("userIdMsg").style.display="block";
	document.getElementById("userIdMsg").innerHTML="필수 항목입니다.";
	check_arr[1]=0;
	return false;
	}
}


