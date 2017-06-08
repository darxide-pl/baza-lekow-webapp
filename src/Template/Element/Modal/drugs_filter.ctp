<div id="filter" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="get" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= __('Filtry listy leków') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?= $this->Filter->input('search') ?>
                        <label><?= __('Substancje') ?></label>
                        <select name="filter[substances][]" class="__substances" multiple="">
                            <?php if(count($substances)):foreach($substances as $k => $v): ?>
                                <option selected="" value="<?= (int) $k ?>"><?= $v ?></option>
                            <?php endforeach;endif; ?>
                        </select>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('substances_mode') == 'every' ? 'checked=""' : '' ?> type="radio" checked="" name="filter[substances_mode]" value="every" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające WSZYSTKIE zaznaczone substancje') ?>
                            </label>
                        </div>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('substances_mode') == 'any' ? 'checked=""' : '' ?> type="radio" name="filter[substances_mode]" value="any" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające KTÓRĄKOLWIEK z zaznaczonych subtancji') ?>
                            </label>
                        </div>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('substances_mode') == 'exclude' ? 'checked=""' : '' ?> type="radio" name="filter[substances_mode]" value="exclude" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki nie zawierające ŻADNEJ z zaznaczonych substancji') ?>
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label><?= __('Specjalizacje leków') ?></label>
                        <select name="filter[specializations][]" class="__specializations" multiple="">
                            <?php if(count($specializations)):foreach($specializations as $k => $v): ?>
                                <option selected="" value="<?= (int) $k ?>"><?= $v ?></option>
                            <?php endforeach;endif; ?>
                        </select>                        
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('specializations_mode') == 'every' ? 'checked=""' : '' ?> type="radio" checked="" name="filter[specializations_mode]" value="every" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające WSZYSTKIE zaznaczone specjalizacje') ?>
                            </label>
                        </div>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('specializations_mode') == 'any' ? 'checked=""' : '' ?> type="radio"  name="filter[specializations_mode]" value="any" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające KTÓRĄKOLWIEK z zaznaczonych specjalizacji') ?>
                            </label>                            
                        </div>                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default wawes-effect" data-dismiss="modal"><?= __('Zamknij') ?></button>
                    <button type="submit" class="btn bgm-teal wawes-effect"><?= __('Filtruj') ?></button>
                </div>
            </div>            
        </form>
    </div>
</div>