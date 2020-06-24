<form enctype="multipart/form-data" action="/Excel/main/read" method="post" class="text__container" id="text__container">
	<div class="text__box form-group">
		<span>
			<label>문자보내기</label>
			<input class="form-control phone__input" type="text" name="phoneNum" id="phoneNum" placeholder="전화번호" value="">
			<input class="form-control phone__input" type="text" name="phoneCount" id="phoneCount" placeholder="" value="<?= !empty($PC) ? $PC : "" ?>" style="display:none">
			<textarea class="form-control text__input" name="msg" id="msg" placeholder="문자내용" value="" cols="30" rows="10"></textarea>
			<textarea class="form-control text__input" name="PhoneArray" id="PhoneArray" placeholder="" value="" style="display:none"><?= !empty($phone) ? json_encode($phone) : "" ?></textarea>
			<textarea class="form-control text__input" name="NameArray" id="NameArray" placeholder="" value="" style="display:none"><?= !empty($name) ? json_encode($name) : "" ?></textarea>
			<select id="phoneList" name="phoneList" class="custom-select phone__select" onchange="getPhone(<?= $PC ?>);">
				<option value="">발신번호</option>
				<?php
					if (!empty($PC) && $PC <= 50)
					{
				?>
				<option value="T"><?= "1번 ~ " . $PC . "번" ?></option>
				<?php
					}
					else if (!empty($PC) && $PC > 50)
					{
						for ($i=0; $i<$PC; $i+=49)
						{
							$i+=1;
							$j=$i+49;
				?>
				<option value="S<?= $i ?>"><?= $i . "번 ~ " . ($j>$PC ? $PC : $j) . "번" ?></option>
				<?php
						}
					}
				?>
            </select>
		</span>
	</div>
	<div class="submit__box form-group">
		<span>
			<input class="form-control-file" type="file" id="excelFile" name="excelFile" onChange="this.form.submit();"/>
		</span>
		<span>
			<input class="btn btn-outline-dark float-right w-auto" type="button" name="send" value="전송" onclick="sendText();"/>
		</span>
	</div>
</form>
