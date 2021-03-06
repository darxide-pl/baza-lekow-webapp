 ;+function() {

    $(document).on('click' , '.btn-action' , function(e) {
        actions[$(this).data('controller')][$(this).data('action')](e)
    })

    $(document).on('click' , '.confirm' , function(e) {
        e.preventDefault()
        e.stopImmediatePropagation()
        let self = $(this)

        if(self.data('action') === undefined) {
            swal({
                title : 'uwaga',
                text : self.data('confirm'),
                showCancelButton : true
            }, function(confirm) {
                if(confirm) {
                    window.location = self.attr('href')
                }
            })      
        } else {
            swal({
                title : 'uwaga',
                text : self.data('confirm'),
                showCancelButton : true
            } , function(confirm) {
                if(confirm) {
                    let controller = self.data('controller') 
                    let action = self.data('action')
                    actions[controller][action](e)
                }
            })
        }

        return false
    })

 }();

const actions = {

    substances : {

        filter_every : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[substances][]', function(form) {
                form.append('<input type="hidden" name="filter[substances_mode]" value="every" />')
            })
        }, 

        filter_any : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[substances][]', function(form) {
                form.append('<input type="hidden" name="filter[substances_mode]" value="any" />')
            })            
        }, 

        filter_exclude : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[substances][]', function(form) {
                form.append('<input type="hidden" name="filter[substances_mode]" value="exclude" />')
            })            
        }

    },

    forms : {

        filter_every : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[forms][]', function(form) {
                form.append('<input type="hidden" name="filter[forms_mode]" value="every" />')
            })
        }, 

        filter_any : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[forms][]', function(form) {
                form.append('<input type="hidden" name="filter[forms_mode]" value="any" />')
            })            
        }, 

        filter_exclude : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[forms][]', function(form) {
                form.append('<input type="hidden" name="filter[forms_mode]" value="exclude" />')
            })            
        }

    },

    specializations : {

        filter_every : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[specializations][]', function(form) {
                form.append('<input type="hidden" name="filter[specializations_mode]" value="every" />')
            })
        }, 

        filter_any : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[specializations][]', function(form) {
                form.append('<input type="hidden" name="filter[specializations_mode]" value="any" />')
            })            
        }, 

        filter_exclude : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[specializations][]', function(form) {
                form.append('<input type="hidden" name="filter[specializations_mode]" value="exclude" />')
            })            
        }

    },

    treatments : {

        filter_every : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[treatments][]', function(form) {
                form.append('<input type="hidden" name="filter[treatments_mode]" value="every" />')
            })
        }, 

        filter_any : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[treatments][]', function(form) {
                form.append('<input type="hidden" name="filter[treatments_mode]" value="any" />')
            })            
        }, 

        filter_exclude : function(e) {
            actions.helper.bulk_form('/' , '.__check:checked' , 'filter[treatments][]', function(form) {
                form.append('<input type="hidden" name="filter[treatments_mode]" value="exclude" />')
            })            
        }        

    },

    drugs : {

        follow : function(e) {
            let item = $(e.currentTarget)
            $.post('/drugs/follow' , {
                id : item.data('id')
            }).done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    item
                        .data('action' , 'unfollow')
                        .text('Nie powiadamiaj o aktualizacji')
                }
            })
        }, 

        unfollow : function(e) {
            let item = $(e.currentTarget)
            $.post('/drugs/unfollow' , {
                id : item.data('id')
            }).done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    item
                        .data('action', 'follow')
                        .text('Powiadom o aktualizacji')
                }
            })
        }, 

        removeFollow : function(e) {
            let item = $(e.currentTarget)
            $.post('/drugs/remove-follow' , {
                id : item.data('id')
            }).done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.success != 'undefined') {
                    item
                        .closest('.list-group-item')
                        .fadeOut(240 , function() {
                            $(this).remove()
                        })
                }
            })
        }, 

        bulkFollow : function() {

            let checked = $('.bulk-action:checked')

            if(!checked.length) {
                return flash.error('Nie zaznaczono żadnych leków do śledzenia')
            }

            $.post('/drugs/bulk-follow' ,{
                items : $.map(checked , function(item) {
                    return $(item).val()
                })
            }).done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    $.map(checked , function(item) {
                        let v = $(item).val()
                        $('[data-action="follow"][data-id="'+v+'"]')
                            .data('action' , 'unfollow')
                            .text('Nie powiadamiaj o aktualizacji')
                    })
                }
            })

        }

    },

    comments : {

        markAsRead : function(e) {
            e.preventDefault()
            e.stopImmediatePropagation()
            let item = $(e.currentTarget)

            $.post('/notifications/mark-as-read/'+item.data('id'))
            .done(function(data) {
                let response = JSON.parse(data) 
                if(typeof response.error == 'undefined') {
                    $('.notify-comment[data-id="'+item.data('id')+'"]')
                        .fadeOut(240 , function() {
                            $(this).remove()
                        })
                    actions.comments.bell()
                }
            })
        },

        readAll : function(e) {
            $.post('/notifications/read-all-comments')
            .done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    $('.notify-comment')
                        .fadeOut(240, function() {
                            $(this).remove()
                        })
                    actions.comments.bell()
                }
            })
        }, 

        bell : function() {
            setTimeout(function() {
                if(!$('.notify-comment').length) {
                    $('[data-user-alert="sua-messages"]').removeClass('active')
                }
            }, 300)
        }

    },

    news : {

        markAsRead : function(e) {
            e.preventDefault()
            e.stopImmediatePropagation()
            let item = $(e.currentTarget)

            $.post('/notifications/mark-as-read/'+item.data('id'))
            .done(function(data) {
                let response = JSON.parse(data) 
                if(typeof response.error == 'undefined') {
                    $('.notify-drug[data-id="'+item.data('id')+'"]')
                        .fadeOut(240 , function() {
                            $(this).remove()
                        })
                    actions.news.bell()
                }
            })            
        }, 

        readAll : function(e) {
            $.post('/notifications/read-all-drugs')
            .done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    $('.notify-drug')
                        .fadeOut(240, function() {
                            $(this).remove()
                        })
                    actions.news.bell()
                }
            })
        },

        bell : function() {
             setTimeout(function() {
                if(!$('.notify-drug').length) {
                    $('[data-user-alert="sua-notifications"]').removeClass('active')
                }
            }, 300)           
        }

    },

    notifications : {

        delete : function(e) {
            let item = $(e.currentTarget)
            $.post('/notifications/delete/'+item.data('id'))
            .done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    item
                        .closest('.col-md-4')
                        .fadeOut(240 , function() {
                            $(this).remove()
                        })

                    $('.notify-comment[data-id="'+item.data('id')+'"]').remove()
                    $('.notify-drug[data-id="'+item.data('id')+'"]').remove()
                    actions.comments.bell()
                    actions.news.bell()
                }
            })
        }, 

        deleteAll : function() {
            $.post('/notifications/delete-all')
            .done(function(data) {
                let response = JSON.parse(data)
                if(typeof response.error == 'undefined') {
                    $('.category-item')
                        .closest('.col-md-4')
                        .fadeOut(240 , function() {
                            $(this).remove()
                        })
                    $('.notify-comment').remove()
                    $('.notify-drug').remove()
                    actions.comments.bell()
                    actions.news.bell()                    
                }
            })
        }

    },

    helper : {
        /**
         *  create and submit bulk form
         *  @param string $action - action link compatible with cake Router::url()
         *  @patam string $selector - selector for matching input
         *  @patam string name - name of created form hidden inputs
         *  @param function $callable - callback for extra operations
         */
        bulk_form : function(action, selector, name , callable = false) {
            let id = 'form_'+actions.helper.rand() 
            form = $('<form />')
            form.prop('id' , id)
            form.prop('action' , action)
            form.prop('method', 'get')

            $(selector).each(function() {
                let input = $('<input />')  
                input.prop('type' , 'hidden')
                input.prop('name' , name)
                input.val($(this).val())

                form.append(input)

            })

            if(typeof callable === 'function') {
                callable(form)
            }

            $('body').append(form)
            form.submit()
        },         

        rand : function() {
            return Math.round(Math.random() * 1000000)
        },         
    }
}

const flash = {
    success : function(msg) {
        $.growl({
            message:msg
        },{
            allow_dismiss: true,
            'placement':{
                from:'bottom',
                align:'left'
            }
        })  
    }, 

    error : function(msg) {
        $.growl({
            message:msg
        },{
            type:'danger',
            allow_dismiss: true,
            'placement':{
                from:'bottom',
                align:'left'
            }
        })  
    }, 

    auto : function() {
        $( document ).ajaxComplete(function( event, xhr, settings ) {
            try {
                let response = JSON.parse(xhr.responseText)
                flash.parse(response)
            } catch(Exception) {
                console.log('Cant read input as JSON')
            }
        })  

        $( document ).ajaxError(function( event, request, settings ) {
            if (request.statusText =='abort') {
                return;
            }           
            flash.error('Server fault')
        })
    }, 

    parse : function(response) {
        if(typeof response.error !== 'undefined') {
            flash.error(response.error)
        }

        if(typeof response.success !== 'undefined') {
            flash.success(response.success)
        }       
    }
}

flash.auto()