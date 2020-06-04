<?php

class Excel extends CI_Controller
{
	public function index()
	{
		$this->load->view('excel_upload');
    }
    
    public function excelRead()
    {
        require_once "./application/static/lib/PHPExcel-1.8/Classes/PHPExcel.php";
        require_once "./application/static/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
        
        $objPHPExcel = new PHPExcel();

        $filedir = "./application/file/"; //파일 위치할 디렉토리
        // 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
        $filename = iconv("UTF-8", "EUC-KR", $_FILES['excelFile']['name']);
        $filepath = $filedir . $filename;
        $filetype = pathinfo($filepath, PATHINFO_EXTENSION);

        if ($filetype != "xls" && $filetype != "xlsx")
        {
            print "<script language=javascript> alert('엑셀 파일만 업로드 해주세요'); location.replace('/excel/Excel'); </script>";
        }
        
        move_uploaded_file($_FILES["excelFile"]["tmp_name"], $filepath);

        // 엑셀 데이터를 담을 배열을 선언한다.
        $nameData = array();
        $phoneData = array();

        try
        {
            // 업로드한 PHP 파일을 읽어온다.
            $objReader = PHPExcel_IOFactory :: createReaderForFile($filepath);
            $objReader->setReadDataOnly(true); //일기전용
        	$objPHPExcel =  $objReader->load($filepath);
            $sheetsCount = $objPHPExcel -> getSheetCount();
            
        	// 시트Sheet별로 읽기
            for ($i = 0; $i < $sheetsCount; $i++)
            {
                $objPHPExcel -> setActiveSheetIndex($i);
                $sheet = $objPHPExcel -> getActiveSheet();
                $highestRow = $sheet -> getHighestRow();   		// 마지막 행
                $highestColumn = $sheet -> getHighestColumn();	// 마지막 컬럼
        
                // 한줄읽기
                for($row = 1; $row <= $highestRow; $row++)
                {
                  // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
                //   $rowData = $sheet -> rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
                    $name = $sheet->getCell('A'.$row)->getValue();
                    $phone = $sheet->getCell('B'.$row)->getValue();
            
                  // $rowData에 들어가는 값은 계속 초기화 되기때문에 값을 담을 새로운 배열을 선안하고 담는다.
                  $nameData[$row] = $name;
                  $phoneData[$row] = $phone;
                }
        	}
        
        } catch(exception $e) {
        	echo $e;
        }

        //array_unique(배열명) 배열 중복제거
        //array_filter(배열명) 배열 공백제거
        //array_values(배열명) 배열 정리
        $nameData = array_values(array_filter(array_unique($nameData)));
        $phoneData = array_values(array_filter(array_unique($phoneData)));
    }
}