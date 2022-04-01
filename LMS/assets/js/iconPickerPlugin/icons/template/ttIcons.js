window.ttIcons = (function ($) {

    let ttModal = {
        config: {
            title: 'Escolha um ícone',
            closeButton: 'Fechar',
            saveButton: 'Salvar',
            iconPickerDefaultText: 'Salvar',
            size: 'lg',
            iconList: [
                {{#shapes }}	
                    "{{name}}",
                {{/shapes}}	
                ]
        },
        getTemplate: () => `
            <div id="tt-icons-modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-${ttModal.config.size}" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">${ttModal.config.title}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <ul class="list-unstyled list-inline row">
                                    ${ttModal.config.iconList.map(icon =>
                `
                                        <li class="col-xs-2 col-md-1">
                                            <button class="btn btn-default tt-icon-modal-button" data-name="${icon}" style="height: 50px; margin-bottom: 10px;">
                                                <svg style="max-width: 100%; max-height: 100%;">
                                                    <use xlink:href="#${icon}"></use>
                                                </svg>
                                            </button>
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">${ttModal.config.closeButton}</button>
                            <button id="tt-modal-save" type="button" class="btn btn-primary" data-dismiss="modal">${ttModal.config.saveButton}</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        `,
        el: {
            init: () => {
                ttModal.el.modal = $('#tt-icons-modal');
                ttModal.el.pickerBtns = $('.tt-icon-modal-button');
                ttModal.el.saveBtn = $('#tt-modal-save');
                ttModal.el.iconPicker = $('.tt-icon-picker');
            }
        },
        init: () => {
            ttModal.create();
        },
        create: () => {
            ttModal.el.template = ttModal.getTemplate();
            $('body').append(ttModal.el.template);
            ttModal.el.init();
            ttModal.createListeners();
            ttModal.addDefaultBtnText();
        },
        createListeners: () => {
            ttModal.el.pickerBtns.click(ttModal.onIconClick);
            ttModal.el.saveBtn.click(ttModal.onSave);
            ttModal.el.iconPicker.click(ttModal.onOpen);
        },
        addDefaultBtnText: () => {
            ttModal.el.iconPicker.each(
                (i, btn) => {
                    let button = $(btn);
                    if(!button.html()){
                        button.html('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ícone');
                    }
                }
            )
        },
        onIconClick: (event) => {

            let el = $(event.target.closest('.tt-icon-modal-button'));
            ttModal.el.pickerBtns.removeClass('active');

            ttModal.currentSelection = el.data('name');
            el.addClass('active');
        },
        onOpen: (event) => {
            ttModal.el.currentButton = $(event.target.closest('.tt-icon-picker'));
            ttModal.el.currentInput = $('#' + ttModal.el.currentButton.data('controls'));
            ttModal.el.modal.modal('show');
        },
        onSave: () => {
            ttModal.save(ttModal.currentSelection)
        },
        save: (icon) => {
            ttModal.el.currentInput.val(icon);
            ttModal.el.currentButton.html(`
            <svg style="max-width: 100%; max-height: 100%;">
                <use xlink:href="#${icon}"></use>
            </svg>
            `)
        }
    }


    let ttIcons = {
        init: () => {
            ttModal.init();
            ttIcons.appendIconLibrary();
            ttIcons.loadPreviousSelection();
        },
        el: {
            iconLibrary: $('<div>').addClass('tt-icon-library hidden'),
            body: $('body'),
            svgIcons: `
            <svg>
                {{#shapes}} {{{svg}}} {{/shapes}}
            </svg>
        `
        },
        appendIconLibrary: () => {
            ttIcons.el.body.append(ttIcons.el.iconLibrary);
            $(ttIcons.el.svgIcons).appendTo(ttIcons.el.iconLibrary)
        },
        loadPreviousSelection: () => {
            ttModal.el.iconPicker.each( (i, btn) => {
                let button = $(btn);
                let input = $('#' + button.data('controls'));
                let icon = input.val();
                if (icon) {
                    ttModal.el.currentButton = button;
                    ttModal.el.currentInput = input;
                    ttModal.save(icon);
                }
            });
        }
    }

    $(document).ready(() => {
        ttIcons.init();
    });

    return {
        ttModal: ttModal,
        ttIcons: ttIcons
    }

}(jQuery));

