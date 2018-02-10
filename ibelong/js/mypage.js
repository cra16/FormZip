function PwCheck(){
    var pass1 = document.getElementById('newp');    
    var pass2 = document.getElementById('pw');        
    var error = document.getElementById('ps_ck');    

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
    var current = document.getElementById("current");
    var pass1 = document.getElementById('newp');    
    var pass2 = document.getElementById('pw');       
    var nonchar = /^[a-z0-9]{5,15}$/g;

 
    if( pass2.value != pass1.value)
    {
        alert("새로 입력한 비밀번호가 일치하지 않습니다.");
        return false;
    }

    else if (!nonchar.test(pass1.value)) {
        alert("5~15자의 영문 소문자 또는 숫자만 입력해주세요");
        return false;
    }



}
