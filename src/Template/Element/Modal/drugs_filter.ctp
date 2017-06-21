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
                        <?= $this->Filter->input('tag') ?>
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
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('specializations_mode') == 'exclude' ? 'checked=""' : '' ?> type="radio"  name="filter[specializations_mode]" value="exclude" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki nie zawierające ŻADNEJ z zaznaczonych specjalizacji') ?>
                            </label>                            
                        </div>                         
                    </div>

                    <hr>

                    <div class="form-group">
                        <label><?= __('Formy leków') ?></label>
                        <select name="filter[forms][]" class="__forms" multiple="">
                            <?php if(count($forms)):foreach($forms as $k => $v): ?>
                                <option selected="" value="<?= (int) $k ?>"><?= $v ?></option>
                            <?php endforeach;endif; ?>
                        </select>                         
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('forms_mode') == 'every' ? 'checked=""' : '' ?> type="radio" checked="" name="filter[forms_mode]" value="every" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające WSZYSTKIE zaznaczone formy') ?>
                            </label>
                        </div>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('forms_mode') == 'any' ? 'checked=""' : '' ?> type="radio" name="filter[forms_mode]" value="any" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające KTÓRĄKOLWIEK z zaznaczonych form') ?>
                            </label>
                        </div>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('forms_mode') == 'exclude' ? 'checked=""' : '' ?> type="radio" name="filter[forms_mode]" value="exclude" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki nie zawierające ŻADNEJ z zaznaczonych form') ?>
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label><?= __('Sposoby leczenia') ?></label>
                        <select name="filter[treatments][]" class="__treatments" multiple="">
                            <?php if(count($treatments)):foreach($treatments as $k => $v): ?>
                                <option selected="" value="<?= (int) $k ?>"><?= $v ?></option>
                            <?php endforeach;endif; ?>
                        </select>                        
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('treatments_mode') == 'every' ? 'checked=""' : '' ?> type="radio" checked="" name="filter[treatments_mode]" value="every" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające WSZYSTKIE zaznaczone sposobów leczenia') ?>
                            </label>
                        </div>                        
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('treatments_mode') == 'any' ? 'checked=""' : '' ?> type="radio" name="filter[treatments_mode]" value="any" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki zawierające KTÓRYKOLWIEK z zaznaczoncyh sposobów leczenia') ?>
                            </label>
                        </div>
                        <div class="radio m-b-15">
                            <label>
                                <input <?= $this->Filter->get('treatments_mode') == 'exclude' ? 'checked=""' : '' ?> type="radio" name="filter[treatments_mode]" value="exclude" />
                                <i class="input-helper"></i>
                                <?= __('Znajdź leki nie zawierające ŻADNYCH z zaznaczoncyh sposobów leczenia') ?>
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

<?= $this->start('bottom') ?>

<script src="/vendors/select2/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/vendors/select2/select2.min.css" />
<script type="text/javascript">     
$(".__substances").select2({
    tags: true,
    createTag: function(params) {
        return undefined;
    },        
    ajax: {
        url: '/select/substances',
        dataType: 'json',
        type: "GET",
        quietMillis: 200,
        data: function (term) {
            return {
                term: term
            };
        },
        success: function (data) {                    
            return data
        }
    }
});      

$(".__specializations").select2({
    tags: true,
    createTag: function(params) {
        return undefined;
    },        
    ajax: {
        url: '/select/specializations',
        dataType: 'json',
        type: "GET",
        quietMillis: 200,
        data: function (term) {
            return {
                term: term
            };
        },
        success: function (data) {                    
            return data
        }
    }
});  

$(".__forms").select2({
    tags: true,
    createTag: function(params) {
        return undefined;
    },        
    ajax: {
        url: '/select/forms',
        dataType: 'json',
        type: "GET",
        quietMillis: 200,
        data: function (term) {
            return {
                term: term
            };
        },
        success: function (data) {                    
            return data
        }
    }
});  

$(".__treatments").select2({
    tags: true,
    createTag: function(params) {
        return undefined;
    },        
    ajax: {
        url: '/select/treatments',
        dataType: 'json',
        type: "GET",
        quietMillis: 200,
        data: function (term) {
            return {
                term: term
            };
        },
        success: function (data) {                    
            return data
        }
    }
});  
</script>
<?= $this->end() ?>