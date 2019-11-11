$(function(){
	$("#btn_open").click(function(){ //레이어 팝업 열기 버튼 클릭 시
		$('#popup').bPopup(); //  
	});
	
	$("#btn_close").click(function(){ //닫기
		$('#popup').bPopup().close();  
	});			
});