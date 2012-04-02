<?php echo $this->Form->create('Newslettersqueue', array('class'=>'mws-form', 'id'=>'form_contentpost','type' => 'file')) ?>
	<div class="mws-panel grid_8 pages">
		<div class="mws-panel-header">
	    	<span class="mws-i-24 i-list">Adicionar nova página</span>
	    </div>
	    <div class="mws-panel-body">
			<div class="mws-form-inline">
			<?php
				if($this->action == 'edit') echo $this->Form->hidden('id', array('value'=>$this->Form->value('Newsletterqueue.id')));

				echo $this->Form->input('subject', array('type'=>'text', 'label' => array('text'=>'Assunto *'), 'div'=>array('class'=>'mws-form-row'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=>(isset($sessao_formulario['Newsletterqueue']['subject']) ? $sessao_formulario['Newsletterqueue']['subject'] : $this->Form->value('Newsletterqueue.subject') ) ));

				echo $this->Form->input('emailbody', array('type'=>'textarea', 'label' => array('text'=>'Conteúdo *'), 'div'=>array('class'=>'mws-form-row ckeditor'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'value'=>(isset($sessao_formulario['Newsletterqueue']['emailbody']) ? $sessao_formulario['Newsletterqueue']['emailbody'] : $this->Form->value('Newsletterqueue.emailbody') ) ));
			?>
			<div class="mws-form-row notice">Todos os campos marcados com <span style="color:red">*</span> são de preenchimento obrigatório.</div>
			<?php 
				// if($this->action == 'add') echo '<div class="mws-form-row notice">Para incluir um documento anexo à página, é necessário cadastrá-la primeiramente.</div>';
			?>

    		</div>
    		<div class="mws-button-row">
    		<?php
    			// echo $this->action == 'edit' ? $this->Form->postLink(__('Deletar esta newsletter'), array('action' => 'delete', $this->Form->value('Newsletterqueue.id')), array('id'=>'del-'.$this->Form->value('Newsletterqueue.id'),'class'=>'mws-button red small fl'), __('Tem certeza que deseja excluir a Página # %s?', $this->Form->value('Newsletterqueue.slug'))) : '';

				echo $this->Html->link(__('Ver todas as Newsletters', true), array('action' => 'index'),array('class'=>'mws-button gray small fl'));

				echo $this->action == 'edit' ? '<span class="notice mr20">Publicado <strong><time datetime="'. $this->Form->value('Newsletterqueue.created') .'">'. getTimeAgo($this->Form->value('Newsletterqueue.created')) .'</time></strong></span>' : '';

				echo $this->action == 'add' ? '<input type="submit" value="Cadastrar" class="mws-button blue" />' : '<input type="submit" value="Atualizar" class="mws-button blue" />';
    		?>
    		</div>
    </div>    	
</div>
<?php echo $this->Form->end();?>





