<?php

namespace SethaThay\NumberToKhmerWords;

class NumberToKhmerWords
{
    //Format (WORD / NUMBER)
    //Number will be in khmer number
    public function show(string $inputNumber, string $format = "WORD")
    {
        $inputNumber = trim($inputNumber);
        if($inputNumber == 0) {
            if($format == "WORD") return 'សូន្យ';
            if($format == "NUMBER") return 0;
        }
        if(strlen($inputNumber) > 39) {
            return 'លេខក្រៅជួរដែលបានកំណត់ទុក (ទទួលបានតែ ៣៩ ខ្ទង់ប៉ុណ្ណោះ)';
        }

        $digit = array(0=>"", 1=> "ដប់", 2 => "រយ", 3 => "ពាន់", 4 => "ម៉ឺន", 5 => "សែន", 
        6 => "លាន",7 => "លាន",8 => "លាន",
        9 => "ប៊ីលាន",10 => "ប៊ីលាន",11 => "ប៊ីលាន",
        12 => "ទ្រីលាន",13 => "ទ្រីលាន",14 => "ទ្រីលាន",
        15 => "ក្វាទ្រីលាន",16 => "ក្វាទ្រីលាន",17 => "ក្វាទ្រីលាន",
        18 => "គ្វីនទីលាន",19 => "គ្វីនទីលាន",20 => "គ្វីនទីលាន",
        21 => "សិចទីលាន",22 => "សិចទីលាន",23 => "សិចទីលាន",
        24 => "សិបទីលាន",25 => "សិបទីលាន",26 => "សិបទីលាន",
        27 => "អុកទីលាន",28 => "អុកទីលាន",29 => "អុកទីលាន",
        30 => "ណូនីលាន",31 => "ណូនីលាន",32 => "ណូនីលាន",
        33 => "ដេស៊ីលាន",34 => "ដេស៊ីលាន",35 => "ដេស៊ីលាន",
        36 => "អាន់ដេស៊ីលាន",37 => "អាន់ដេស៊ីលាន",38 => "អាន់ដេស៊ីលាន");

        $number = array(1 => "មួយ", 2 => "ពីរ", 3 => "បី", 4 => "បួន", 5 => "ប្រាំ", 6 => "ប្រាំមួយ", 7 => "ប្រាំពីរ", 8 => "ប្រាំបី", 9 => "ប្រាំបួន");
        $numberKH = array(0 => "០", 1 => "១", 2 => "២", 3 => "៣", 4 => "៤", 5 => "៥", 6 => "៦", 7 => "៧", 8 => "៨", 9 => "៩");
        $numberTEN = array(1 => "ដប់", 2 => "ម្ភៃ", 3 => "សាបសិប", 4 => "សែសិប", 5 => "ហាសិប", 6 => "ហុកសិប", 7 => "ចិតសិប", 8 => "ប៉ែតសិប", 9 => "កៅសិប");

        $strKH = "";
        $numKH = "";
        for($i = 0; $i<strlen($inputNumber); $i++){
            $numKH .= $numberKH[$inputNumber[$i]]; 
        }
        if(strlen($inputNumber) <= 39){
            $countDigit = strlen($inputNumber); 
            do{
                $superScript = $countDigit - 1;                            

                $divider = pow(10, (int)($superScript/3) * 3);

                $MOD = $superScript % 3;

                if($MOD == 0){
                    $RES = (int)($inputNumber / $divider);
                    if(floor($RES) > 0){
                        $strKH .= $number[$RES];
                        $strKH .= $digit[$superScript - $MOD];
                    }
                    $countDigit = $countDigit - 1;
                    $startPos = 1;
                }elseif($MOD == 1){
                    $RES = (int)($inputNumber / $divider);
                    $RES1 = (int) $RES / 10;
                    if(floor($RES1) > 0){
                        $strKH .= $numberTEN[$RES1];
                    }
                    $RES2 = $RES % 10;
                    if(floor($RES2) > 0){
                        $strKH .= $number[$RES2];
                    }
                    if(floor($RES1) > 0 || floor($RES2) > 0){
                        $strKH .= $digit[$superScript - $MOD];
                    }
                    $countDigit = $countDigit - 2;
                    $startPos = 2;
                }elseif($MOD == 2){
                    $RES = (int)($inputNumber / $divider);
                    $RES1 = (int) $RES / 100;
                    if(floor($RES1) > 0){
                        $strKH .= $number[$RES1] . $digit[$MOD];
                    }
                    $RES2 = (int)(($RES % 100) / 10);
                    if(floor($RES2) >0){
                        $strKH .= $numberTEN[$RES2];
                    }
                    $RES3 = (($RES % 100) % 10);
                    if(floor($RES3) > 0){
                        $strKH .= $number[$RES3];
                    }
                    if(floor($RES1) >0|| floor($RES2) >0 || floor($RES3) >0){
                        $strKH .= $digit[$superScript - $MOD];
                    }
                    $countDigit = $countDigit - 3;
                    $startPos = 3;
                }
                $inputNumber = substr($inputNumber, $startPos, $countDigit);
                if($countDigit == 1) $strKH .= $number[$inputNumber];
            }while($countDigit >= 2);
            
            if($format == "WORD") return $strKH;
            if($format == "NUMBER") return $numKH;
        }else{
            return 'លេខក្រៅជួរដែលបានកំណត់ទុក (ទទួលបានតែ ៣៩ ខ្ទង់ប៉ុណ្ណោះ)';
        }
    }
}
