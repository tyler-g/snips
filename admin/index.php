<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>snips admin</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="shortcut icon"
 href="favicon.ico" />
 
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="https://www3.opensky.com/page-assets/ui-lightness/jquery-ui-1.8.16.custom.css"/>
	<link href='http://fonts.googleapis.com/css?family=Monofett|Monoton' rel='stylesheet' type='text/css'>

    <!-- SYNTAXHIGHLIGHTER PLUGIN JS
	<script type="text/javascript" src="scripts/shCore.js"></script>
	<script type="text/javascript" src="scripts/shBrushJScript.js"></script>
	<script type="text/javascript" src="scripts/shBrushCss.js"></script>
	--!>
	
	<script type="text/javascript" src="../prettify/prettify.js"></script>
	
	<!-- SYNTAXHIGHLIGHTER PLUGIN CSS
	<link type="text/css" rel="stylesheet" href="styles/shCoreDefault.css"/>
	<link type="text/css" rel="stylesheet" href="styles/shCore.css"/>
	--!>
	
	<link type="text/css" rel="stylesheet" href="../prettify/prettify.css"/>
	
	<!-- SYNTAXHIGHLIGHTER PLUGIN INIT
	<script type="text/javascript">
	//SyntaxHighlighter.defaults['class-name'] = 'cnn';
	//SyntaxHighlighter.defaults['toolbar'] = 'false';
	//SyntaxHighlighter.all();
	</script>
	--!>
	
	<script src="../js/libs/modernizr-2.0.6.min.js"></script>

<style>
a:hover{
color:red !important;
}
header h1:hover{
color:red !important;
}
.code-block>span{
float:left;
color:white;
background:#333;
padding: 4px;
font-size:10px;
display:block;
}
.code-block>button{
float:right;
}

video{
background:transparent !important;
}

</style>

</head>
<body onload="prettyPrint()">

<div id="container">

<header>
<h1 class="trans1">Snips admin</h1>
<p>snippets of javascript + css code for easy reuse.</p>
<hr>

</header>

	<div id="main" role="main">


<div id="iso-contain">


</div>

	</div>
<footer>
</footer>
	
	<div id="vfeedback" class="trans1"></div>
</div> <!--! end of #container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://www3.opensky.com/page-assets/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.zclip.min.js"></script>
<script src="../js/iso.js"></script>

<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

<!-- scripts concatenated and minified via ant build script-->
<script src="../js/plugins.js"></script>
<script src="../js/script.js"></script>
<!-- end scripts-->

<script>
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

<script>
 
//MODERNIZR CHECKS

if (Modernizr.localstorage) {
    // browser supports local storage
}
else {
    // browser doesn't support local storage
}

//DOM READY START
$(document).ready(function() {

//CACHE VARS
var $container = $('#iso-contain');
var $vfb = $('#vfeedback');

//FUNCTIONS

//visual feedback function
function vfeedback(msg,type){

switch(type){

case 1:
//normal msg
$vfb.css('background-color','#111111');
break;

case 2:
//error
$vfb.css('background-color','#ff0000');
break;

default:

}

$vfb.text(msg);
$vfb.addClass('hover');
    setTimeout(function() {
        $vfb.removeClass('hover');
    }, 2000);
}
//isotope function
function doIsotope(){

$container.isotope({
  // options
  itemSelector : '.code-block',
  layoutMode : 'masonry'
});

}

//parse XML function
function parseXml(xml)
{
  var fullcode;
  $(xml).find("snip").each(function()
  {
    var $this = $(this);
    var $code = $this.find('code');
    var type = $this.find('type').text();
    fullcode="";
    
    //div class will be different depending on the type of code (js/css/etc.)
    switch (type){

    case "javascript" :
    fullcode += "<div class=\"code-block javascript\">";
    break;

    case "css" :
    fullcode += "<div class=\"code-block css\">";
    break;
    
    default :
    fullcode += "<div class=\"code-block javascript\">";
    }

    fullcode += "<pre class=\"prettyprint\">";
    fullcode += $code.text();
    fullcode += "<\/pre>";
    fullcode += "<button>approve<\/button>";
    fullcode += "<span>"+type+"<\/span>";
    fullcode += "<\/div>";
    
    $container.append(fullcode);
    //console.log(fullcode);
    
  });
doIsotope();
}

//parse XML GET
  $.ajax({
    type: "GET",
    url: "new-snips.xml",
    dataType: "xml",
    success: parseXml
  });
//end parse XML GET 

//CLICK HANDLERS

//approved a snip
$(document).on("click", "button",function(e) {
var $cur=$(this);

var $curblock = $cur.parent('.code-block');
$container.isotope('remove', $curblock)
$container.isotope( 'reLayout' )
vfeedback("snip approved",1);

//console.log($('.code-block').length);
});


});//DOM READY END

</script>

<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
