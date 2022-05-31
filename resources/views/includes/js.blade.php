<script type="text/javascript">

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
        }
    });

    /*
    * Replace custom modal title
    */
    function modalTitle(title) {
        jQuery('#modal-title-custom').html(title);
    }

    /*
    * Showing custom modal
    */
    function showModal() {
        jQuery('#modal-footer-custom').html(``);
        jQuery('#openModalButton').trigger('click');
    }

    /*
    * Hide custom modal
    */
    function hideModal() {
        jQuery('#exampleModal').modal('hide');
    }

    /*
    * Load spinner
    */
    function spinnerLoading() {
        return `
            <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="sr-only">Loading...</span>
            </div>
        `;
    }

    /*
    * Load modal content
    */
    function loadModalContent() {
        modalBody(`
            <div class="row">
                <div class="col-md-12">
                    <center>
                        ${spinnerLoading()}
                    </center>
                </div>
            </div>
        `);
    }

    /*
    * Replace custom modal content
    */
    function modalBody(content) {
        jQuery('#modal-body-custom').html(content);
    }

    /*
    * Replace modal footer
    */
    function modalFooter(param) {

        var closeButton = `
            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
        `,
        modalFooter = jQuery('#modal-footer-custom');

        if(typeof param === 'string'){
            modalFooter.html(`${param} ${closeButton}`)
            return;
        }

        if(param.submit_button == undefined) {
            modalFooter.html(closeButton);
            return;
        }

        if(param.submit_button) {
            var button_text = 'Yes / Save / Send';

            if(typeof param.button_text == 'string') {
                button_text = param.button_text;
            }

            modalFooter.html(`
                <button type="button" class="btn btn-primary" id="modalSubmitButton">
                    <i class="fa fa-save"></i>&nbsp;${button_text}
                </button>
                ${closeButton}
            `);
            return;
        }

        modalFooter.html(closeButton);
    }

    /*
    * Open modal
    */
    function openModal(title, url, actionButton) {

        showModal();
        modalTitle(title);

        jQuery.ajax({
            url : url,
            dataType : 'json',
            beforeSend : function() {
                loadModalContent();
            },
            success : function(response) {

                if(response.error) {
                    hideModal();
                    return;
                }

                setTimeout(function() {
                    if(actionButton != undefined) {
                        modalFooter(actionButton);
                    }
                    modalBody(response.data.body);
                }, 800);
            },
            error : function(err) {
                var response = err.responseJSON;

                if(response.data != undefined) {
                    return modalBody(response.data.body);
                }

                setTimeout(function() {
                    hideModal();
                }, 500);

            }
        });
    }

    /*
    * Multiple find element for modal
    */
    function findElementInputId(formElement, _class = 'default') {

        if(_class == 'success') {
            var borderInput = 'form-control is-valid';
        } else if(_class == 'error') {
            var borderInput = 'form-control is-invalid';
        } else {
            var borderInput = 'form-control';
        }

        var inputs = formElement.find('input');
        if(inputs.length > 0) {
            for(var i = 0; i < inputs.length;) {
                if(inputs[i].id != '') {
                    var input = jQuery('#' + inputs[i].id);
                    if(input.attr('type') != 'checkbox' && input.attr('type') != 'radio') {
                        jQuery('#' + inputs[i].id).attr('class', borderInput);
                    }
                }
                i++;
            }
        }

        var textareas = formElement.find('textarea');
        if(textareas.length > 0) {
            for(var n = 0; n < textareas.length;) {
                if(textareas[n].id != '') {
                    jQuery('#' + textareas[n].id).attr('class', borderInput);
                }
                n++;
            }
        }

        var selects = formElement.find('select');
        if(selects.length > 0) {
            for(var x = 0; x < selects.length;) {
                if(selects[x].id != '') {
                    jQuery('#' + selects[x].id).attr('class', borderInput);
                }
                x++;
            }
        }
    }

    /*
    * Multiple find element for modal error input when requests
    */
    function errorElementInputId(formElement, err) {
        var f = formElement.find('div[class="invalid-feedback"]');
        for(var i = 0; i < f.length;) {
            var el = f[i].attributes['1'].nodeValue;
            if(err.responseJSON.errors[f[i].attributes['1'].nodeValue] != undefined) {
                jQuery('#' + el).attr('class', 'form-control is-invalid');
                jQuery(`div[data-error="${el}"]`).html(err.responseJSON.errors[f[i].attributes['1'].nodeValue][0]);
                jQuery(`div[data-error="${el}"]`).show();
            }
            i++;
        }
    }

    /*
    * Multiple submit
    */
    jQuery(document.body).on('click','#modalSubmitButton', function() {

        var modalSubmitButton = jQuery('#modalSubmitButton'),
            url = jQuery('#url').val(),
            method = jQuery('#method').val(),
            formElement = jQuery('.modalForm');

        jQuery.ajax({
            url : url,
            method : method,
            data : formElement.serialize(),
            beforeSend : function() {
                findElementInputId(formElement,'default');
                modalSubmitButton.attr('disabled','disabled');
            },
            success : function(response) {

                findElementInputId(formElement,'success');

                setTimeout(function() {
                    hideModal();
                }, 800);

                try {
                    filterTable();
                } catch(e) {

                }

                if (response.is_redirect) {
                    redirectTo(response.is_redirect);
                }

                modalSubmitButton.removeAttr('disabled');
            },
            error : function(err) {

                modalSubmitButton.removeAttr('disabled');

                findElementInputId(formElement,'success');
                formElement.find('div.invalid-feedback').hide();
                errorElementInputId(formElement, err);
            }
        });
    });

</script>