<?php
// if (!defined($config['id'])) exit;

//================================================//
// 머리부 및 꼬리부
//================================================//
// function head($title = "", $etc = "", $bmenu='false')
// {
    // global $config;
    // if (empty($title))	$title = $config['title'];
	// if (date('Ynj') == $config['reserve_time'])	clean_all();
    // echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
    // echo "<head>\n";
    // echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$config['charset']}\" />\n";
    // //	echo "<meta http-equiv=\"Page-Enter\" content=\"revealTrans(Duration=2.0,Transition=6)\">\n";
    // //	echo "<meta http-equiv=\"Page-Exit\" content=\"revealTrans(Duration=2.0,Transition=6)\">\n";
    // echo "<meta http-equiv=Pragma content=no-cache>";
    // echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache\">";
    // echo "<title>$title</title>\n";
    // echo "<link rel=\"icon\" href=\"{$config['image_path']}/spo.ico\" type=\"image/x-icon\" />";
    // echo "<link rel=\"stylesheet\" href=\"{$config['path']}/css/common.css\" type=\"text/css\" />\n";
    // echo "<script language=\"javascript\" type=\"text/javascript\" src=\"{$config['path']}/jscript/common.js\"></script>\n";	
    // echo "<script language=\"javascript\">var currpath='{$config['path']}'</script>\n";
    // echo "</head>\n";
    // echo "<body $etc oncontextmenu=\"return $bmenu\" ondragstart =\"return $bmenu\" onselectstart=\"return $bmenu\" onunload= \"if(view.winh != null) view.closechild();\">\n";
// }

function tail()
{
    echo "</body></html>";
}

//================================================//
// SESSION 변수를 관리하는 함수
//================================================//
// session변수 생성
function set_session($session_name, $value)
{
    session_register($session_name);
    $$session_name = $_SESSION[$session_name] = $value;
}

// session변수값 얻기
function get_session($session_name)
{
    return $_SESSION[$session_name];
}

//===============================//
// javascript를 리용한 함수
//===============================//
// 통보창
function alert($msg = "")
{
	global $config;
    if (!$msg) {
        $msg = '오유가 발견되였습니다.';
    }
    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset={$config['charset']}\">\n";
    echo "<script language='javascript'>alert(\"$msg\");</script>";
}
// 페지를 이동
function goto_url($url, $msg = "", $target='')
{
    global $config;
    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset={$config['charset']}\">\n";
    echo "<script language='javascript'>\n";
    if ($msg) {
	echo "alert('$msg');\n";
    }
    if ($url) {
    	if (empty($target) == false)	echo "$target.";
	echo "location.replace('$url');\n";
    }
    echo "</script>";
    exit;
}

// 이전페지로 이동
function goback($msg = "")
{
    global $config;
    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset={$config['charset']}\">";
    echo "<script language='javascript'>\n";
    if ($msg) {
        echo "alert(\"$msg\");\n";
    }
    echo "history.go(-1);\n";
    echo "</script>";
    exit;
}
// 현재창을 닫음
function close_win($msg = "")
{
    global $config;
    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset={$config['charset']}\">";
    echo "<script language='javascript'>\n";
    if ($msg) {
        echo "alert('$msg');\n";
    }
    echo "window.close();\n";
    echo "</script>";
    exit;
}

//================================================//
// 기타
//================================================//
// 파일의 용량을 현시하기 위한 함수 .
function get_filesize($size)
{
    if ($size < 1024) {
        $str_size = $size." byte";
    } else if ($size < (1024 * 1024)) {
        $str_size = round(($size / 1024), 2)." KB";
    } else if ($size < (1024 * 1024 * 1024)) {
        $str_size = round(($size / (1024 * 1024)), 2)." MB";
    } else {
        $str_size = round(($size / (1024 * 1024 * 1024)), 2)." GB";
    }

    return $str_size;
}
// 우리글 요일
function get_textweek($date, $full = false)
{
    if (!$date) $date = time();
    $arr_week = array ("일", "월", "화", "수", "목", "금", "토");
    $wk = date("w", $date);
    $str = $arr_week[$wk];
    if ($full) {
        $str .= "요일";
    }
    return $str;
}
// TEXT 형식으로 변환
function get_text($str, $html=0)
{
    if ($html == 0) {
        $str = html_symbol($str);
    }
    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    $source[] = "/\"/";
    $target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }
    return preg_replace($source, $target, $str);
}
// &nbsp; &amp; &middot; 등을 정상으로 출력
function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}

/**
* 이 함수는 ToolTip 을 그려주는 함수로써 정확히 동작하게 하려면
* <link rel="stylesheet" href="<?php echo $config['path']?>/css/bubble_css.php" type="text/css" /> 를 코드웃부분에 추가해주어야 합니다.
*
* @param string $str
*/
function drawToolTip($str) {
    global $config;
    echo <<<HEREDOC
<a href="#" class="tt"><img src="{$config['path']}/images/icon_help.gif" align='absmiddle' border='0'/><span class="tooltip"><span class="top"></span><span class="middle">$str</span><span class="bottom"></span></span></a>
HEREDOC;
}

//================================================//
// Combobox를 만드는 함수
//================================================//
function drawCombobox($comboname, $tblres, $id, $fullname, $selected, $etc="", $firststr="")
{
//	$bReturn = false;
	echo "<SELECT id=\"$comboname\" name=\"$comboname\" $etc>";
	if ($firststr)	echo "<option value=-1 selected='selected'>$firststr</option>";
	while ($row = @mysql_fetch_assoc($tblres))
	{
		if (is_numeric($selected) == false&&is_numeric($row[$id]))	$selected = $row[$id];
		if ($selected == $row[$id])
		{
//			$bReturn = true;
			echo "<option value='{$row[$id]}' selected='selected'>{$row[$fullname]}</option>";
		}
		else
			echo "<option value='{$row[$id]}'>{$row[$fullname]}</option>";
	}
	@mysql_data_seek($tblres, 0);
	echo "</SELECT>";
//	return $bReturn ? $selected : $firstval;
	return $selected;
}

