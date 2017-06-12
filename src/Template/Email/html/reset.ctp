<div class="item">
	<h2><?= __('Reset hasła w serwisie baza-lekow.dariuszm.pl') ?></h2>
	<p>
		<?= __('Poniżej znajduje się link do formularza resetującego hasło. Jeżeli dostałeś ten email przez pomyłkę, prosimy o kontakt z administratorem _@t.pl') ?>
	</p>
	<p>
		<a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reset', $user->reset_hash], true) ?>">
			<?= __('Resetuj hasło') ?>
		</a>
	</p>
</div>