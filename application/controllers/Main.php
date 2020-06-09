<?php

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct(); //초기화
    }

    public function _remap($method) //헤더 푸터 로드
    {
        $this->load->view('head');
 
        if (method_exists($this, $method)) {
            $this -> {"{$method}"}();
        }
 
        $this->load->view('footer');
    }

	public function index()
	{
		$this->load->view('main');
    }
    
    public function read()
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
            print "<script language=javascript> alert('엑셀 파일만 업로드 해주세요'); location.replace('/Excel/main'); </script>";
        }
        
        move_uploaded_file($_FILES["excelFile"]["tmp_name"], $filepath);

        // 엑셀 데이터를 담을 배열을 선언한다.
        $nameData = array();
        $phoneData = array();

        try
        {
            // 업로드한 PHP 파일을 읽어온다.
            $objReader = PHPExcel_IOFactory :: createReaderForFile($filepath);
            $objReader->setReadDataOnly(true); //읽기전용
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
                for($row = 2; $row <= $highestRow; $row++)
                {
                    $name = $sheet->getCell('A'.$row)->getValue();
                    $phone = $sheet->getCell('B'.$row)->getValue();
                    $nameData[$row] = $name;
                    $phoneData[$row] = "0" .  $phone;
                }
        	}
        
        } catch(exception $e) {
        	echo $e;
        }

        //array_unique(배열명) 배열 중복제거
        //array_filter(배열명) 배열 공백제거
        //array_values(배열명) 배열 정리0
        $nameData = array_values(array_filter(array_unique($nameData)));
        $phoneData = array_values(array_filter(array_unique($phoneData)));
        $phoneCount = count($phoneData);

        // var_dump($phoneData);
        //implode(",", $phoneData)
        $this->load->view('main', array('name' => $nameData, 'phone' => $phoneData, 'PC' => $phoneCount));
    }

    public function send()
    {
        echo $_POST['phoneNum']. "<br />";
        echo $_POST['text']. "<br />";
        echo $_POST['NameArray']. "<br />";
    }
}