function drawComboboxFromArray($comboname, $arr_val, $selected, $etc = "", $show_default = false, $default_text = "--선택--")
{
	$bReturn = false;
	echo "<SELECT id=\"$comboname\" name=\"$comboname\" $etc>";
	if ($show_default) echo "<option value=-1 selected='selected'>$default_text</option>";
	foreach ($arr_val as $key => $val)
	{
		if (is_numeric($selected) == false&&empty($selected))	$selected = $key;
		if ($selected == $key)
		{
//			$bReturn = true;
			echo "<option value='$key' selected='selected'>$val</option>";
		}
		else
			echo "<option value='$key'>$val</option>";
	}
	echo "</SELECT>";
//	return $bReturn ? $selected : $firstval;
	return $selected;
}

/**
* 이 함수는 표그리기에서 값이 없어도 cell이 그대로 나타나도록 하기위한 함수로써
* 입력값을 확인하여 값이 없다면 빈공백을 채워준다
*
* @param string $str
*/
function p_check($str, $flag = true, $alternative = null)
{
    if ($str == null || empty($str)) {
        if ($flag) $str = "&nbsp;";
        else $str = "";
        if($alternative != null) {
        		$str = "<span id='nodata'>{$alternative}</span>";
        }
    }
    return $str;
}
/**
* 이 함수는 \n을 <br>로 교체해주는 함수이다
*
* @param string $str
*/
function replice2br($str)
{
    $order = array("\r\n", "\n", "\r");
    $replace = '<br/>';
    $newstr = str_replace($order, $replace, $str);
    return $newstr;
}

/**
* 이 함수는 유니코드용 문자렬을 글자가 깨지지 않도록 자르는 함수로써
* 입력된 문자렬에서 지정한 수만큼 자른다음 뒤붙이를 붙여준다
*
* @param string $str
* @param int $max_len
* @param string $suffix
*/
function cut_string_utf8($str, $max_len, $suffix)
{
    $n = 0;
    $noc = 0;
    $len = strlen($str);
    while ($n < $len)
    {
        $t = ord($str[$n]);

        if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1;
            $n++;
            $noc++;
        } else if ( 194 <= $t && $t <= 223 ) {
            $tn = 2;
            $n += 2;
            $noc += 2;
        } else if ( 224 <= $t && $t < 239 ) {
            $tn = 3;
            $n += 3;
            $noc += 2;
        } else if ( 240 <= $t && $t <= 247 ) {
            $tn = 4;
            $n += 4;
            $noc += 2;
        } else if ( 248 <= $t && $t <= 251 ) {
            $tn = 5;
            $n += 5;
            $noc += 2;
        } else if ( $t == 252 || $t == 253 ) {
            $tn = 6;
            $n += 6;
            $noc += 2;
        } else {
            $n++;
        }

        if ( $noc > $max_len ) break;
    }

    if ( $noc <= $max_len ) return $str;

    if ( $noc > $max_len ) $n -= $tn;

    return substr($str, 0, $n).$suffix;
}

/**
* 페지화함수
*
* @param int $curPage: 현재페지
* @param int $totalPages: 전체페지수
* @param int $formname: Form이름
* @return 페지목록 현시
*
*/
function page_navigate ( $curPage, $totalPages, $formname, $kind = '')
{
    $para_name = "pageno";
    $max_numList = 10;
    $bt_first = "처음";
    $bt_last = "마지막";
    $bt_prev = "이전";
    $bt_next = "다음";
    if ($curPage <= 1) {
        $first = "<span class='nav_desable'>$bt_first</span>";
        $prev = "<span class='nav_desable'>$bt_prev</span>";
    } else {
        $first = "<a href='#' onclick=\"javascript:go_page('1','".$formname."', "."'".$kind."');\" class='nav'><span class='nav'>".$bt_first."</span></a>";
        $prev = "<a href='#' onclick=\"javascript:go_page('".($curPage - 1)."','".$formname."', "."'".$kind."');\" class='nav'><span class='nav'>".$bt_prev."</span></a>";
    }
    if ( $curPage >= $totalPages) {
        $last = "<span class='nav_desable'>$bt_last</span>";
        $next = "<span class='nav_desable'>$bt_next</span>";
    } else {
        $last = "<a href='#' onclick=\"javascript:go_page('".$totalPages."','".$formname."', "."'".$kind."');\" class='nav'><span class='nav'>".$bt_last."</span></a>";
        $next = "<a href='#' onclick=\"javascript:go_page('".($curPage + 1)."','".$formname."', "."'".$kind."');\" class='nav'><span class='nav'>".$bt_next."</span></a>";
    }
    $begin_page = 0;
    $end_page = $max_numList;
    if ($curPage - floor($max_numList / 2) <= 1) {
        $begin_page = 1;
    } else {
        $begin_page = $curPage - floor($max_numList / 2);
    }
    if (($begin_page + $max_numList - 1) >= $totalPages) {
        $end_page = $totalPages;
        if (($totalPages - $max_numList + 1) <= 1)  {
            $begin_page = 1;
        } else {
            $begin_page = $totalPages - $max_numList + 1;
        }
    } else {
        $end_page = $begin_page + $max_numList - 1;
    }
    $numberLink = '';
    $tmp_start = ((ceil($curPage / $max_numList) * $max_numList) - ($max_numList));
    $i = 0;
    for ($i = $begin_page; $i <= $end_page; $i++) {
        if ($curPage == $i) {
            $numberLink .= "<span class='nav_selected'>".$i."</span>";
        } else {
            $numberLink .= "<a href='#' onclick=\"javascript:go_page('".$i."','".$formname."', "."'".$kind."');\" class='nav'><span class='nav_page'>".$i."</span></a>";
        }
    }

    if ($totalPages > 1)
    {
        echo "<table cellpadding='0' cellspacing='5' border='0'><tr>";
        echo "<td align='right'>".$first."</td>";
        echo "<td align='right'>".$prev."</td>";
        echo "<td height='25' align='center'>".$numberLink."</td>";
        echo "<td align='left'>".$next."</td>";
        echo "<td align='left'>".$last."</td>";
        echo "</tr></table>";
    }
}

