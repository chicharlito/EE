$(document).ready(function() {
	$("#textPunch").on("keyup",function(e){
		e.preventDefault();
		var value1 = $(this).val();
		var punchLeftCount = $(this).val().length;
		var punchLeftCountRows = value1.split(/\r|\r\n|\n/).length;
		if(punchLeftCountRows < 5 || punchLeftCount < 53 ){
			var punchLeft = $(this).val();
			$("#punchPreview").empty().append(nl2br(punchLeft));
			$("#count").empty().append(punchLeftCount);
			$("#msg").empty();
		}
		else{
			$("#msg").empty().append("<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>  <strong>Oups !</strong> vous ne pouvez pas dépasser 4 lignes.</div>");
			return false;
		}
	});
	
	$( "select" )
	  .change(function () {
	    var str = $( "select option:selected" ).val();
	    $( "#personne" ).text( str );
	  })
	  .change();
	  
	var category = null;
	$("label[class='radio-inline'] img").click(function() {
	    category = $(this).attr("alt");
	    switch(category)
	    {
		    case "bleu":
		    couleur = "#46b8d4";
		    couleur_bandeau = "#14a9ce";
			text_shadow = "0px 3px #42949D";
		    break;
		    
		    case "rouge":
		    couleur = "#db7979";
		    couleur_bandeau = "#d85d5d";
			text_shadow = "0px 3px #B36060";
		    break;
		    
		    case "vert":
		    couleur = "#14b670";
		    couleur_bandeau = "#16a544";
			text_shadow = "0px 3px #16935D";
		    break;
			
			case "jaune":
		    couleur = "#fad340";
		    couleur_bandeau = "#e5bc39";
			text_shadow = "0px 3px #BD9A00";
		    break;
		    
		    case "violet":
		    couleur = "#a349a4";
		    couleur_bandeau = "#803c81";
			text_shadow = "0px 3px #803c81";
		    break;
		    
		    default:
		    couleur = "#46b8d4";
		    couleur_bandeau = "#14a9ce";
			text_shadow = "0px 3px #42949D";
	    }
	    $("#preview-img").css("background-color",couleur);
	    $("#preview-etcasedit").css("background-color",couleur_bandeau);
	    $("#punchPreview").css("text-shadow",text_shadow);
	});	
	
	/*$("#generate").on("click",function(){
		var capture = {};
		var target = $('#preview-img');
		html2canvas(target, {
			onrendered: function(canvas) {
				capture.img = canvas.toDataURL( "image/png" );
				capture.data = { 'image' : capture.img };
				$.ajax({
				url: "index.php",
				data: capture.data,
				type: 'post',
				success: function( result ) {
					function setOk(){
						window.location = "http://www.etcasedit.cingeen.com/index.php?image="+result+"";
						}
						setTimeout(setOk, 1000);
					}
				});
			}
		});
	});*/
	
	function nl2br(str, is_xhtml) {
		var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}
	
	$(function() {
    	// $("#resizable").resizable({maxWidth: 390});
	 	$("#draggable").draggable({ containment: "#textPunchDr" });
	});
	
	$("#grow").click(function() {
	    var fontSize = parseInt($("#textPunch").css("font-size"));
	    var lineHeight = parseInt($("#textPunch").css("line-height"));
	    fontSize = fontSize - 1 + "px";
	    lineHeight = lineHeight - 1 + "px";
	    $('#textPunch').css({'font-size':fontSize});
	    $('#textPunch').css({'line-height':lineHeight});
		textAreaAdjust($("#textPunch"));
	});
	
	$("#grow-up").click(function() {
	    var fontSize = parseInt($("#textPunch").css("font-size"));
	    var lineHeight = parseInt($("#textPunch").css("line-height"));
	    fontSize = fontSize + 1 + "px";
	    lineHeight = lineHeight + 1 + "px";
	    $('#textPunch').css({'font-size':fontSize});
	    $('#textPunch').css({'line-height':lineHeight});
		textAreaAdjust($("#textPunch"));
	});
	
	/*$("#textPunch").one("click",function(){
		$(this).val("");
	});*/
});