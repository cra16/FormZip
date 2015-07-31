
function PwCheck(){
	var pass1 = document.getElementById('newp');	//새 비밀번호
	var pass2 = document.getElementById('pw');		//비밀번호 재입력
	var error = document.getElementById('ps_ck');	//error message

	if(pass1.value == null || pass1.value == ""){
		error.value ="";
	}

	else if(pass2.value == null || pass2.value == ""){
		error.value ="";
	}


	else if( pass2.value != pass1.value)
	{
		error.style.color="red";
		error.style.display="block";
		error.innerHTML="비밀번호 불일치";
	}

	else if( pass2.value == pass1.value)
	{
		error.style.color="green";
		error.style.display="block";
		error.innerHTML="비밀번호 일치";
	}


}



//전체 
function validateForm() {
	var now = document.getElementById("now");
	var current = document.getElementById("current");
	var pass1 = document.getElementById('newp');	//새 비밀번호
	var pass2 = document.getElementById('pw');		//비밀번호 재입력
	var nonchar = /^[a-z0-9]{5,15}$/g;



	if(now.value!= current.value){
		alert("기존 비밀번호를 다시 확인해주세요");
		return false;
	}

	else if( pass2.value != pass1.value)
	{
		alert("새로운 비밀번호가 일치하지 않습니다");
		return false;
	}

	else if (!nonchar.test(pass1.value)) {
		alert("5~15자의 영문 소문자,숫자만 이용가능합니다.");
		return false;
	}


}