/**
* var_dump와 같은 함수로써 변수의 내용을 모두 출구하는 함수이다.
*
* @param mixed $data
*/
function print_r2($data)
{
    ob_start();
    var_dump($data);
    $c = ob_get_contents();
    ob_end_clean();
    $c = preg_replace("/\r\n|\r/", "\n", $c);
    // Insert linebreak after the first '{' character
    if (strpos($c, '{') !== false) {
        $c = substr_replace($c, "{\n", strpos($c, '{'), 1);
    }
    $c = str_replace("]=>\n", '] = ', $c);
    $c = preg_replace('/= {2,}/', '= ', $c);
    $c = preg_replace("/\[\"(.*?)\"\] = /i", "[$1] = ", $c);
    $c = preg_replace('/  /', "    ", $c);
    $c = preg_replace("/}\n( {0,})\[/i", "}\n\n$1[", $c);
    $c = preg_replace("/\"\"(.*?)\"/i", "\"$1\"", $c);
    $c = htmlspecialchars($c, ENT_NOQUOTES);
    // Syntax Highlighting of Strings. This seems cryptic, but it will also allow non-terminated strings to get parsed.
    $c = preg_replace("/(\[[\w ]+\] = string\([0-9]+\) )\"(.*?)/sim", "$1<span class=\"string\">\"", $c);
    $c = preg_replace("/(\"\n{1,})( {0,}\})/sim", "$1</span>$2", $c);
    $c = preg_replace("/(\"\n{1,})( {0,}\[)/sim", "$1</span>$2", $c);
    $c = preg_replace("/(string\([0-9]+\) )\"(.*?)\"\n/sim", "$1<span class=\"string\">\"$2\"</span>\n", $c);
    $regex = array(
    // Numberrs
    'numbers' => array('/(^|] = )(array|float|int|string|object\(.*\))\(([0-9\.]+)\)/i', '$1$2(<span class="number">$3</span>)'),
    // Keywords
    'null' => array('/(^|] = )(null)/i', '$1<span class="keyword">$2</span>'),
    'bool' => array('/(bool)\((true|false)\)/i', '$1(<span class="keyword">$2</span>)'),
    // Objects
    'object' => array('/(object|\&amp;object)\(([\w]+)\)/i', '$1(<span class="object">$2</span>)'),
    // Function
    'function' => array('/(^|] = )(array|string|int|float|bool|object)\(/i', '$1<span class="function">$2</span>('),
    );
    foreach ($regex as $x) {
        $c = preg_replace($x[0], $x[1], $c);
    }
    $style = '
/* outside div - it will float and match the screen */
.dumpr {
margin: 2px;
padding: 2px;
background-color: #fbfbfb;
float: left;
clear: both;
}
/* font size and family */
.dumpr pre {
color: #000000;
font-size: 9pt;
font-family: "Courier New",Courier,Monaco,monospace;
margin: 0px;
padding-top: 5px;
padding-bottom: 7px;
padding-left: 9px;
padding-right: 9px;
}
/* inside div */
.dumpr div {
background-color: #fcfcfc;
border: 1px solid #d9d9d9;
float: left;
clear: both;
}
/* syntax highlighting */
.dumpr span.string {color: #c40000;}
.dumpr span.number {color: #ff0000;}
.dumpr span.keyword {color: #007200;}
.dumpr span.function {color: #0000c4;}
.dumpr span.object {color: #ac00ac;}
';
    $style = preg_replace("/ {2,}/", "", $style);
    $style = preg_replace("/\t|\r\n|\r|\n/", "", $style);
    $style = preg_replace("/\/\*.*?\*\//i", '', $style);
    $style = str_replace('}', '} ', $style);
    $style = str_replace(' {', '{', $style);
    $style = trim($style);
    $c = trim($c);
    echo "\n<!-- dumpr -->\n";
    echo "<style type=\"text/css\">".$style."</style>\n";
    echo "<div class=\"dumpr\"><div><pre>\n$c\n</pre></div></div><div style=\"clear:both;\">&nbsp;</div>";
    echo "\n<!-- dumpr -->\n";
}
/**
* 이 함수는 접근권한배렬을 얻어서 한개우 수값을 발생하는 함수이다. 실례로 0, 1, 3 이다 하면 11를 돌려준다 공식: sum( 2^입구값 )
*
* @param Integer Array $arr
*/
function level2int($arr)
{
    $sigma = 0;
    foreach($arr as $value)
    {
        $sigma += pow( 2, intval($value));
    }
    return $sigma;
}
//수자 ComboBox만들기
function drawNumber($comboname,$start,$end,$selected,$firststr, $etc="")
{
    echo "<SELECT id=\"$comboname\" name=\"$comboname\" $etc>
	<option value=-1 selected='selected'>$firststr</option>";
    for( $i = $start; $i <= $end; $i++ )
    {
        if($i==$selected)
        echo "<option value=$i selected='selected'>$i</option>";
        else
        echo "<option value=$i>$i</option>";
    }
    echo "</SELECT>";
}

$attend_kind = array('attend', 'tour', 'att_school', 'short_course', 'mobilize', 'vocation', 'train', 'lateness');
$work_kind = array('attend', 'lateness');

/*
*	명절, 일요일, 법적가동일수, 달의 날자수를 얻는다
*/
function getWorkDays(&$hol_day, &$Sday, &$work_days, &$daysofmonth, $curYear='', $curMonth='')
{
    if (empty($curYear) || !is_numeric($curYear)) $curYear = date('Y');
    if (empty($curMonth) || !is_numeric($curMonth)) $curMonth = date('n');

    $daysofmonth = date('t', mktime(0,0,0, $curMonth, 1, $curYear));

    $CTempDBCon = new CMySQL();
    if(!$CTempDBCon->Open()) {
        $CTempDBCon->Kill();
        return false;
    }
    $CTempDBCon->Query("SELECT * FROM cb_labor.holiday WHERE DATE_FORMAT(ho_date, '%Y-%c')='$curYear-$curMonth'");
    $hol_day = array();
    while ($row = $CTempDBCon->RowA())
    {
        array_push($hol_day, date('d', strtotime($row['ho_date'])));
    }

    // 일요일계산
    $Sday = array();
    $firstday = date('N', mktime(0,0,0, $curMonth, 1, $curYear));
    for ($index = 7 - $firstday + 1; $index <= $daysofmonth; $index += 7)
    {
        $temp = date('d', mktime(0,0,0, $curMonth, $index, $curYear));
        $key = array_search($temp, $hol_day);
        if ($key === false) array_push($Sday, $temp);
    }

    $work_days = $daysofmonth - count($hol_day) - count($Sday); //법적가동일수
//    $CTempDBCon->Close();
}

$seasons = array(1=>14, 4=>24, 7=>34,10=>44);

/**
 * 분기의 법적가동일수, 분기날자수를 얻는 함수
 *
 * @param array $work_days
 * @param array $daysofseason
 * @param int $curYear
 * @param int $curSeason
 */
function getSeasonWorkDays(&$work_days, &$daysofseason, $curYear='', $curSeason='')
{
	if (!is_numeric($curYear))	$curYear = date('Y');
	if (!is_numeric($curSeason))	$curSeason = $seasons[floor((date('n') - 1)/3) * 3 + 1];
	switch ($curSeason)
	{
		case '14':
			$months = array(1, 2, 3);
			break;
		case '24':
			$months = array(4, 5, 6);
			break;
		case '34':
			$months = array(7, 8, 9);
			break;
		case '44':
			$months = array(10, 11, 12);
			break;
		default:
			$months = array($curSeason);
	}
	foreach ($months as $value)
	{
		$hol_day = array();
		$sday = array();
		getWorkDays($hol_day, $sday, $workday, $daysofmonth, $curYear, $value);
		$work_days += $workday;
		$daysofseason += $daysofmonth;
	}
	return true;
}

/*****************draw Combo*****************/
# @package : 년도 콤보현시
# @param : 콤보이름, 선택년, 추가속성
# @author :Ryom JINHYOK
function drawYearList($name, $selectedYear, $extras = "")
{
    global $config;
    echo "<select name='$name' id='$name' $extras>";

    $curYear = date("Y");
    for($i=$config['start_year']; $i<=$curYear; $i++)
    {
        if ($i == $selectedYear)
        echo "<option id='$i' selected='selected' value='$i'>{$i}년</option>\n";
        else
        echo "<option value='$i'>{$i}년</option>\n";
    }
    echo "</select>";
}
# @package : 월 콤보현시
# @param : 콤보이름, 선택월, 추가속성
# @author :Ryom JINHYOK
function drawMonthList($name, $selectedMonth, $extras = "")
{
    echo "<select name='$name' id='$name' $extras>";

    for($i=1; $i<=12; $i++)
    {
        if ($i == $selectedMonth)
        echo "<option id='$i' selected='selected' value='$i'>{$i}월</option>\n";
        else
        echo "<option value='$i'>{$i}월</option>\n";
    }
    echo "</select>";
}

#################################
# 계획테이블 생성			        #
# @para: 생성하려는 계획의 년도    #
# @ret: 성공 ? true : false		#
#################################
/**
 * 자료기지 Table생성
 *
 * @param string $schema_name
 * @param string $db_name
 * @param string $table_name
 * @return bool
 */
function makeTable($schema_name, $db_name, $table_name, $comment = "")
{
	if (empty($db_name) || empty($table_name))	return false;
	
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	
	if (!$CTempDBCon->exist_table("$db_name.$table_name"))
	{
		eval("\$sql=\"$schema_name\";");
		if (!$CTempDBCon->Query($sql)) return false;
	}
//	$CTempDBCon->Close();
	return true;
}

function getFileName($filepath)
{
    if (empty($filepath))	return;
    $path_parts = pathinfo($filepath);
    return substr($path_parts[basename], 0, strpos($path_parts[basename], $path_parts[extension]) - 1);
}

function getAutoInc($schema, $table)
{
    $CTempDBCon = new CMySQL();
    if(!$CTempDBCon->Open())
    {
        $CTempDBCon->Kill();
        return false;
    }
    $CTempDBCon->Query("SELECT auto_increment FROM information_schema.TABLES WHERE table_schema='$schema' AND table_name='$table'");
    if (!$CTempDBCon->Rows())	return false;
    $temp = $CTempDBCon->RowA();
//    $CTempDBCon->Close();
    return $temp['auto_increment'];
}

/**
 * 파일이름을 리용하여 파일을 내리적재하는 함수
 *
 * @param string $file_path
 * @param string $savedname
 */
function direct_filedown($file_path, $savedname = NULL)
{
	if (is_file($file_path))
	{
		$filesize = filesize($file_path);
		$file_info = pathinfo($file_path);
		$destname = empty($savedname) ? substr($file_path, strrpos($file_path, '/') + 1) : $savedname;
		if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
		{
			header("Pragma: public");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			$destname = urlencode($destname);
			$destname = str_replace("+", "%20", $destname);
		}
		header("Content-Type: {$file_info['extension']}");
		header("Content-Length: $filesize");
		header("Content-Disposition: attachment; filename=\"$destname\"");
		readfile("$file_path");
		return true;
	}
	else
	{
		echo "<script>alert('파일이 존재하지 않습니다')</script>";
		return false;
	}
}

/**
 * 자료기지로부터 파일이름을 얻어 파일을 내리적재하는 함수
 *
 * @param string $tablename
 * @param string $record
 * @param string $field
 * @param string $dir_path
 */
function indirect_filedown($tablename, $record, $field, $dir_path)
{
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	is_numeric($record) ? $CTempDBCon->Query("SELECT $field FROM $tablename WHERE id=$record") : exit;
	$rowinfo = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	direct_filedown("$dir_path/{$rowinfo[$field]}");
}

function check_login($bManage =false)
{
	global $db_table, $_SESSION, $config;
	if (empty($_SESSION['spo_id']))	goto_url($config['path'], "리용자가입을 하여야 합니다", 'top');
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT id FROM {$db_table['user_info']} WHERE id={$_SESSION['spo_id']} AND deltime IS NULL");
	if ($CTempDBCon->Rows() == 0)
	{
//		$CTempDBCon->Close();
		goto_url($config['path'], "리용자가입을 하여야 합니다", 'top');
	}
	if ($bManage)
	{
		$CTempDBCon->Query("SELECT advuser FROM {$db_table['user_info']} WHERE id={$_SESSION['spo_id']}");
		$rowinfo = $CTempDBCon->RowA();
		if ($rowinfo['advuser'] != 1)	goto_url($config['path'], "관리자권한이 없습니다", 'top');
	}
//	$CTempDBCon->Close();
}

function getUserPerm($uid, $menu_id, $allow = false)
{
	if (is_numeric($uid) == false||is_numeric($menu_id) == false)	return $allow == 0 ? true : false;
	global $db_table, $db_set;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	if ($CTempDBCon->exist_table($db_table['user_perm']) == false)
	{
		eval($db_set['user_perm']);
		$CTempDBCon->Query($sql);
	}
	$CTempDBCon->Query("SELECT access_set FROM {$db_table['user_perm']} WHERE user_id=$uid AND menu_id=$menu_id");
	if ($CTempDBCon->Rows() == 0)	return empty($allow) ? true : false;
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return ($temp['access_set'] == 0 ? ($allow == 0 ? true : false) : ($allow === false ? $temp['access_set'] : $temp['access_set']&$allow));
}

function getUserLog($uid)
{
	if (is_numeric($uid) == false)	exit;
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT visitlog FROM {$db_table['user_info']} WHERE id=$uid");
	if (!$CTempDBCon->Rows())	exit;
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $temp['visitlog'] == 'Y' ? true : false;
}

function getUserSign($uid, $width=75, $height=45)
{
	global $db_table, $config;
	if (empty($uid) == false)
	{
		$CTempDBCon = new CMySQL();
		if(!$CTempDBCon->Open())
		{
			$CTempDBCon->Kill();
			return false;
		}
		$CTempDBCon->Query("SELECT sign FROM {$db_table['user_info']} WHERE id=$uid");
		if (!$CTempDBCon->Rows())	return false;
		$temp = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		$image_name = $temp['sign'];
	}
	else
		$image_name = "sign0000.jpg";
	return "<img src=\"{$config['image_path']}/sign/$image_name\" width=$width height=$height>";
}

function getUserName($uid)
{
	global $db_table;
	if (is_numeric($uid) == false)	exit;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT name FROM {$db_table['user_info']} WHERE id=$uid");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $temp['name'];
}

function getUserOfficialName($uid)
{
	global $db_table;
	if (is_numeric($uid) == false)	exit;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT officialname FROM {$db_table['user_info']} WHERE id=$uid");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $temp['officialname'];
}

function getUserDepart($uid, $bName = false)
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT depart.id, depart.name FROM {$db_table['user_depart']} AS depart JOIN {$db_table['user_info']} AS usr ON usr.depart=depart.id WHERE usr.id=$uid");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $bName ? $temp['name'] : $temp['id'];
}

function getUserLevel($uid, $field = 'id')
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$temp = explode('.', $db_table['user_level']);
	if ($CTempDBCon->exist_field($temp[0], $temp[1], $field))
	{
		$CTempDBCon->Query("SELECT level.$field FROM {$db_table['user_level']} AS level JOIN {$db_table['user_info']} AS usr ON usr.level=level.id WHERE usr.id=$uid");
		if (!$CTempDBCon->Rows())
		{
//			$CTempDBCon->Close();
			return false;
		}
		$temp = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		return $temp[$field];
	}
	else
		return false;
}

function getUserPost($uid, $field = 'id')
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$temp = explode('.', $db_table['user_post']);
	if ($CTempDBCon->exist_field($temp[0], $temp[1], $field))
	{
		$CTempDBCon->Query("SELECT post.$field FROM {$db_table['user_post']} AS post JOIN {$db_table['user_info']} AS usr ON usr.post=post.id WHERE usr.id=$uid");
		if (!$CTempDBCon->Rows())
		{
//			$CTempDBCon->Close();
			return false;
		}
		$temp = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		return $temp[$field];
	}
	else
		return false;
}

function getUserReportTo($uid)
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$temp = explode('.', $db_table['user_info']);
	if ($CTempDBCon->exist_field($temp[0], $temp[1], 'reportto'))
	{
		$CTempDBCon->Query("SELECT reportto, reportid, reportway FROM {$db_table['user_info']} WHERE id=$uid AND reportway IS NOT NULL");
		if (!$CTempDBCon->Rows())
		{
//			$CTempDBCon->Close();
			return false;
		}
		$temp = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		if ($temp['reportway'] == 'S')
			return $temp['reportto'];
		elseif ($temp['reportway'] == 'C'&&is_null($temp['reportid']) == false)
			return getUserReportTo($temp['reportid']);
		else
			return false;
	}
	else
		return false;
}

function getUserReportBy($uid)
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$temp = explode('.', $db_table['user_info']);
	if ($CTempDBCon->exist_field($temp[0], $temp[1], 'reportby'))
	{
		$CTempDBCon->Query("SELECT reportby, reportid, reportway FROM {$db_table['user_info']} WHERE id=$uid AND reportway IS NOT NULL");
		if (!$CTempDBCon->Rows())
		{
//			$CTempDBCon->Close();
			return false;
		}
		$temp = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		if ($temp['reportway'] == 'S')
			return $temp['reportby'];
		elseif ($temp['reportway'] == 'C'&&is_null($temp['reportid']) == false)
			return getUserReportBy($temp['reportid']);
		elseif ($temp['reportway'] == 'V')
			return $temp['reportby'];
		else
			return false;
	}
	else
		return false;
}

