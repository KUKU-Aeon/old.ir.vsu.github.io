<?php
@session_start();

if(isset($_GET['get']))
{
	if(!function_exists('imagecreatetruecolor'))
	{
		$im=imagecreate(140,35) or exit();
		$tr=0;
	}
	else
	{
		$im=imagecreatetruecolor(140,35) or exit();
		$tr=1;
	}

	if(!$tr)
		$background_color=imagecolorallocate($im,0,0xff,0xff);
	else
		imagefill($im,0,0,0x00ffff);

	$text_color=imagecolorallocate($im,0,0x99,0);
	$line_color=imagecolorallocate($im,0,0,0xff);

	$smbs=strtoupper(md5(mt_rand()));
	$lettrs=array('1','2','3','4','5','6','7','8','9','0');
	$repl=array('G','M','K','L','S','Q','N','X','Z','R');

	$smbs=str_replace($lettrs,$repl,$smbs);

	$mr=substr(mt_rand(),0,1);

	if($mr<2)
	{
		$r=255;
		$g=255;
		$b=0;
	}
	else if($mr>=2 && $mr<6)
	{
		$r=0;
		$g=255;
		$b=255;
	}
	else
	{
		$r=255;
		$g=0;
		$b=255;
	}

	$rr=mt_rand(150,255);
	$rp=mt_rand(150,255);
	$rc=mt_rand(1,25);
	$rq=mt_rand(0,50);
	$rw=mt_rand(0,50);
	$rt=mt_rand(0,2);

	for($i=-$rq;$i<140+$rw;$i++)
	{
		$clr=get_clr($i,$rt);
		imageline($im,$i,1,$i+$rq-$rw,34,$clr);
	}

	$font = 'font.ttf';

	for($i=0;$i<5;$i++)
	{
		$text_color=imagecolorallocate($im,mt_rand()%155,mt_rand()%155,mt_rand()%155);
		$smb=substr($smbs,$i,1);

		$ang=mt_rand()%30-mt_rand()%30;

		@imagettftext($im, 14, $ang, $i*28, 25, $text_color, $font, $smb);
	}

	$_SESSION['inv_tempcode']=substr($smbs,0,5);

	imagefilter($im,IMG_FILTER_SMOOTH,3);

	imageline($im,0,0,140,0,$line_color);
	imageline($im,0,0,0,35,$line_color);
	imageline($im,139,0,139,35,$line_color);
	imageline($im,0,34,139,34,$line_color);
	

	$data = Array();
	for($j = 0; $j < 35; $j++)
	{
		for($i = 0; $i < 140; $i++)
		{
			list ($r, $g, $b) = rgb($im, $i, $j);
			$idx = ($i + $j * 140) * 4;
			$data[$idx + 0] = $r;
			$data[$idx + 1] = $g;
			$data[$idx + 2] = $b;
			$data[$idx + 3] = 255;
		}
	}
	
	imagedestroy($im);
	
	die('var colorArray = ['.implode($data, ',').'];');
}

$cap = isset($_POST['cap']) && !is_array($_POST['cap']) ? $_POST['cap'] : '';


if(!isset($_SESSION['inv_tempcode']) || !$_SESSION['inv_tempcode'] || strtolower($cap) != strtolower($_SESSION['inv_tempcode']))
{
	$_SESSION['inv_tempcode'] = '';
	die('error');
}
else
{
	$_SESSION['inv_tempcode'] = '';
	die('good');
}

function rgb($im, $x, $y)
{
	$rgb = imagecolorat($im, $x, $y);
	$r = ($rgb >> 16) & 0xFF;
	$g = ($rgb >> 8) & 0xFF;
	$b = $rgb & 0xFF;
	
	return Array($r, $g, $b);
}

function get_clr($i,$rt)
{
	global $rp;
	global $rc;
	global $rr;
	global $im;

	if($rt == 0)
		return imagecolorallocate($im,$rp,abs(round(255*sin($i/$rc))),$rr);
	else if($rt == 1)
		return imagecolorallocate($im,abs(round(255*sin($i/$rc))),$rp,$rr);
	else
		return imagecolorallocate($im,$rp,$rr,abs(round(255*sin($i/$rc))));
}

?>