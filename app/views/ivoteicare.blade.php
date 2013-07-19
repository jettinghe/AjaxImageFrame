<!DOCTYPE html>
<html>
<head>
<title>I Vote and I Care</title>
  {{ HTML::style('/css/style.css') }}
  {{ HTML::script('/js/jquery-1.7.2.min.js') }}
  {{ HTML::script('/js/application.js') }}
  {{ HTML::script('/js/jquery.icheck.js') }}
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=287031294701432";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="header">
			<h1>{{ HTML::link('/', 'I Vote and I Care', array('class'=>'sitetitle')) }}</h1>
		</div><!-- end header -->
	<div id="container">
		
		<div id="content" >

		<div id="uploadimg">
			{{ Form::open(array('id' => 'itemimage', 'class' => 'dropzone', 'url' => 'itemimage', 'method' => 'post')) }}
				{{ Form::token() }}
				<p class="imagecount"></p>
			{{ Form::close() }}

			<script type="text/javascript">
			Dropzone.autoDiscover = false;
			var total = 0;
				$(function() {

				var myDropzone = new Dropzone("#itemimage");
				function scrollToAnchor(aid){
					var aTag = $("a[name='"+ aid +"']");
					$('html,body').animate({scrollTop: aTag.offset().top},'slow');
				}

		
				myDropzone.on("removedfile", function(file) {
				  	total = total - 1;
				  	$("p.imagecount").text("");
				    $('#removed').append('<option value='+ file.name +' selected=' + 'selected' + '>'+file.name+'</option>');
				});

				myDropzone.on("addedfile", function(file) {
				  	
				  	$('#added').append('<option value='+ file.name +' selected=' + 'selected' + '>'+file.name+'</option>');

				  	total = total + 1;
				    if (total > 1){
				     	myDropzone.removeFile(file);
				     	$("p.imagecount").text("Currently You Can Only Upload 1 Image, Sorry!");
				     	$("p.imagecount").fadeIn(300);
				    }
				});

				myDropzone.on("success", function(file){
				  	$("input[type=submit]").prop("disabled", false);
				  	scrollToAnchor('frame');
				});

			})
			</script>
		</div> <!-- end image upload section -->
		
		
		<div id="overlay">
			<a name="frame"></a>
			<p class="middle frame">Then Choose Your Favourite Frame</p>
			{{ Form::open(array('id' => 'makeimage', 'url' => '/', 'method' => 'post'))}}
	    	<div class="image">
	    	{{ Form::radio('overlay', 'sheep', true, array('id' => 'sheep_overlay')) }}
	    		<div class="votesheep"><img src="/images/i-vote-and-i-care_sheep.png" width="200" heigh="200"/></div>
	    	</div>
	    	<div class="image">
	    	{{ Form::radio('overlay', 'cattle', false, array('id' => 'cattle_overlay')) }}
	    	<div class="votecattle"><img src="/images/i-vote-and-i-care_cattle.png" width="200" heigh="200"/></div>
	    	</div>
    	</div>
    	<div id="generate">
    		{{ Form::submit('Gimme My Image', array('id'=>'gimme', 'class' => 'gimme', 'disabled'=>'disabled')) }}
	    	{{ Form::close() }}
	    </div>
	    
	    
	    
	    <div id="message">
	    <a name="yourimage"></a>
	    	<p class="middle"></p>
	    	<div class="image"></div>
	    	<div class="share">
	    	<a class="download" href="/images/yourimage.jpg" target="_blank"><img src="/download.png"/>Download</a>
	    	<a class="facebook" href="#" onclick="
			    window.open(
			      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href)+'images/yourimage.jpg', 
			      'facebook-share-dialog', 
			      'width=626,height=436'); 
			    return false;">
			  <img src="/facebook.png"/>Share on Facebook
			</a>
			<a class="twitter" href="https://twitter.com/share?url=http://dagalleria.com/images/yourimage.jpg" target="_blank"><img src="/twitter.png"/>Tweet</a>
	    	</div>
	    </div>

	    <div id="loading">
	    <div id="circleG">
			<div id="circleG_1" class="circleG">
			</div>
			<div id="circleG_2" class="circleG">
			</div>
			<div id="circleG_3" class="circleG">
			</div>
		</div>
		</div>



</div><!-- end content -->

		

	</div><!-- end container -->
	<div id="footer">
		I Vote and I Care &#169; {{ date('Y')}}
	</div>
</body>

</html>