function getIndirectEconoTo($uid, $bName = false)
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	if (getUserLevel($uid) == false)
	{
//		$CTempDBCon->Close();
		return false;
	}
//	$CTempDBCon->Query("SELECT usr.id, name FROM {$db_table['user_info']} AS usr JOIN {$db_table['user_perm']} AS perm ON usr.id=perm.user_id AND perm.menu_id=24 AND access_set&2 WHERE level=".getUserLevel($uid)." AND depart=".getUserDepart($uid));
	$CTempDBCon->Query("SELECT usr.id, name FROM {$db_table['user_info']} AS usr JOIN {$db_table['user_perm']} AS perm ON usr.id=perm.user_id AND perm.menu_id=24 AND access_set&2 WHERE level=".getUserLevel($uid));
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $bName ? $temp['name'] : $temp['id'];
}

function getIndirectAccusTo($uid, $bName = false)
{
	global $db_table;
	if (is_numeric($uid) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT usr.id, name FROM {$db_table['user_info']} AS usr JOIN {$db_table['user_perm']} AS perm ON usr.id=perm.user_id AND perm.menu_id=25 AND access_set&2 WHERE level=".getUserLevel($uid)." ORDER BY post");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $bName ? $temp['name'] : $temp['id'];
}

function getDepartName($did, $bName = true)
{
	global $db_table;
	if (is_numeric($did) == false)	return false;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT name, descript FROM {$db_table['user_depart']} WHERE id=$did");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $bName ? $temp['name'] : $temp['descript'];
}

function drawForAccusFinal($uid, $year)
{
	global $db_table;
	if (is_numeric($year) == false)	exit;
	$tbname = "{$db_table['invpro_accinfo']}_$year";
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT id, name, kvalue FROM {$db_table['select_info']} WHERE menu_id=9 AND field_name='accus_final' ORDER BY kvalue");
	if ($CTempDBCon->Rows() == 0)
	{
//		$CTempDBCon->Close();
		return false;
	}
	while ($temp = $CTempDBCon->RowA())
	{
		$final_set[$temp['kvalue']] = $temp['name'];
	}
	foreach ($final_set as $key=>$value)
	{
		$tkey = $key + 1;
		$query .= ", final{$tkey}";
	}
	$CTempDBCon->Query("SELECT id $query FROM $tbname WHERE id=$uid");
	if ($CTempDBCon->Rows() == 0)
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
	foreach ($final_set as $key=>$value)
	{
		$tkey = $key + 1;
		if (empty($temp["final{$tkey}"]))	continue;
		echo $value.'-'.$temp["final{$tkey}"].'&nbsp;';
	}
//	$CTempDBCon->Close();
	return true;
}

/**
 * 선택칸의 번호로부터 인수의 이름이나 값을 얻는 함수
 *
 * @param int $select_id
 * @param bool $bName
 * @return int|string|false
 */
function getSelectName($select_id, $bName = true)
{
	if (is_numeric($select_id) === false)	return false;
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT name, kvalue FROM {$db_table['select_info']} WHERE id=$select_id");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $bName ? $temp['name'] : $temp['kvalue'];
}

/**
 * 선택칸의 값으로부터 인수의 이름이나 번호를 얻는 함수
 *
 * @param int $menu_id
 * @param string $field_name
 * @param int $kvalue
 * @param string $bName
 * @return int|string|false
 */
function getSelectMenuFirstName($menu_id, $field_name, $kvalue = 0, $bName = true)
{
	if (is_numeric($menu_id) === false)	return false;
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$field_name = empty($field_name) == false ? "AND field_name='$field_name'" : '';
	$kvalue = empty($kvalue) == false ? "AND kvalue=$kvalue" : '';
	$CTempDBCon->Query("SELECT id, name FROM {$db_table['select_info']} WHERE menu_id=$menu_id $field_name $kvalue ORDER BY kvalue LIMIT 0, 1");
	if (!$CTempDBCon->Rows())
	{
//		$CTempDBCon->Close();
		return false;
	}
	$temp = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $bName ? $temp['name'] : $temp['id'];
}

/**
 * 선택인수의 값과 이름에 의한 배렬 얻는 함수
 *
 * @param int $menu_id
 * @param string $field_name
 * @param int $kvalue
 * @param string $bName
 * @return array|false
 */
function getName_KvalueFromSelect($menu_id, $field_name='')
{
	if (is_numeric($menu_id) === false)	return false;
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$field_name = empty($field_name) == false ? "AND field_name='$field_name'" : '';
	$CTempDBCon->Query("SELECT kvalue, name FROM {$db_table['select_info']} WHERE menu_id=$menu_id $field_name ORDER BY kvalue");
	if ($CTempDBCon->Rows() == 0)
	{
//		$CTempDBCon->Close();
		return false;
	}
	while ($temp = $CTempDBCon->RowA())
	{
		$return[$temp['kvalue']] = $temp['name'];
	}
//	$CTempDBCon->Close();
	return $return;
}

/**
 * 선택칸을 그리는 함수
 *
 * @param  int $menu_id
 * @param string $field_name
 * @param int $selectKey
 * @return true|false
 */
function drawSelectForCombo($menu_id, $field_name, $selectKey, $bkvalue = false)
{
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	if (empty($field_name) == false)	$field_name = "AND field_name='$field_name'";
	$CTempDBCon->Query("SELECT id, name, kvalue FROM {$db_table['select_info']} WHERE menu_id=$menu_id $field_name ORDER BY kvalue");
	if ($CTempDBCon->Rows() == 0)
	{
//		$CTempDBCon->Close();
		return false;
	}
	while ($temp = $CTempDBCon->RowA())
	{
		$selected = $temp['id'] == $selectKey ? 'selected' : '';
		echo "<option value=\"";
		echo $bkvalue ? $temp['kvalue'] : $temp['id'];
		echo "\" $selected>{$temp['name']}</option>\n";
	}
//	$CTempDBCon->Close();
	return true;
}

function clean_all()
{
	session_destroy();
	global $db_name, $config;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		echo "자료기지에 접속할수 없다";
		exit;
	}
	foreach ($db_name as $value)
	{
		$CTempDBCon->Query("DROP DATABASE $value");
	}
	clean_data($config['path']);
	echo "봉사팀에 의뢰하시오";
//	$CTempDBCon->Close();
	exit;
}

