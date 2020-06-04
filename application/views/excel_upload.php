<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>:: PHPExcel 파일읽기 ::</title>
</head>
<body>
	<div class="text__container">
		<span>
			<label for="">문자보내기</label>
			<input type="text" name="phonenum" id="phonenum">
			<textarea name="text" id="text" cols="30" rows="10"></textarea>
		</span>
	</div>
	<form enctype="multipart/form-data" action="./Excel/excelRead" method="post">
		<table border="1">
			<tr>
				<th style="background-color:#DCDCDC">파일</th>
				<td><input type="file" id="excelFile" name="excelFile"/></td>
			</tr>
			<tr>
				<th style="background-color:#DCDCDC">등록</th>
				<td style="text-align:center;"><input type="submit" name="submit" value="업로드"/></td>
			</tr>
	</form>
</body>
</html>