<script src="<?php echo $non_secure_path?>js/rollovers.js" type="text/javascript"></script>
<script type="text/javascript" language="Javascript">
      var supersleight=function(){var root=false;
      	var applyPositioning=true;
      	var shim='images/blank.gif';
      	var shim_pattern=/x\.gif$/i;
      var fnLoadPngs=function(){if(root){root=document.getElementById(root);}else{root=document;}
      for(var i=root.all.length-1,obj=null;(obj=root.all[i]);i--){if(obj.currentStyle.backgroundImage.match(/\.png/i)!==null){bg_fnFixPng(obj);}
      if(obj.tagName=='IMG'&&obj.src.match(/\.png$/i)!==null){el_fnFixPng(obj);}
      if(applyPositioning&&(obj.tagName=='A'||obj.tagName=='INPUT')&&obj.style.position===''){obj.style.position='relative';}}};var bg_fnFixPng=function(obj){var mode='scale';var bg=obj.currentStyle.backgroundImage;var src=bg.substring(5,bg.length-2);if(obj.currentStyle.backgroundRepeat=='no-repeat'){mode='crop';}
      obj.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='"+mode+"')";obj.style.backgroundImage='url('+shim+')';};var el_fnFixPng=function(img){var src=img.src;img.style.width=img.width+"px";img.style.height=img.height+"px";img.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"', sizingMethod='scale')";img.src=shim;};var addLoadEvent=function(func){var oldonload=window.onload;if(typeof window.onload!='function'){window.onload=func;}else{window.onload=function(){if(oldonload){oldonload();}
      func();};}};return{init:function(){addLoadEvent(fnLoadPngs);},limitTo:function(el){root=el;},run:function(){fnLoadPngs();}};}();supersleight.init();
</script>

        <script language="javascript" type="text/javascript" src="<?php echo $non_secure_path?>js/jquery.js"></script>


    <script type="text/javascript">
	function ajaxshow(id){
		$(id).fadeIn("slow");
	}
	</script>

    <script type="text/javascript">
	function ajaxshow1(id){
		$(id).show("slow");
	}
	</script>

    <script type="text/javascript">
	function ajaxshow2(id){
		$(id).fadeIn("slow");
	}
	</script>

    <script type="text/javascript">
	function ajaxhide(id){
		$(id).fadeOut("slow");
	}
	</script>

    <script type="text/javascript">
	function ajaxhide1(id){
		$(id).hide("slow");
	}
	</script>


    