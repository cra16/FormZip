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

//활동가능학기
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