<?php

function reload($url)
{
    $graph = 'https://graph.facebook.com/';
    $post = 'id='.urlencode($url).'&scrape=true';
    return send_post($graph, $post);
}
function send_post($url, $post)
{
    $r = curl_init();
    curl_setopt($r, CURLOPT_URL, $url);
    curl_setopt($r, CURLOPT_POST, 1);
    curl_setopt($r, CURLOPT_POSTFIELDS, $post);
    curl_setopt($r, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($r, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($r);
    curl_close($r);
    return $data;
}

function mrtClass($name){
    $line1 = ['動物園', '木柵', '萬芳社區', '辛亥', '麟光', '六張犁', '科技大樓', '大安',
        '忠孝復興', '南京復興', '中山國中', '松山機場', '大直', '劍南路', '西湖', '港墘',
        '文德', '內湖', '大湖公園', '葫洲', '東湖', '南港軟體園區', '南港展覽館'];

    $line2 = [ '淡水', '紅樹林', '竹圍', '關渡', '忠義', '復興崗', '北投', '新北投', '奇岩',
        '唭哩岸', '石牌', '明德', '芝山', '士林', '劍潭', '圓山', '民權西路', '雙連', '中山',
        '台北車站', '台大醫院', '中正紀念堂', '東門', '大安森林公園', '大安', '信義安和', '台北101/世貿', '象山'];

    $line3 = ['新店', '新店區公所', '七張', '小碧潭', '大坪林', '景美', '萬隆', '公館',
        '台電大樓', '古亭', '中正紀念堂', '小南門', '西門', '北門', '中山', '松江南京',
        '南京復興', '台北小巨蛋', '南京三民', '松山'];

    $line4 = ['南勢角', '景安', '永安市場', '頂溪', '古亭', '東門', '忠孝新生', '松江南京',
        '行天宮', '中山國小', '民權西路', '大橋頭', '三重國小', '三和國中', '徐匯中學', '三民高中',
        '蘆洲', '臺北橋', '菜寮', '三重', '先吝宮', '頭前庄', '新莊', '輔大', '丹鳳', '迴龍'];

    $line5 = ['頂埔', '永寧', '土城', '海山', '亞東醫院', '府中', '板橋', '新埔', '江子翠', '龍山寺',
        '西門', '台北車站', '善導寺', '忠孝新生', '忠孝復興', '忠孝敦化', '國父紀念館', '市政府',
        '永春', '後山埤', '昆陽', '南港', '南港展覽館'];

    $lines = compact(
        'line1',
        'line4',
        'line2',
        'line3',
        'line5'
    );

    $result = [];
    $name = trim($name);

    foreach ($lines as $key => $line)
    {
        if (count($result) >= 2)
        {
            break;
        }
        foreach ($line as $station)
        {
            if (strpos($name, $station) !== false)
            {
                $result[] = $key;
                break;
            }
        }
    }

    if (strpos($name, '中山國中') !== false || strpos($name, '中山國小') !== false)
    {
        $result = array_diff($result, ['line2', 'line3']);
    }
    else if (strpos($name, '松山機場') !== false)
    {
        $result = array_diff($result, ['line3']);
    }

    return implode(' ', $result);
}


function addressContent($address) {
    $address = trim($address);
    return '<div>' . $address .
        ' <a class="btn btn-sm btn-success" href="https://www.google.com/maps/place/' . $address . '" target="_blank">
            Google Map
        </a></div>';
}

function starClass($value){

    $warning = ['3.5 ★', '3.0 ★', '2.5 ★', '2.0 ★', '1.5 ★', '1.0 ★'];

    $value = trim($value);

    if ($value >= '5' && $value < '6') {
        return 'blue';
    } else if ($value >= '4' && $value < '5') {
        return 'blue';
    } else if ($value >= '1' && $value < '4') {
        return 'yellow';
    } else {
        return '';
    }

}

function booleanClass($value){

    if ($value === true) {
        return 'blue';
    } else if ($value === false) {
        return 'yellow';
    } else {
        return '';
    }

}

function summarize($str, $length)
{
    if (mb_strlen($str) > $length) {
        return mb_substr($str, 0, $length) . '..';
    } else {
        return $str;
    }
}

function change_key( $array, $old_key, $new_key) {

    if( ! array_key_exists( $old_key, $array ) )
        return $array;

    $keys = array_keys( $array );
    $keys[ array_search( $old_key, $keys ) ] = $new_key;

    return array_combine( $keys, $array );
}

function change_cafe_key($cafe, $fields)
{
    foreach ($fields as $index => $field) {
        $cafe = change_key($cafe, $index, $field);
    }

    return $cafe;
}

function get_recommendations_count($id)
{
    return Modules\NomadiCore\Recommendation::where('cafe_id', $id)->count();
}

function get_recommendation_avatars($id)
{
    $recs = Modules\NomadiCore\Recommendation::where('cafe_id', $id)->get();

    $result = [];

    foreach ($recs as $rec) {
        $result[] = $rec->user->profile->avatar;
    }

    return $result;
}

function is_cafe_recommended_by_user($cafe_id, $user_id)
{
    return Modules\NomadiCore\Recommendation::where('entity_id', $cafe_id)
        ->where('user_id', $user_id)->count() ? true : false;
}

function get_comments($id)
{
    $comments = Modules\NomadiCore\Comment::where('entity_id', $id)->get();

    return $comments;
}

function calculate_median($array) {
    // perhaps all non numeric values should filtered out of $array here?
    $iCount = count($array);
    if ($iCount == 0) {
      throw new DomainException('Median of an empty array is undefined');
    }
    // if we're down here it must mean $array
    // has at least 1 item in the array.
    $middle_index = floor($iCount / 2);
    sort($array, SORT_NUMERIC);
    $median = $array[$middle_index]; // assume an odd # of items
    // Handle the even case by averaging the middle 2 items
    if ($iCount % 2 == 0) {
      $median = ($median + $array[$middle_index - 1]) / 2;
    }
    return $median;
}

function extractScore($str)
{
    preg_match_all('!\d+(?:\.\d)?!', $str, $matches);

    if (count($matches[0])) {
        return (float) $matches[0][0];
    } else {
        return 0;
    }
}

function extractRate($str)
{
    $result = extractScore($str);

    return $result == 0 ? '' : number_format($result, 1, '.', '');
}

function replace_at_icon($str)
{
    $url = url('/img/at.png');
    return str_replace('@', " <img src='$url' style='width: 20px;'> ", $str);
}

function makeClickableLinks($s) {
    return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}

function fisher_yates_shuffle(&$items, $seed)
{
    @mt_srand($seed);
    $items = array_values($items);
    for ($i = count($items) - 1; $i > 0; $i--)
    {
        $j = @mt_rand(0, $i);
        $tmp = $items[$i];
        $items[$i] = $items[$j];
        $items[$j] = $tmp;
    }
}

function getFlagName($locale)
{
    if ($locale === 'en') return 'us';
    if ($locale === 'zh-TW') return 'tw';
    if ($locale === 'zh-CN') return 'cn';
    if ($locale === 'ko') return 'kr';
    if ($locale === 'ja') return 'jp';
}

function generate_photo_url($photoreference, $maxheight, $maxwidth)
{
    $url = 'https://maps.googleapis.com/maps/api/place/photo' . '?'. http_build_query([
        'photoreference' => $photoreference,
        'sensor' => 'false',
        'maxheight' => $maxheight,
        'maxwidth' => $maxwidth,
        'key' => 'AIzaSyC7eLWJImaOxx8h8cevI2Lyl53-pfxUVGk'
    ]);

    return $url;
}

function dayName($num)
{
    $names = [
        1 => '星期一',
        2 => '星期二',
        3 => '星期三',
        4 => '星期四',
        5 => '星期五',
        6 => '星期六',
        7 => '星期日',
    ];

    return $names[$num];
}

function getReviewKeys()
{
    $rfs = config('review-fields');

    $rfks = [];

    foreach ($rfs as $rf) {
        $rfks[] = $rf['key'];
    }

    return $rfks;
}

function getInfoKeys()
{
    $ifs = config('info-fields');

    $ifks = [];

    foreach ($ifs as $if) {
        $ifks[] = $if['key'];
    }

    return $ifks;
}

function setupEntityCoordinate($entity)
{
    try {
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json' . '?'. http_build_query([
            'address' => $entity->address,
            'key' => config('services.google.key')
        ]));
    } catch ( Exception $e ) {
        echo "設定地址座標時發生錯誤：";
        dd($e);
    }

    $geo = json_decode($geo);

    $lat = $geo->results[0]->geometry->location->lat;

    $lng = $geo->results[0]->geometry->location->lng;

    $entity->latitude = $lat;

    $entity->longitude = $lng;
}