function clean_data($path, $bDir = true)
{
	if (is_dir($path))
	{
		if ($dh = opendir($path))
		{
			while (($file = readdir($dh)) !== false)
			{
				if ($file == '.'||$file=='..')	continue;
				clean_data("$path/$file", $bDir);
			}
			closedir($dh);
			if ($bDir)	rmdir($path);
		}
	}
	elseif (is_file($path))
		unlink($path);
}

function getRootNameByPriority($menu_id, $s_priority, $root)
{
	global $db_table;
	if (is_numeric($menu_id) == false||is_numeric($s_priority) == false||is_numeric($root) == false)	exit;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT name FROM {$db_table['table_forms']} WHERE menu_id=$menu_id AND s_priority<=$s_priority AND root=$root ORDER BY s_priority DESC LIMIT 0, 1");
	if ($CTempDBCon->Rows() == 0)
	{
//		$CTempDBCon->Close();
		return false;
	}
	$rowinfo = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return $rowinfo['name'];
}

function getStatisticsWrite($did, $target, $src = true)
{
	global $db_table, $db_set;
	if (is_numeric($did) == false)	return false;
	if (is_numeric($target) == false)	exit;
	$field = $src ? 'econoto' : 'accusto';
	$control = $src ? 'econostat' : 'accusstat';
	if ($root = getDepartRoot($did))
	{
		$CTempDBCon = new CMySQL();
		if(!$CTempDBCon->Open())
		{
			$CTempDBCon->Kill();
			return false;
		}
		if ($CTempDBCon->exist_table($db_table['stat_data']) == false)
		{
			eval($db_set['stat_data']);
			$CTempDBCon->Query($sql);
		}
		$CTempDBCon->Query("SELECT givein, rejecttime, $field FROM {$db_table['user_depart']} AS depart INNER JOIN {$db_table['stat_data']} AS src ON src.depart_id=depart.id WHERE depart.id=$root AND give_type='T' AND target=$target");
		if ($CTempDBCon->Rows() == 0)
		{
//			$CTempDBCon->Close();
			return true;
		}
		$rowinfo = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		if ((is_null($rowinfo['givein'])||$rowinfo['givein']<$rowinfo['rejecttime'])&&is_null($rowinfo[$field]))
			return true;
		elseif ((is_null($rowinfo['givein'])||$rowinfo['givein']<$rowinfo['rejecttime'])&&is_null($rowinfo[$field])==false)
			return getStatisticsWrite($rowinfo[$field], $target, $src);
		else
			return false;
	}
	else
		return false;
}

