
function isEmpty(obj) {
    for(var prop in obj) {
        if(obj.hasOwnProperty(prop))
            return false;
    }

    return true;
}

function isLocal() {
	return (document.location.hostname=='localhost' || document.location.hostname=='127.0.0.1');
}

function jsonStringify(obj) {
    var t = typeof (obj);
    if (t != "object" || obj === null) {
        // simple data type
        if (t == "string") obj = '"'+obj+'"';
        return String(obj);
    }
    else {
        // recurse array or object
        var n, v, json = [], arr = (obj && obj.constructor == Array);
        for (n in obj) {
            v = obj[n]; t = typeof(v);
            if (t == "string") v = '"'+v+'"';
            else if (t == "object" && v !== null) v = JSON.stringify(v);
            json.push((arr ? "" : '"' + n + '":') + String(v));
        }
        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
    }
}
function rgb2hex(rgb)
{
	return "#"+rgb[0].toString(16)+rgb[1].toString(16)+rgb[2].toString(16);
}

function minmaxrandom(min, max)
{
	return Math.random() * (max - min) + min;
}

function randcolor(array) {
  array = (typeof array == 'undefined') ? false : array;
  
  function c() {
  	cc = Math.floor(minmaxrandom(36,255));//+36 senno' vengono troppo scuri
    return array ? cc : cc.toString(16);//esadecimale
  }
  
  return array ? [c(), c(), c() ] : "#"+c()+c()+c();
}

function print_r(theObj) {
  var out = '';
  if(theObj.constructor == Array ||
     theObj.constructor == Object){
    out +="<ul>";
    for(var p in theObj){
      if(theObj[p].constructor == Array||
         theObj[p].constructor == Object){
		out +="<li>["+p+"] => "+typeof(theObj)+"</li>";
        out +="<ul>";
        out +=print_r(theObj[p]);
        out +="</ul>";
      } else {
	out +="<li>["+p+"] => "+theObj[p]+"</li>";
      }
    }
    out +="</ul>";
  }
  return out;
}

/**
http://mjijackson.com/2008/02/rgb-to-hsl-and-rgb-to-hsv-color-model-conversion-algorithms-in-javascript
 * Converts an RGB color value to HSL. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes r, g, and b are contained in the set [0, 255] and
 * returns h, s, and l in the set [0, 1].
 *
 * @param   Number  r       The red color value
 * @param   Number  g       The green color value
 * @param   Number  b       The blue color value
 * @return  Array           The HSL representation
 */
function rgb2hsl(rgb) {
	var r,g,b;
	r=rgb[0];g=rgb[1];b=rgb[2];
	
    r /= 255, g /= 255, b /= 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if(max == min){
        h = s = 0; // achromatic
    }else{
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch(max){
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h /= 6;
    }

    return [h, s, l];
}

/**
 * Converts an HSL color value to RGB. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes h, s, and l are contained in the set [0, 1] and
 * returns r, g, and b in the set [0, 255].
 *
 * @param   Number  h       The hue
 * @param   Number  s       The saturation
 * @param   Number  l       The lightness
 * @return  Array           The RGB representation
 */
function hsl2rgb(hsl){
	var h,s,l;
	h=hsl[0];s=hsl[1];l=hsl[2];


    var r, g, b;

    if(s == 0){
        r = g = b = l; // achromatic
    }else{
        function hue2rgb(p, q, t){
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return [Math.ceil(r * 255), Math.ceil(g * 255), Math.ceil(b * 255)];
}

