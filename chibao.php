<?php
set_time_limit(0);
function auto($url){
$data = curl_init();
curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($data, CURLOPT_URL, $url);
$hasil = curl_exec($data);
curl_close($data);
return $hasil;
}
$access_token= "dien token vao";
if(file_exists('C3')){ $log=json_encode(file('chibao')); }else{ $log=''; }
$stat=json_decode(auto('https://graph.beta.facebook.com/me/home?fields=id,from&limit=10&access_token='.$access_token),true);
for($i=1;$i<=count($stat[data]);$i++){
if(!ereg($stat[data][$i-1][id],$log)){
$x=$stat[data][$i-1][id]."\n";
$y=fopen('chibao','a');
fwrite($y,$x);
fclose($y);
auto('https://graph.facebook.com/v2.6/'.$stat[data][$i-1][id].'/reactions?type=ANGRY&method=post&access_token='.$access_token);
}
}
?>
