<form enctype="multipart/form-data" action="/Excel/main/read" method="post" class="text__container">
	<div class="text__box form-group">
		<span>
			<label for="">문자보내기</label>
			<input class="form-control phone__input" type="text" name="phoneNum" id="phoneNum" placeholder="전화번호" value="">
			<textarea class="form-control text__input" name="text" id="text" placeholder="문자내용" value="" cols="30" rows="10"><?= json_encode($phone, JSON_FORCE_OBJECT) ?></textarea>
			<select id="phoneList" name="" class="custom-select phone__select" onchange="getPhone(<?=  $PC ?>);">
				<option value="">발신번호</option>
				<?php
					if (!empty($PC) && $PC <= 50)
					{
				?>
				<option value="T1"><?= "1번 ~ " . $PC . "번" ?></option>
				<?php
					}
					else if (!empty($PC) && $PC > 50)
					{
						for ($i=0; $i<$PC; $i+=49)
						{
							$i+=1;
							$j=$i+49;
				?>
				<option value="S<?= $i ?>"><?= $i . "번 ~ " . $j . "번" ?></option>
				<?php
						}
					}
				?>
            </select>
		</span>
	</div>
	<div class="upload__box form-group">
		<span>
			<input class="form-control-file" type="file" id="excelFile" name="excelFile"/>
		</span>
		<span>
			<input class="btn btn-outline-dark" type="submit" name="submit" value="업로드"/>
		</span>
	</div>
</form>