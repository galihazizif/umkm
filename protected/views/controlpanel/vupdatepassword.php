<?php if($act == 'form'):?>
<div class="modal-header" style="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 id="myModalLabel">Ubah Password</h4>
      </div>
<div class="modal-body">
<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'password-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation'=>false,
)); ?>
<div class="span4">
  <?php print $form->passwordField($model,'password',array('placeholder'=>'Password Baru')) ?>
  <?php print $form->error($model,'password',array('class'=>'cerror')) ?>
</div>
<div class="span4">
  <?php print $form->passwordField($model,'conf_password',array('placeholder'=>'Konfirmasi Password Baru')) ?>
  <?php print $form->error($model,'conf_password',array('class'=>'cerror')) ?>
</div>

<?php $this->endWidget(); ?>
</div>
<div class="modal-footer">
      <button type="button" id="xhrSubmitButton" onClick="xhrSubmitButton(this.id,this.value,this.name)" name="#password-form" value="<?php print $this->createUrl($this->getRoute())?>" class="btn btn-primary">Simpan</button>
</div>
<?php endif;?>

<?php if($act == 'success'):?>
      <div class="alert alert-success">Password diubah.</div>
      <script type="text/javascript">
        location.reload();
      </script>
<?php endif;?>