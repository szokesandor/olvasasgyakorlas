
var szavak = [];
var aktualis_index = -1;
var olvasottszoszam;
function init()
{
  load_settings();
  $("label:odd").css({
    "background-color": "#dcdcdc","color": "#000"
  });
  szolistaletoltese();
  $('#button_next').focus();
  $('#button_next').on('click', '#button_next',   function(){ 
    kovetkezo();
  });
  $('#word').on('click', function(){ 
    kovetkezo();
  });
  $('#button_filter').on('click', '#button_filter', function(){ 
    szolistaletoltese(); 
    //defaultPrevented = true;
    //return false;
  });

  $('#szotagok').change(function(){ 
    var t_szo = window.szavak[window.aktualis_index].t_szo;
    var t_szotagolt = window.szavak[window.aktualis_index].t_elvasztas;
    if($("#szotagok").is(":checked"))
    {
      $('#word').html(t_szotagolt);
    }
    else
    {
      $('#word').html(t_szo);
    }
  });
}

function kovetkezo()
{
  window.olvasottszoszam += 1;
  if (window.szavak.length > 0)
  {
    var kov = Math.floor(Math.random() * window.szavak.length);
    while (kov == window.aktualis_index)
    {
      kov = Math.floor(Math.random() * window.szavak.length);
    }
    window.aktualis_index = kov;
    var t_szo = window.szavak[kov].t_szo;
    var t_szotagolt = window.szavak[kov].t_elvasztas;
    if($("#szotagok").is(":checked"))
    {
      $('#word').html(t_szotagolt);
    }
    else
    {
      $('#word').html(t_szo);
    }
    $('#olvasottszoszam').html(olvasottszoszam + ". szó");
    
    console.log("" + kov + " " + t_szo + " " + t_szotagolt);
    return "";
  }else
  {
    console.log("Üres tömb");
    return "";
  }
}

function szolistaletoltese()
{
  window.olvasottszoszam = 0;
  save_settings();
  console.log("letöltés indul");
  var http_request = new XMLHttpRequest();
  var params = $('#form_betuk').serialize();;
  http_request.open("GET", "/olvasas/db_query.php" + "?" + params, false);
  http_request.onreadystatechange = function () 
  {
    var done = 4, ok = 200;
    if (http_request.readyState == done && http_request.status == ok) 
    {
         window.szavak = JSON.parse(http_request.responseText);
         $('#szavakszama').html(window.szavak.length + " szóval");
         var dt = new Date();
         $('#frissitve').html(dt.format("yyyy.mm.dd h:MM:ss"));
         console.log("letöltés befejeződött");
         kovetkezo();
    }
  };
  http_request.send();
  return false;
}

// valtozok betuk allapotanak elmentesehez, betoltesehez
// cookiename:checkboxname
// k: valtozok[k]
var valtozok = {"a":"a","aa":"aa","b":"b","c":"c","cs":"cs","d":"d","e":"e",
  "ee":"ee","f":"f","g":"g","gy":"gy","h":"h","i":"i","ii":"ii","j":"j","k":"k",
  "l":"l","ly":"ly","m":"m","n":"n","ny":"ny","o":"o","oo":"oo","ooo":"oooo",
  "oooo":"oooo","p":"p","q":"q","r":"r","s":"s","sz":"sz","t":"t","ty":"ty",
  "u":"u","uu":"uu","uuu":"uuu","uuuu":"uuuu","v":"v","w":"w","x":"x","y":"y",
  "z":"z","zs":"zs"}; 

function load_settings()
{
  var cbname1 ="input[name='";
  var cbname2 ="']";
  
  for (var k in valtozok)
  {
    if (valtozok.hasOwnProperty(k))
    {
      if($.cookie(k) != "undefined")
        $(cbname1+valtozok[k]+cbname2).prop('checked',($.cookie(k)=="false"?false:true));
//      $("input[name='a']").prop('checked',($.cookie("a")=="false"?false:true));
    }
  }

  // szotagolas
  $(cbname1+"szotagok"+cbname2).prop('checked',($.cookie("szotagok")=="false"?false:true));

  // szotag min es max
  if(typeof $.cookie("szotag_min") !== "undefined")
    $("#szotag_min").val(parseInt($.cookie("szotag_min"))); 
  if(typeof $.cookie("szotag_max") !== "undefined")
    $("#szotag_max").val(parseInt($.cookie("szotag_max"))); 
}
function save_settings()
{
  var cbname1 ="input[name='";
  var cbname2 ="']";

  for (var k in valtozok)
  {
    if (valtozok.hasOwnProperty(k))
    {
      $.cookie(k, $(cbname1+valtozok[k]+cbname2).is(":checked"), { expires: 31 }); 
//      setcookie("a", $("input[name='a']").is(":checked"), days);
    }
  }
 
  // szotagolas
  $.cookie("szotagok", $(cbname1+"szotagok"+cbname2).is(":checked"), { expires: 31 }); 

  // szotag min es max
  $.cookie("szotag_min", $("#szotag_min").val(), { expires: 31 }); 
  $.cookie("szotag_max", $("#szotag_max").val(), { expires: 31 }); 
}
