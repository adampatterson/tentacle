<? load::view('admin/template-modal-header', array('title' => 'Insert media' ));?>

<script type="text/javascript">

	// domain.com/attachment/width/height/filename.extension
	// domain.com/attachment/name.extension

	$(document).ready(function(){

			$('#none').click(function() {
				
				$('#link_url').val('');
				return false;
			});
			
			$('#file').click(function() {
				
				$('#link_url').val('http://placehold.it/200x200');
				return false;
			});

			$('#insert').click(function() {

				var Title				= $('#title').val();
				var AltText				= $('#alt_text').val();
				var Caption				= $('#caption').val();
				var Link				= $('#link_url').val();
				
				if ( Link ) {
					var HtmlLink 		= '<a href="'+Link+'"><img src="http://placehold.it/200x200" alt="'+AltText+'" /></a>';
				} else {
					var HtmlLink 		= '<img src="http://placehold.it/200x200" alt="'+AltText+'" />';
				}

				console.log(HtmlLink);

				return false;
			});
			
		});
	</script>

<div class="row">
	<div class="span4">
		<img src="http://placehold.it/200x200" class="thumbnail"/>
		<!--<br />	
		<button class="btn ">Edit Image</button>-->
	</div>
	<div class="span6">
		<dl class="dl-horizontal">
			<dt>File name:</dt>
			<dd>adam.jpg</dd>
			<dt>File type:</dt>
			<dd>image/jepg</dd>
			<dt>Uploaded on:</dt>
			<dd>April 11, 2012</dd>
			<dt>Dimensions</dt>
			<dd>200 x 200</dd>
		</dl>
		<input type="hidden" name="file_name" value="adam.jpg" >
		<input type="hidden" name="width" value="200" >
		<input type="hidden" name="height" value="250" >
	</div>
</div>
<div class="row">
	<form class="form-horizontal">
		<fieldset>
			<h3>&nbsp;</h3>
			<div class="clearfix">
				<label class="control-label" for="title">Title</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="title" name="title" value="This is the title">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="alt_text">Alternate Text</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="alt_text" name="alt_text" value="This is an image" >
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="caption">Caption</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="caption" name="caption" value="This is the caption">
				</div>
			</div>
			<div class="clearfix">
				<label class="control-label" for="link_url">Link URL</label>
				<div class="input">
					<input type="text" class="input-xlarge span5" id="link_url" name="link_url" value="http://placehold.it/350x150" >
					<div class="input-append">
		                <button class="btn" type="button" id="none">None</button> <button class="btn" type="button" id="file">File</button>
		             </div>
				</div>
			</div>
		<? /* 
			<div class="clearfix">
				<label class="control-label">Alignment</label>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios1" value="option1" checked="">
									None
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios2" value="option2">
								Left
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios3" value="option3">
								Center
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="alignment" id="optionsRadios3" value="option3">
								Right
							</label>
						</li>
					</ul>
					</div>
				</div>
			*/?>
			<div class="clearfix">
				<label class="control-label">Size</label>
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" />
									Thumbnail (150 × 150)
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
								Medium (300 × 300)
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
								Large (584 × 584)
							</label>
						</li>
						<li>
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
								Full Size (1060 × 1060)
							</label>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="actions">
				<!--<a href="javascript:;" onclick="tinyMCE.execCommand('mceInsertContent',false,'<img src=\'http://placehold.it/350x150\' />');">[ Insert Image ]</a>-->
				<!--<a class="btn primary" href="javascript:parent.top.tinyMCE.get('Content').execCommand('mceInsertContent',false,'<img src=\'http://placehold.it/350x150\' />');" onmouseup="parent.jQuery.fancybox.close();">Insert Image</a>-->
				<a class="btn primary" id="insert">Insert Image</a>
				<button class="btn danger">Delete</button>
				<a class="btn" href="javascript:parent.jQuery.fancybox.close();">Cancel</a>
			</div>
		</fieldset>
	</form>
</div>
<? load::view('admin/template-modal-footer');?>