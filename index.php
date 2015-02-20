<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <title>Genera Colori Casuali</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <style>
    body {
    	background: url('back.png') no-repeat top left #666;
    	color:#000;
    }
	hr {
		border:none;
		border-bottom:1px solid #eee;
	}
    input {
	    float:left;
	    height:26px;
	    background:#888;
	    border:1px solid #999;
		padding:0 4px 4px 4px;
		margin:0 5px;
		-moz-border-radius: 0.25em;
		-webkit-border-radius: 0.25em;
		border-radius: 0.25em;
    }
    #newcol {
		display:block;
		margin:0 auto;
    }
    #hues {
    	clear:both;
    }
    .hue {
       	position:relative;
		font-size:14px;
    	text-align:left;
		min-height:80px;
		min-width:80px;
		line-height:40px;
		/*max-width:300px;		*/
		float:left;
		margin:2px;
		padding:2px;
    	border:1px solid #000;
    	cursor:pointer;
		-moz-border-radius: 0.25em;
		-webkit-border-radius: 0.25em;
		border-radius: 0.25em;
    }
    .hue.source {
    	clear:both;
    }
    .hue .hue {
/*    	margin-left:30px;*/
    }
    .hue a {
    	position:absolute;
    	right:0px;
    	top:0px;
    	margin:2px;
    	width:1em;
    	height:1em;
    	line-height:1em;
    }
    .hue a:hover {
		font-weight:bold;
		font-size:1.2em;
		margin:0;
    }    
	#copy {
		position:fixed;
		z-index:1000;
		right:-6px;
		top:-6px;
		font-style:italic;
		font-size:.85em;
		padding:5px 8px;
		background: #ccc;
		border: 2px solid #3e5585;		
		border-radius:.7em;
		opacity: 0.8;		
	}
    </style>   
    <script src="/js/jquery-1.4.2.min.js"></script>
    <script src="colors.js"></script>    
    <script>
	$(document).ready(function() {
	
		/*var rgb = randcolor(true);
		console.log(rgb);
		var hsl = rgb2hsl(rgb);
		console.log(hsl);
		var rgb2 = hsl2rgb(hsl);
		console.log(rgb2);//*/
		
		var aclose = $('<a>&times;</a>').click(function() {
						$(this).parent().remove();
						});
		
		$(".hue").live('click',function(e) {	//nuovo colore a partire dal genitore
			
			var rgb = $(this).data('rgb');			
			var hsl = rgb2hsl(rgb);
			//modifica s e l
			var newhsl = [hsl[0], Math.min(hsl[1]*minmaxrandom(0.8,1.2),1), Math.min(hsl[2]*minmaxrandom(0.8,1.2),1)];
			
			var newrgb = hsl2rgb(newhsl);
			var newhex = rgb2hex(newrgb);
			$('<div class="hue">')
				.data('rgb',newrgb)
				.css({background: newhex}).html('<div>'+newhex+'</div>')//+' '+newrgb.join(','))
				.appendTo(this);
		});

		$('#newcol').click(function() {	//aggiunge nuovo colore
			var rgb = randcolor(true);
			var hex = rgb2hex(rgb);
			$('<div class="hue source">').css({background: hex}).html('<div>'+hex+'</div>').append(aclose.clone(true)).data('rgb',rgb).prependTo('#hues');
			return false;
		});
		
		$('#delcol').click(function() {
			$('#hues').empty();
		});

	});
    </script>
    <!--script src="osmgoogle.js" type="text/javascript"></script-->
	</head>
	<body>
	<div id="copy"><a href="http://labs.easyblog.it/">Labs</a> &bull; <a rel="author" href="http://labs.easyblog.it/stefano-cudini/">Stefano Cudini</a></div>
		
		<div> Generatore di colori casuali in javascript<br />
		<small> clicca sul colore per creare colori simili</small>
		</div>
		<hr />
		<input id="newcol" type="button" value="Genera nuovo colore" />
		<input id="delcol" type="button" value="Cancella" />
		<div id="hues"></div>
<script type="text/javascript" src="/labs-common.js"></script>

	</body>
</html>    
