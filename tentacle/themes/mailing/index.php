<?
 /*
Name: Index Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

$data = array(
	'display' => 'admin'
);

if(!defined('SCAFFOLD')):
?>
<? load_part('header',array('title'=>'Welcome to Tentacle','assets'=>'marketing')); ?>
<div id="login-header">
	<a href="http://adampatterson.ca">by Adam Patterson</a>
</div>
<div id="login-content" class="marketing">
	<div id="login-logo">
		<a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>tentacle/admin/images/tentacle_logo_large.png" width="258" height="63" alt="Tentacle" /></a>
	</div>
	<div id="login-content-message">
		<p><strong>Tentacle is an OpenSource Content Management System, and it's easy to use!</strong></p>
		<p>Follow us on Twitter <a href="https://twitter.com/#!/TentacleCMS" class='' target="_blank">@TentacleCMS</a>, read the <a href='http://www.tentaclecms.com/blog/'>Blog</a>, and consider joining the mailing list.</p>
	</div>

	<form method="post" action="http://www.industrymailout.com/Industry/SubscribeRedirect.aspx" >
		<input type="hidden" name="mailinglistid" value="27205" />
		<input type="hidden" name="success" value="http://tentaclecms.com" />
		<input type="hidden" name="errorparm" value="error" />
		<dl>
			<dd><h2>Mailing list</h2></dd>
			<dd>
				<input type="text" name="givenname" placeholder="First Name"  maxlength="50" />
			</dd>
			<dd>
				<input type="text" name="familyname" placeholder="Last Name" maxlength="50" />
			</dd>
			<dd>
				<input type="text" name="email" maxlength="60" required="required" placeholder="Email" value="" class="email span4" />
			</dd>
			<dd>
				<input type="submit" value="Notify Me!" class="btn large primary" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://tentaclecms.com/blog/downloads/tentacle-beta" class="btn large success" onClick="javascript: _gaq.push(['_trackPageview', '/blog/downloads/tentacle-beta']); _gaq.push(['_trackEvent', 'Link', 'Download', 'v 0.5 Beta']);">Download</a>
			</dd>
		</dl>
		<?php if($note = note::get('session')): ?>
			<input type='hidden' name='history' value="<?= $note['content'];?> " />
		<?php endif;?>
	</form>
</div>
<a href="https://github.com/adampatterson/Tentacle/tree/beta-wip"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/abad93f42020b733148435e2cd92ce15c542d320/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub"></a>
  <!-- #login-content -->
<? load_part('footer'); 
endif;
?>