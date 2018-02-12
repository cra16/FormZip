// 군필여부
function Show1(){
	document.getElementById("showbox").style.display="block";
	document.getElementById("showbox").style.display="block";

}

function Blind1(){
	document.getElementById("showbox").style.display="none";
	document.getElementById("showbox").style.display="none";
}

//이메일 여부
function Show2(){
	document.getElementById("t_mail").style.display="block";
}

function Blind2(){
	document.getElementById("t_mail").style.display="none";
}

//학기
function Show3(){
	document.getElementById("t_activity").style.display="block";
}

function Blind3(){
	document.getElementById("t_activity").style.display="none";
}



///////////////////////////////////////////////////////////////


// This function change sub_question1
function Sub_Show1(){
	document.getElementById("title1").style.display="block";
	document.getElementById("explain1").style.display="block";
}

function Sub_Blind1(){
	document.getElementById("title1").style.display="none";
	document.getElementById("explain1").style.display="none";
}

// This function change sub_question2
function Sub_Show2(){
	document.getElementById("title2").style.display="block";
	document.getElementById("explain2").style.display="block";
}

function Sub_Blind2(){
	document.getElementById("title2").style.display="none";
	document.getElementById("explain2").style.display="none";
}
// This function change sub_question2
function Sub_Show3(){
	document.getElementById("title3").style.display="block";
	document.getElementById("explain3").style.display="block";
}

function Sub_Blind3(){
	document.getElementById("title3").style.display="none";
	document.getElementById("explain3").style.display="none";
}
// This function change sub_question3
function Sub_Show4(){
	document.getElementById("title4").style.display="block";
	document.getElementById("explain4").style.display="block";
}

function Sub_Blind4(){
	document.getElementById("title4").style.display="none";
	document.getElementById("explain4").style.display="none";
}
// This function change sub_question4
function Sub_Show5(){
	document.getElementById("title5").style.display="block";
	document.getElementById("explain5").style.display="block";
}

function Sub_Blind5(){
	document.getElementById("title5").style.display="none";
	document.getElementById("explain5").style.display="none";
}
// This function change sub_question5
function Sub_Show6(){
	document.getElementById("title6").style.display="block";
	document.getElementById("explain6").style.display="block";
}

function Sub_Blind6(){
	document.getElementById("title6").style.display="none";
	document.getElementById("explain6").style.display="none";
}
// This function change sub_question6
function Sub_Show7(){
	document.getElementById("title7").style.display="block";
	document.getElementById("explain7").style.display="block";
}

function Sub_Blind7(){
	document.getElementById("title7").style.display="none";
	document.getElementById("explain7").style.display="none";
}
// This function change sub_question6
function Sub_Show8(){
	document.getElementById("title8").style.display="block";
	document.getElementById("explain8").style.display="block";
}

function Sub_Blind8(){
	document.getElementById("title8").style.display="none";
	document.getElementById("explain8").style.display="none";
}
// This function change sub_question6
function Sub_Show9(){
	document.getElementById("title9").style.display="block";
	document.getElementById("explain9").style.display="block";
}

function Sub_Blind9(){
	document.getElementById("title9").style.display="none";
	document.getElementById("explain9").style.display="none";
}
// This function change sub_question6
function Sub_Show10(){
	document.getElementById("title10").style.display="block";
	document.getElementById("explain10").style.display="block";
}

function Sub_Blind10(){
	document.getElementById("title10").style.display="none";
	document.getElementById("explain10").style.display="none";
}
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});


function due(){
	var s_month = document.getElementById("s_month").value*1;
	var s_day = document.getElementById("s_day").value*1;
	var d_month = document.getElementById("month").value*1;
	var d_day = document.getElementById("day").value*1;

	
	
	if( s_month > d_month )
	{
	  alert('시작일이 제출일보다 느립니다');
	  return false;
	}

	else if( s_month == d_month )
	{

	  if( s_day > d_day){
	    alert('시작일이 제출일보다 느립니다');
	    return false;
	  }
	}

	else{
	  return true;
	}
}

function due_isset(){
    var s_month = document.getElementById("s_month").value*1;
	var s_day = document.getElementById("s_day").value*1;
	var d_month = document.getElementById("month").value*1;
	var d_day = document.getElementById("day").value*1;
	var p_s_month = document.getElementById("p_s_month").value*1;
	var p_s_day = document.getElementById("p_s_day").value*1;
	var p_month = document.getElementById("p_month").value*1;
	var p_day = document.getElementById("p_day").value*1;
    var now_month = document.getElementById("now_month").value*1; 
    var now_day = document.getElementById("now_day").value*1;
	
	
	if( s_month > d_month )
	{
	  alert('시작일이 제출일보다 느립니다');
	  return false;
	}

	else if( s_month == d_month )
	{

	  if( s_day > d_day){
	    alert('시작일이 제출일보다 느립니다');
	    return false;
	  }
	}

	else{
	  
	  if((now_month>=p_s_month)&&(now_month<=p_month)&&(now_day>=p_s_day)&&(now_day<=p_day)){
		 alert('지원기간 중에서 지원서를 수정하실 수 없습니다.');
		 return false;   
	    }
	 else{
	 var message = " 지원서를 새로 작성하시겠습니까? 확인을 누르실 경우, 이전 지원서에 지원한 지원자들의 정보 및 지원서들이 자동으로 삭제됩니다. 원치 않으시다면, 관리자페이지 -> 지원자 현황에 들어가셔서 지원 정보들을 파일로 받으신 후 다시 작성해주시기 바랍니다. ";
	 var r = confirm(message);	 
       if (r == true) {
		       return true;
		    } else {
		        alert('취소하셨습니다.');
			  return false;
		   }
	     }
      }
}