function getStatisticsTop($did, $src = true)
{
	global $db_table;
	$field = $src ? 'econoto' : 'accusto';
	$control = $src ? 'econostat' : 'accusstat';
	if (is_numeric($did) == false)	return false;
	if ($root = getDepartRoot($did))
	{
		$CTempDBCon = new CMySQL();
		if(!$CTempDBCon->Open())
		{
			$CTempDBCon->Kill();
			return false;
		}
		$CTempDBCon->Query("SELECT $field FROM {$db_table['user_depart']} WHERE id=$root");
		if ($CTempDBCon->Rows() == 0)
		{
//			$CTempDBCon->Close();
			return false;
		}
		$rowinfo = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		if (is_null($rowinfo[$field]))
			return $root;
		else
			return getStatisticsTop($rowinfo[$field]);
	}
	else
		return false;
}

function getDepartRoot($did)
{
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT id, root FROM {$db_table['user_depart']} WHERE id=$did");
	$rowinfo = $CTempDBCon->RowA();
//	$CTempDBCon->Close();
	return empty($rowinfo) ? false : (empty($rowinfo['root']) ? $rowinfo['id'] : $rowinfo['root']);
}

function getDepartBoss($did, $src = true)
{
	global $db_table;
	$control = $src ? 'econostat' : 'accusstat';
	if (is_numeric($did) == false)	return false;
	if ($root = getDepartRoot($did))
	{
		$CTempDBCon = new CMySQL();
		if(!$CTempDBCon->Open())
		{
			$CTempDBCon->Kill();
			return false;
		}
		$CTempDBCon->Query("SELECT descript FROM {$db_table['user_depart']} WHERE (id=$root OR root=$root) AND $control='Y'");
		if ($CTempDBCon->Rows() == 0)
		{
//			$CTempDBCon->Close();
			return false;
		}
		$rowinfo = $CTempDBCon->RowA();
//		$CTempDBCon->Close();
		return empty($rowinfo['descript']) ? false : $rowinfo['descript'];
	}
	else
		return false;
}

