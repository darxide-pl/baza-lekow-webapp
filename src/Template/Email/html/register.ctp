<div class="item">
	<h2><?= __('Dziękujemy za rejestracje w serwisie baza-lekow.dariuszm.pl') ?></h2>
	<p>
		<?= __('Poniżej znajduje się link potwierdzający rejestrację. Jeżeli dostałeś ten email przez pomyłkę, prosimy o kontakt z administratorem _@t.pl') ?>
	</p>
	<p>
		<a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'confirm', $user->activator], true) ?>">
			<?= __('Potwierdź rejestrację') ?>
		</a>
	</p>
</div>