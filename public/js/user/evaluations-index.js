(function () {

    //get user token
    const _token = $('meta[name=csrf-token]').attr('content');


    (function(){
        getPendingApproval();
        getDailyTasks();
    })();


    //hide popover
    $(document).on('click', 'button[data-value="dismiss"]', function() {

        $('span[data-value="pending"]').popover('hide');

    });


    //delete points approvement
    function deletePoints(id, status) {
        
        let action = window.location.origin + '/points-approvement/' + id;
        let data = {_token: _token, _method: 'DELETE', status: status};

        Promise.resolve({data: data, form:{action: action}})
            .then(deleteResource)
            .then(getPendingApproval)
        
    }


    function deletePendingApproval(id, status) {

        //unhook the event
        $(document).off('click', 'button[data-value="confirm"]');

        $(document).on('click', 'button[data-value="confirm"]', function () {
            
            deletePoints(id, status);
            
        });

    }


    //get daily tasks via ajax call
    function getDailyTasks() {

        $.ajax({
            type: "GET",
            url: window.location.origin + '/tasks/data'
        }).done(function (data) {

            renderDailyTasks(data);

        })

    }


    //get pending approval via ajax call
    function getPendingApproval() {

        $.ajax({
            type: "GET",
            url: window.location.origin + '/points-approvement/data'
        }).done(function (data) {

            renderPendingApproval(data);

        })

    }


    //render evaluations grid
    const evaluationsDataTable = $('#evaluations').DataTable({
        serverSide: true,
        responsive: true,
        ajax: window.location.origin + '/evaluations/data',
        columnDefs: [
            { "width": "5%", "targets": [2,3,4] }
        ],
        columns: [
            {title: 'id', data: 'id', visible: false},
            {title: 'title', data: 'title', name: 'title'},
            {title: 'must', data: 'must', name: 'must'},
            {title: 'current', data: 'current', name: 'current'},
            {title: 'add points', data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


    //hide modal
    function hideModal(modal) {

        $(modal).modal('hide');

    }


    //returns the title and the content of the popover
    function popoverContent() {

        let title = 'This will permanently delete your points! Are you sure want to proceed?';

        //get the content from template
        let content = $('#popoverContent').html();

        return {title: title, content: content};
    }


    function removePoints() {

        $('span[data-value="pending"]').on('show.bs.popover', function () {

            deletePendingApproval(this.id, this.dataset.value);

        });

        $('span[data-value="approved"], span[data-value="refused"]').on('click', function () {

            deletePoints(this.id, this.dataset.value);

        });

    }


    /**
     * Returns validation rules
     *
     * @returns {object}
     */
    function rules() {
        return {
            points: 'required|numeric'
        };
    }


    //render pending approval grid
    function renderPendingApproval(data) {

        let tableBody = $('table#pa-table tbody');
        let template = $('#pa-row').html();

        $(tableBody).html('');

        if (data.length > 0) {

            data.forEach(function (pa) {

                let templateKeys = {
                    '#id#': pa.id,
                    '#paDate#': new Date(pa.pa_date).toDateString(),
                    '#points#': pa.points,
                    '#title#': pa.title,
                    '#status#': pa.status
                };

                $(tableBody).prepend(template.allReplace(templateKeys));

            });

            renderPopover();

            removePoints();

        } else {

            $(tableBody).html('<tr><td class="pending">there are no approval points</td></tr>');

        }
    }


    //render daily tasks grid
    function renderDailyTasks(data) {

        let tableBody = $('table#daily-tasks-table tbody');
        let template = $('#daily-tasks-row').html();

        $(tableBody).html('');

        if (data.length > 0) {

            data.forEach(function (dt) {

                let templateKeys = {
                    '#name#': dt.name
                };

                $(tableBody).prepend(template.allReplace(templateKeys));

            });

        } else {

            $(tableBody).html('<tr><td class="pending">there are no daily tasks</td></tr>');

        }
    }


    //render popover
    function renderPopover() {

        let popoverFilling = popoverContent();

        //popover init
        $('span[data-value="pending"]').popover({
            trigger: 'manual',
            html: true,
            placement: 'left',
            title: popoverFilling.title,
            content: popoverFilling.content
        });

        //trigger the popover
        $(document).on('click', 'span[data-value="pending"]', function () {

            $(this).popover('show');

        });

    }


    //do some things when the modal is displayed
    $('#modal-add-points').on('show.bs.modal', function (e) {
        let modal = $(this);
        let {context:{dataset:{title, value}}} = $(e.relatedTarget);// Button that triggered the modal

        modal.find('h5').text(title);
        modal.find('input[name=evaluation_id]').val(value);

        $('#btn-add-points').off().on('click', function () {
            let form = document.getElementById('form-add-points');

            Promise.resolve({form: form, rules: rules()})
                .then(getInputs)
                .then(validate)
                .then(saveResource)
                .then(hideModal.bind(null, modal))
                .then(getPendingApproval)
                .catch(function (errors) {
                    displayErrors(errors, form)
                });
        });
    });

})();