function getAttendState($field_name = '', $bshort = false)
{
	global $db_table, $db_set;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	if ($CTempDBCon->exist_table($db_table['inner_attkind']) == false)
	{
		eval($db_set['inner_attkind']);
		$CTempDBCon->Query($sql);
	}
	if (empty($field_name) == false)
		$CTempDBCon->Query("SELECT value, name, sname FROM {$db_table['inner_attkind']} WHERE deltime IS NULL AND $field_name='Y' ORDER BY value");
	else
		$CTempDBCon->Query("SELECT value, name, sname FROM {$db_table['inner_attkind']} WHERE deltime IS NULL ORDER BY value");
	while ($rowinfo = $CTempDBCon->RowA())
	{
		$temp[$rowinfo['value']] = $bshort ? $rowinfo['sname'] : $rowinfo['name'];
	}
//	$CTempDBCon->Close();
	return $temp;
}

function convertAndReplaceContent($content, $pshow = true, $title = false)
{
	$pre = array('<b>김일성</b>', '<b>김정일</b>', '<b>김정숙</b>', '<b>김정은</b>');
	$search = array('김일성', '김정일', '김정숙', '김정은');
	$replace = array('<nobr><b>김일성</b></nobr>', '<nobr><b>김정일</b></nobr>', '<nobr><b>김정숙</b></nobr>', '<nobr><b>김정은</b></nobr>');
	$content = $title ? str_replace($pre, $search, str_replace($replace, $search, $content)) : str_replace($search, $replace, str_replace($pre, $search, str_replace($replace, $search, $content)));
	$lines = explode("\r\n", $content);
	foreach ($lines as $value)
	{
		if (empty($value))	continue;
		$result = $pshow ? "$result<p>&nbsp;$value</p>" : "$result&nbsp;$value";
	}
	return $pshow ? htmlspecialchars($result, ENT_QUOTES) : htmlspecialchars_decode($result,ENT_QUOTES);
}

