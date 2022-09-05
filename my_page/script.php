<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 테스트 결제
// 전표 경로
if ($default['de_card_test']) { $wr20_url = "https://agenttest.payjoa.co.kr"; }
else{ $wr20_url = "https://agent.payjoa.co.kr"; }
?>

<script type="text/javascript">
$( document ).ready(function() {
	// 결제하기 버튼 눌렀을 경우(=각각 버튼)
	$( ".pay_a" ).on( "click", function() {
		// 모든 체크 리셋
		$("input[type='checkbox'][name^='chk_wr_id']").prop("checked", false);
		
		// 현재 선택한 신청만 체크 처리
		$( this ).closest("tr").find("input[type='checkbox'][name^='chk_wr_id']").prop("checked", true);
		
		// 결제하기
		open_payjoa();
		// console.log( test );
	});
});

// 전체 체크/해제
function all_checked(sw) {
	var f = document.fmylist;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]")
			f.elements[i].checked = sw;
	}
}

// 선택한 항목들 결제하기
function open_payjoa(){

	var f = document.fmylist;
	
	// 완료된 결제건 확인용 변수
	var wr_17_check = false;
	
	// 체크한 수 체크용
	var check_val = 0;
	
	// 체크박스 선택한 값들
	$('input:checkbox[name="chk_wr_id[]"]:checked').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			check_val++;
		}

		if($( this ).parent().find("input:hidden[name='chk_wr_17[]']").val() == '결제완료'){
			wr_17_check = true;
		}
	});

	// 완료된 결제건이 있을 경우
	if(wr_17_check){
		alert("이미 완료된 결제가 있습니다.");
		$("#chkall").prop("checked", false);
		all_checked(false);
		return false;
	}
	
	// 체크한 신청이 있을 경우
	if(check_val){
		if (!confirm("선택한 내용을 정말 결제하시겠습니까?")){ return false; }
		else{
			// f.removeAttribute("target");
			
			var newWin = window.open("about:blank", "payJoa", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=760,height=570");

			f.action = "<?php echo G5_SHOP_URL; ?>/payjoa/orderform1.php";

			f.target = "payJoa";
			f.submit();
		}
	}
	else{
		alert("결제할 내용을 하나 이상 선택하세요.");
		return false;
	}
}

// 액셀 다운로드
function print_excel(url){
	f = document.fmylist;
	f.action = url;
	f.submit();
}

// 접수취소
function cancel_state(wr_id){
	
	var url = "./ajax.php";
	var bo_table = "<?php echo $applicant_table; ?>";

	if (!confirm("접수 취소하시겠습니까?")){ return false; }
	else{

		$.ajax({
			type: "POST",
			url: url,
			data: { "mode": "cancel_state", "bo_table": bo_table, "wr_id": wr_id },
			dataType: "text",
			success: function(txt){
				alert(txt);
				location.reload();
			},
			error: function(xhr, status, error) {
				alert(error);
			}  
		});
	}
}

// 결제취소
function cancel_pay(wr_id){

	var url = "./ajax.php";
	var bo_table = "<?php echo $applicant_table; ?>";

	$.ajax({
		type: "POST",
		url: url,
		data: { "mode": "cancel_pay", "bo_table": bo_table, "wr_id": wr_id },
		dataType: "json",
		success: function(data){
			// 취소가 가능할 경우
			if( data.result ){
				// 확인 작업
				if (!confirm("선택한 내용을 정말 결제 취소하시겠습니까?")){ return false; }
				else{

					// 모든 체크 리셋
					$("input[type='checkbox'][name^='chk_wr_id']").prop("checked", false);
					
					// 현재 취소하려는 결제
					$("input[name='chk_wr_id[]'][value='" + wr_id + "']").parent().find("input[type='checkbox'][name^='chk_wr_id']").prop("checked", true);
					
					// 폼 정보
					var f = document.fmylist;
					
					var newWin = window.open("about:blank", "payJoa", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=760,height=570");

					f.action = "<?php echo G5_SHOP_URL; ?>/payjoa/orderCancel.php";

					f.target = "payJoa";
					f.submit();
				}
			}
			// 취소 불가인 경우 메시지 노출(=메시지는 이유)
			else{ alert(data.msg); }
		},
		error: function(xhr, status, error) {
			alert(error);
		}  
	});
}

// 수료 공문서 팝업 열기
function open_offi_doc(){
	
	// 수료여부 확인
	var offi_doc = $("#is_offi_doc").val();
	
	if(offi_doc){
		var newWin = window.open("my_pop_3.php", "offiWindow", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=760,height=1030");
		return false;
	}else{
		alert("수료하신 내역이 없습니다.");
		return false;
	}
}

$(function(){
	$('.pay_check_bt').click(function(){

		var url = "./ajax.php";
		var bo_table = "<?php echo $applicant_table; ?>";

		// 현재 선택한 신청자 정보
		var wr_id = $( this ).closest("tr").find("input[type='checkbox'][name^='chk_wr_id']").val();

		$.ajax({
			type: "POST",
			url: url,
			data: { "mode": "get_vAccount", "bo_table": bo_table, "wr_id": wr_id },
			dataType: "html",
			async: false,
			success: function(htm){
				// console.log( data )
				$('.pay_check_pop_wrap').find("div.cnt").html(htm);
			},
			error: function(xhr, status, error) {
				alert(error);
			}  
		});

		$('.pay_check_pop_wrap').stop().fadeIn();
	})
	$('.pay_close').click(function(){
		$('.pay_check_pop_wrap').stop().fadeOut();
	})
})

$(document).on('click','.pay_close',function(){
	$('.pay_check_pop_wrap').stop().fadeOut();
});

</script>


<!-- 추가된 결제정보 팝업 -->
<div class="pay_check_pop_wrap">
	<div class="pay_check_pop">
		<div class="poptop">
			<h3>결제정보</h3>
			<span class="pay_close"></span>
		</div>
		<div class="cnt">
			<table>
				<colgroup>
					<col width="100px">
					<col width="*">
				</colgroup>
				<tr>
					<th>주문일시</th>
					<td>2022-04-07 16:35:39</td>
				</tr>
				<tr>
					<th>결제방식</th>
					<td>가상계좌</td>
				</tr>
				<tr>
					<th>결제금액</th>
					<td><b>0원 / 1004원</b></td>
				</tr>
				<tr>
					<th>입금자명</th>
					<td>한국사이버결제</td>
				</tr>
				<tr>
					<th>입금계좌</th>
					<td>KB하나은행 T8109260001154</td>
				</tr>
			</table>
			<div class="btn_box">
				<a href="#n" class="pay_close">확인</a>
				<!-- <a href="">취소</a> -->
			</div>
		</div>
	</div>
</div>