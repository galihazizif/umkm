		<?php if($act == 'create'): ?>
    <div class="modal-header" style="">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    		<h4 id="myModalLabel">Penambahan Akun</h4>
    		<small>Silahkan masukkan email yang akan didaftarkan sebagai administrator untuk akun UMKM anda.</small>
  		</div>
  		<div class="modal-body">
    		<?php $form = $this->beginWidget('CActiveForm',array(
    		'id'=>'addumkmemail',
        'method'=>'POST',
        'action'=>'site/login')); ?>
        <div class="span4">
          <?php print $form->textField($model,'email',array('placeholder'=>'Email'))?>
          <?php print $form->error($model,'email',array('class'=>'cerror'))?>
        </div>
    		<div class="span4">
          <?php print $form->textField($model,'conf_email',array('placeholder'=>'Konfirmasi Email'))?>
          <?php print $form->error($model,'conf_email',array('class'=>'cerror'))?>
        </div>

        <div class="span4">
          <?php print $form->passwordField($model,'password',array('placeholder'=>'Password'))?>
          <?php print $form->error($model,'password',array('class'=>'cerror'))?>
        </div>

        <div class="span4">
          <?php print $form->passwordField($model,'conf_password',array('placeholder'=>'Konfirmasi Password'))?>
          <?php print $form->error($model,'conf_password',array('class'=>'cerror'))?>
        </div>
    		
  		</div>
  		<div class="modal-footer">
      
      <button type="button" id="xhrSubmitButton" onClick="xhrSubmitButton(this.id,this.value,this.name)" name="#addumkmemail" value="<?php print $this->createUrl('site/xaddumkmemail')?>" class="btn btn-primary">Tambahkan</button>
  		</div>

  		<?php $this->endWidget(); ?>
      <?php endif;?>
      <?php if($act == 'success'):?>
      <div class="alert alert-success"><?php print $model->email.' Berhasil ditambahkan';?></div>
      <script type="text/javascript">
        location.reload();
      </script>
      <?php endif;?>