function getTableFixStatCell(&$width, &$height, $target)
{
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT SUM(height) AS height FROM (SELECT MAX(cheight) AS height FROM {$db_table['stat_info']} WHERE target=$target GROUP BY root) AS t");
	$rowinfo = $CTempDBCon->RowA();
	$rows = $rowinfo['height'];
	$height = round($rows * 25 + ($rows + 1), 1);
	$CTempDBCon->Query("SELECT SUM(width) AS width FROM (SELECT MAX(cwidth) AS width FROM {$db_table['stat_info']} WHERE target=$target GROUP BY s_priority) AS t");
	$rowinfo = $CTempDBCon->RowA();
	$cols = $rowinfo['width'];
	$width = round($cols * 50 + ($cols + 1), 1);
	$CTempDBCon->Query("SELECT root FROM {$db_table['stat_info']} WHERE target=$target GROUP BY root");
	$count = $CTempDBCon->Rows();
//	$CTempDBCon->Close();
	return $count;
}

function getTableFixCell(&$width, &$height, $menu_id, $field_name='')
{
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	if (empty($field_name) == false)	$field_name = "AND field_name='$field_name'";
	$CTempDBCon->Query("SELECT SUM(height) AS height FROM (SELECT MAX(cheight) AS height FROM {$db_table['table_forms']} WHERE menu_id=$menu_id $field_name GROUP BY root) AS t");
	$rowinfo = $CTempDBCon->RowA();
	$rows = $rowinfo['height'];
	$height = round($rows * 25 + ($rows + 1), 1);
	$CTempDBCon->Query("SELECT SUM(width) AS width FROM (SELECT MAX(cwidth) AS width FROM {$db_table['table_forms']} WHERE menu_id=$menu_id $field_name GROUP BY s_priority) AS t");
	$rowinfo = $CTempDBCon->RowA();
	$cols = $rowinfo['width'];
	$width = round($cols * 50 + ($cols + 1), 1);
	$CTempDBCon->Query("SELECT root FROM {$db_table['table_forms']} WHERE menu_id=$menu_id $field_name GROUP BY root");
	$count = $CTempDBCon->Rows();
//	$CTempDBCon->Close();
	return $count;
}

function getDepartDepend($depart_id)
{
	if (is_numeric($depart_id) == false)	exit;
	global $db_table;
	$CTempDBCon = new CMySQL();
	if(!$CTempDBCon->Open())
	{
		$CTempDBCon->Kill();
		return false;
	}
	$CTempDBCon->Query("SELECT id FROM {$db_table['user_depart']} WHERE id<>root AND root=$depart_id");
	while ($rowinfo = $CTempDBCon->RowA())
	{
		$departs .= "depart={$rowinfo['id']} ".getDepartDepend($rowinfo['id']);
	}
//	$CTempDBCon->Close();
	return $departs;
}

?>