function getPhone() {
	var select = $("#phoneList option:selected").val();
	var arrPhone = JSON.parse($("#PhoneArray").val());
	var arrName = JSON.parse($("#NameArray").val());

	if (select == "T1") {
		$("#phoneNum").val(arrPhone);
	} else if (select.substring(0, 1) == "S") {
		var count = Number(select.substring(1));
		$("#phoneNum").val(null);

		$("#phoneNum").val(arrPhone[count - 1]);

		for (i = count; i <= count + 48; i++) {
			$("#phoneNum").val($("#phoneNum").val() + "," + arrPhone[i]);
		}
	}
}

function sendText() {
	//핸드폰번호, 문자내용 받아서 파라미터로 넘기기
	$("#text__container").attr("action", "/Excel/main/send");
	$("#PhoneArray").attr("disabled", true);
	// $("#NameArray").attr("disabled", true);
	$("#phoneList").attr("disabled", true);
	$("#text__container").submit();
}
