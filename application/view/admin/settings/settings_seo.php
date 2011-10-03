<? load::view('admin/template-header', array('title' => 'SEO settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> SEO settings</h1>
	<form action="post" class="form-stacked">
		<div class="one-full">
			<div class="one-half">
					<h2>Google Analytics UID</h2>
				<hr />
				<div class="clearfix">
					<div class="input">
						<input type="text" value="XX-XXXXX-X" id="ga_uid" name="ga_uid" size="50">
						<span class="help-block">The UID is needed for Google Analytics to log your website stats. If you are having trouble finding your UID {click here}.</span>
					</div>
				</div>
				<h2>Webmaster tools</h2>
				<hr />
				<p>
					Enter your meta key "content" value to verify your blog with <a href="https://www.google.com/webmasters/tools/">Google Webmaster Tools</a>, <a href="https://siteexplorer.search.yahoo.com/">Yahoo Site Explorer</a>, and <a href="http://www.bing.com/webmaster">Bing Webmaster Center</a>
				</p>
				<div class="clearfix">
					<label for="verification_services_codes[google]">Google Webmaster Tools</label>
					<div class="input">
						<input size="50" name="verification_services_codes[google]" value="" type="text">
						<span class="help-block">Example:
							<code>
								&lt;meta name='google-site-verification' content='<strong><span class="red">dBw5CvburAxi537Rp9qi5uG2174Vb6JwHwIRwPSLIK8</span></strong>'&gt;
							</code></span>
					</div>
				</div>
				<div class="clearfix">
					<label for="">Yahoo Site Explorer</label>
					<div class="input">
						<input size="50" name="verification_services_codes[yahoo]" value="" type="text">
						<span class="help-block"> Example:
							<code>
								&lt;meta name='y_key' content='<strong><span class="red">3236dee82aabe064</span></strong>'&gt;
							</code> </span>
					</div>
				</div>
				<div class="clearfix">
					<label for="">Bing Webmaster Center</label>
					<div class="input">
						<input size="50" name="verification_services_codes[bing]" value="" type="text">
						<span class="help-block"> Example:
							<code>
								&lt;meta name='msvalidate.01' content='<strong><span class="red">12C1203B5086AECE94EB3A3D9830B2E</span></strong>'&gt;
							</code> </span>
					</div>
				</div>
				<h2>Robots</h2>
				<hr />
				<div class="clearfix">
					<label>Spider</label>
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label for="noodp">
									<input type="checkbox" value="1" id="noodp" name="noodp">
									Don’t use this site’s Open Directory description in search results. </label>
							</li>
							<li>
								<label for="noydir">
									<input type="checkbox" value="1" id="noydir" name="noydir">
									Don’t use this site’s Yahoo! Directory description in search results. </label>
							</li>
							<li>
								<label for="noarchive">
									<input type="checkbox" value="1" id="noarchive" name="noarchive">
									Don’t cache or archive this site. </label>
							</li>
						</ul>
					</div>
				</div>
				<div class="clearfix">
					<label>Noindex</label>
					<div class="input">
						<ul class="inputs-list">
							<li>
								<label for="noindex_admin">
									<input type="checkbox" value="1" name="noindex_admin">
									Administration back-end pages </label>
							</li>
							<li>
								<label for="noindex_author">
									<input type="checkbox" value="1" name="noindex_author">
									Author archives </label>
							</li>
							<li>
								<label for="noindex_search">
									<input type="checkbox" value="1" name="noindex_search">
									Blog search pages </label>
							</li>
							<li>
								<label for="noindex_category">
									<input type="checkbox" value="1" name="noindex_category">
									Category archives </label>
							</li>
							<li>
								<label for="noindex_comments_feed">
									<input type="checkbox" value="1" name="noindex_comments_feed">
									Comment feeds </label>
							</li>
							<li>
								<label for="noindex_cpage">
									<input type="checkbox" value="1" name="noindex_cpage">
									Comment subpages </label>
							</li>
							<li>
								<label for="noindex_date">
									<input type="checkbox" value="1" name="noindex_date">
									Date-based archives </label>
							</li>
							<li>
								<label for="noindex_home_paged">
									<input type="checkbox" value="1" name="noindex_home_paged">
									Subpages of the homepage </label>
							</li>
							<li>
								<label for="noindex_tag">
									<input type="checkbox" value="1" name="noindex_tag">
									Tag archives </label>
							</li>
							<li>
								<label for="noindex_login">
									<input type="checkbox" value="1" name="noindex_login">
									User login/registration pages </label>
							</li>
						</ul>
					</div>
				</div>
				<h2>Meta Description</h2>
				<hr />
				<div class="clearfix">
					<div class="input">
						<textarea rows="5" cols="40" name="meta_description" placeholder='Enter your meta description'></textarea>
					</div>
				</div>
			</div>
			<div class="one-half">
				<h2>404 Monitor</h2>
				<hr />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<thead class="table-heading">
						<tr>
							<th>URL</th>
							<th>Referers</th>
							<th>Hits</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>http://www.adampatterson.ca/2009/01/print/print-03/</td>
							<td ><img src="<?=ADMIN_URL;?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
							<td>12</td>
						</tr>
						<tr>
							<td>http://www.adampatterson.ca/2009/01/print/print-04/</td>
							<td ><img src="<?=ADMIN_URL;?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
							<td>12</td>
						</tr>
						<tr>
							<td>http://www.adampatterson.ca/2009/01/print/print-01/</td>
							<td ><img src="<?=ADMIN_URL;?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
							<td>12</td>
						</tr>
						<tr>
							<td>http://www.adampatterson.ca/2009/01/black-and-white/2009040121050817_img_7488/</td>
							<td ><img src="<?=ADMIN_URL;?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
							<td>12</td>
						</tr>
						<tr>
							<td>http://www.adampatterson.ca/2009/01/black-and-white/2009040121045505_img_0441/</td>
							<td ><img src="<?=ADMIN_URL;?>images/icons/16_cursor.png" width="16" height="16" alt="Referers" /></td>
							<td>12</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="one-full">
			<div class="actions">
				<button class="btn medium primary" type="submit">
					Save
				</button>
				<a href="#" class="red button-secondary">Cancle</a>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
