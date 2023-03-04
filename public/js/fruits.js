$(document).ready(() => {
    let currentFruitId = null;

    const [favoriteModal, removeFavoriteModal] = [$("#favoriteModal"), $("#removeFavoriteModal")];

    $('.favoriteButton').on('click', e => {
        e.preventDefault();

        const self = $(e.currentTarget);

        currentFruitId = parseInt(self.data('id'));

        $('#favoriteId').val(currentFruitId)
    });

    $('.removeFavoriteButton').on('click', e => {
        e.preventDefault();

        const self = $(e.currentTarget);

        currentFruitId = parseInt(self.data('id'));

        $('#removeFavoriteId').val(currentFruitId)
    });

    $('#fruit-add-favorites-form, #remove-favorites-form').on('submit', e => {
        e.preventDefault();

        const self = $(e.currentTarget);

        const isRemoveAction = self.attr('id') === 'remove-favorites-form';

        const activeModal = isRemoveAction ? removeFavoriteModal : favoriteModal;

        $.ajax({
            url: self.attr('action'),
            type: self.find("[name='_method']").val(),
            dataType: 'json',
            data: self.serializeArray(),
            success({success, is_max_reached, message}) {
                if (!success) {
                    alert(is_max_reached && message ? message : "Oops! something went wrong.");

                    activeModal.modal('hide');

                    return false;
                }

                if (isRemoveAction) {
                    $(`.favoriteButton[data-id="${currentFruitId}"]`).show();
                    $(`.removeFavoriteButton[data-id="${currentFruitId}"]`).hide();
                } else {
                    $(`.favoriteButton[data-id="${currentFruitId}"]`).hide();
                    $(`.removeFavoriteButton[data-id="${currentFruitId}"]`).show();
                }

                activeModal.modal('hide');
            },
            error() {
                activeModal.modal('hide');

                alert("Oops! something went wrong.");
            }
        });
    });
});
