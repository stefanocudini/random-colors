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
    input {
	    float:left;
	    height:20px;
	    background:#888;
	    border:1px solid #999;
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
    	text-align:left;
		min-height:80px;
		min-width:80px;
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
    	margin-left:30px;
    }
    .hue a {
    	position:absolute;
    	right:0px;
    	top:0px;
    	margin:2px;
    	width:1em;
    	height:1em;
    }
    .hue a:hover {
		font-weight:bold;
		margin:1px;
    }    
    #copy {
		position:fixed;
		top:4px;
		right:8px;
		color:#eee;
		z-index:4000;
		font-size:small;	
	}
    </style>   
    <script src="../jquery-1.4.2.min.js"></script>
    <script src="funcs.js"></script>    
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
		<div id="copy">powered by Stefano Cudini</div>		
		<div> Generatore di colori casuali<br />
		<small> clicca sul colore per creare colori simili</small>
		</div>
		<input id="newcol" type="button" value="Genera nuovo colore" />
		<input id="delcol" type="button" value="Cancella" />
		<div id="hues"></div>
	</body>
</html>    
