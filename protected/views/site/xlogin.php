<div class="modal-header" style="">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<ul class="nav nav-pills">
			<li class="<?php print $tab['umkm']; ?>"><a data-toggle="tab" href="#umkm"><i class="icon-magnet"></i></a></li>
			<li class="<?php print $tab['sys']; ?>"><a data-toggle="tab" href="#sys"><i class="icon-user"></i></a></li>
			<li class="<?php print $tab['visitor']; ?>"><a data-toggle="tab" href="#visitor"><i class="icon-gift"></i></a></li>
	</ul>
</div>
<div class="modal-body tab-content" id="modal-body">
	<div class="tab-pane <?php print $tab['sys']; ?>" id="sys">
		<p class="span7"><strong>Login System Administrator</strong></p>
		<div class="span4">
		<form id="sysform" class="row">
			<div class="input-prepend span3"><span class="add-on"><i class="icon-user"></i></span><input id="LoginForm[username]" value="<?php print $model->username;?>" type="text" placeholder="E-Mail" name="LoginForm[username]"></div>
			<div class="input-prepend span3"><span class="add-on"><i class="icon-lock"></i></span><input id="LoginForm[password]" value="<?php print $model->password;?>" type="password" placeholder="Password" name="LoginForm[password]">
				<input type="hidden" name="LoginForm[tipe]" value="<?php print LevelLookup::ACCOUNT_SYSADMIN;?>">
			</div>    			
			<div class="span3">
				<button type="button" class="btn btn-primary" onclick="newXhrSubmit(this,'#sysform');" u-url="<?php print $this->createUrl('site/xlogin')?>"><i class="icon-hand-right icon-white"></i> Login</button>
			</div>
		</form>
		</div>
	</div>
	<div class="tab-pane <?php print $tab['visitor']; ?>" id="visitor">
		<p class="span7"><strong>Login Pengunjung</strong></p>
		<div class="span4">
		<form id="visitorform" class="row">
			<div class="input-prepend span3"><span class="add-on"><i class="icon-user"></i></span><input id="LoginForm[username]" value="<?php print $model->username;?>" type="text" placeholder="E-Mail" name="LoginForm[username]"></div>
			<div class="input-prepend span3"><span class="add-on"><i class="icon-lock"></i></span><input id="LoginForm[password]" value="<?php print $model->password;?>" type="password" placeholder="Password" name="LoginForm[password]">
				<input type="hidden" name="LoginForm[tipe]" value="<?php print LevelLookup::ACCOUNT_VISITOR;?>">
			</div>    			
			<div class="span3">
				<button type="button" class="btn btn-primary" onclick="newXhrSubmit(this,'#visitorform');" u-url="<?php print $this->createUrl('site/xlogin')?>"><i class="icon-hand-right icon-white"></i> Login</button>
			</div>
		</form>
		</div>
		<div class="span4">
		<p>Belum punya akun pengunjung? 
			<a class="btn" href="<?php print $this->createUrl('site/registerpengunjung')?>"><i class="icon-pencil"></i> Daftar Sekarang!</a>
			<a class="" href="<?php print $this->createUrl('site/resetpasswordpgj')?>"> Lupa password?</a>
		</p>
		</div>
	</div>
	<div class="tab-pane <?php print $tab['umkm']; ?>" id="umkm">
		<p class="span7"><strong>Login Pengelola UMKM</strong></p>
		<div class="span4">
		<form id="umkmform" class="row">
			<div class="input-prepend span3"><span class="add-on"><i class="icon-user"></i></span><input id="LoginForm[username]" value="<?php print $model->username;?>" type="text" placeholder="E-Mail" name="LoginForm[username]"></div>
			<div class="input-prepend span3"><span class="add-on"><i class="icon-lock"></i></span><input id="LoginForm[password]" value="<?php print $model->password;?>" type="password" placeholder="Password" name="LoginForm[password]">
				<input type="hidden" name="LoginForm[tipe]" value="<?php print LevelLookup::ACCOUNT_UMKM;?>">
			</div>    			
			<div class="span3">
				<button type="button" class="btn btn-primary" onclick="newXhrSubmit(this,'#umkmform');" u-url="<?php print $this->createUrl('site/xlogin')?>"><i class="icon-hand-right icon-white"></i> Login</button>
			</div>
		</form>
		</div>
		<div class="span4">
		<p>Usaha anda belum didaftarkan? Segera daftarkan UMKM anda, dapatkan berbagai manfaat.<br>
			<a class="btn" href="<?php print $this->createUrl('site/registerumkm')?>"><i class="icon-pencil"></i> Daftar Sekarang!</a>
			<a class="" href="<?php print $this->createUrl('site/resetpasswordumkm')?>"> Lupa password?</a>
		</p>
		</div>
	</div>
</div>
<div class="modal-footer tab-content">
	<small class="pull-left">
		<p class="label label-important"><?php print $model->getError('username');?></p><br>
		<p class="label label-important"><?php print $model->getError('password');?></p>
	</small>
	<small><?php print Yii::app()->name; ?> 2014</small>
</div>