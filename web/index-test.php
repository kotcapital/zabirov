<?php
require_once('./data.php');

function match($c1, $c2)
{
    global $data;
    if (isset($data[$c1]) && isset($data[$c2])) {
        $dist = distinguish($data);
        $rateOne = rates($data[$c1], $dist);
        $rateTwo = rates($data[$c2], $dist);
        return score($rateOne, $rateTwo);
    }
    throw new Exception('Команды не найдены');
}

function rates($command, $distinguish)
{
    $arr['scoredRate']  = $command['goals']['scored'] / $command['games'];
    $arr['skipRate']  = $command['goals']['skiped'] / $command['games'];
    $arr['rate'] = $arr['scoredRate']/($arr['scoredRate']+$arr['skipRate']);
    $arr['scorePower'] = ($arr['scoredRate'] - $distinguish[0])/($distinguish[1] - $distinguish[0]);
    $arr['sigm'] = sqrt($arr['scoredRate']*(1-$arr['rate']));
    $arr['3sigm'] = $arr['scoredRate'] + 3*($arr['sigm']);
    $arr['2sigm'] = $arr['scoredRate'] + 2*($arr['sigm']);
    return $arr;
}

function distinguish($data){
    $mn = 100;
    $mx = 0;
    $scored = 0;
    $skiped = 0;
    foreach ($data as $dt) {
        $nd  = $dt['goals']['scored'] / $dt['games'];
        if ($nd > $mx) {
            $mx = $nd;
        }
        if ($nd < $mn) {
            $mn = $nd;
        }
        $scored += $dt['goals']['scored'] ;
        $skiped += $dt['goals']['skiped'] ;
    }
    return array($mn, $mx, $scored, $skiped);
}


function score($rateOne, $rateTwo){
    $mod = ($rateOne['scorePower'] - $rateTwo['scorePower']);
    $upMod = $mod*$rateOne['scorePower'];
    $downMod = $mod*$rateTwo['scorePower'];
    $maxOne = (rand (1,4) == 1 ? $rateOne['3sigm'] * (1 + $upMod) : $rateOne['2sigm'] * (1 + $upMod));
    $maxTwo = (rand (1,4) == 1 ? $rateTwo['3sigm'] * (1 - $downMod) : $rateTwo['2sigm'] * (1 - $downMod));
    $rand1 = rand(1,8);
    $one = $rateOne['scoredRate'] + ($rand1 == 1 ? $rateOne['2sigm'] : ($rand1 == 2 ? -$rateOne['2sigm'] : 0));
    $two = $rateTwo['scoredRate'] + ($rand1 == 1 ? $rateTwo['2sigm'] : ($rand1 == 2 ? -$rateTwo['2sigm'] : 0));
    return array($one, $two);
}

$res['games'] == 0;
$res['win'] == 0;
$res['draw'] == 0;
$res['defeat'] == 0;
$res['goals']['scored'] == 0;
$res['goals']['skiped'] == 0;
$ii = (isset($_GET['id']) ? $_GET['id'] : 0);
$yy = (isset($_GET['cnt']) ? $_GET['cnt'] : 10000);
for ($i == 0; $i< $yy ; $i++) {
    $r = match($ii, rand(0, 31));
    $res['games'] ++;
    ($r[0] > $r[1] ? $res['win']++ : ($r[0] < $r[1] ? $res['defeat']++ : $res['draw']++ ));
    $res['goals']['scored'] += $r[0];
    $res['goals']['skiped'] += $r[1];
}
$dist = distinguish($data);
print_r(rates($data[$ii], $distinguish));
print_r(rates($res, $distinguish));
print_r($data[$ii]);
print_r($res);
print_r($dist);
?>
