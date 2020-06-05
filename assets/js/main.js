function getPhone(pc, phone) {
	//select 박스에서 받은 값에 해당하는 핸드폰 번호 나열
	var select = $("#phoneList option:selected").val();

	phone = json.decode(phone, true);

	alert(phone);
	// if (select == "T1") {
	// 	$("#phoneNum").val(phone);
	// }
}
