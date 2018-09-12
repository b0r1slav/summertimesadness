/**
 * Extends String constructor
 *
 * Replace all matched
 *
 * @param {object} obj
 * @returns {String}
 */
String.prototype.allReplace = function(obj) {
    let str = this;

    Object.keys(obj).forEach(function (key) {
        str = str.replace(new RegExp(key, 'g'), obj[key]);
    });

    return str;
};

/**
 * Get form inputs
 *
 * @param {object} resource
 * @returns {object}
 */
function getInputs(resource) {
    let inputData = {};
    //get all inputs in the form
    $(resource.form).find('input[name]').each(function (index, element) {
        //merge input data into an object
        inputData[element.name] = element.value;
    });
    //get the active user session token
    inputData['_token'] = $('meta[name=csrf-token]').attr('content');

    return {data: inputData, form: resource.form, rules: resource.rules};
}

/**
 * Get single input
 *
 * @param resource
 * @returns {Promise}
 */
function getInput(resource) {

    return new Promise(function (resolve) {
        resolve({
            data: {
                [resource.input.name]: resource.input.value,
                _method: 'PUT',
                _token: $('meta[name=csrf-token]').attr('content')
            },
            input: resource.input,
            rules: resource.rules})
    });
}

/**
 * Create new resource
 *
 * @param {object} resource
 */
function saveResource(resource) {

    return $.ajax({
        type: "POST",
        url: resource.form.action,
        data: resource.data
    }).done(function (msg) {
        renderNotification('success', msg, resource.form)
    }).fail(function () {
        renderNotification('error')
    });
}

/**
 * Remove the specified resource
 *
 * @param {object} resource
 */
function deleteResource(resource) {

    return $.ajax({
        type: "POST",
        url: resource.form.action,
        data: resource.data
    }).done(function (msg) {
        renderNotification('success', msg);
    }).fail(function () {
        renderNotification('error')
    });
}

/**
 *
 * @param tableInit
 * @param rowsCount
 */
function reloadDataTable(tableInit, rowsCount) {

    if(rowsCount < 2) {
        return tableInit.page('previous').draw('page');
    }

    return tableInit.draw(false);
}

/**
 *
 * @param notice
 * @param msg
 * @param form
 */
function renderNotification(notice, msg, form) {
    if (notice === 'success') {
        if (msg.indexOf('alert-success') > -1) {
            //clean the input after success
            if (form) {
                $(form).find('input:not(:hidden)').val('');
            }
            $("#notifications").html(msg);
        } else if(msg.indexOf('alert-danger') > -1) {
            $("#notifications").html(msg);
        }
    } else {
        $("#notifications").text('Oops! Something went wrong. Please try again.');
    }
}

/**
 * Change resource status
 *
 * @param {object} input
 * @returns {number}
 */
function changeStatus(input) {
    let status = 0;
    if ($(input).is(":checked")) {
        status = 1;
    }

    return status;
}

/**
 * Update single field
 * 
 * @param resource
 * @returns {Promise}
 */
function updateSingleResource(resource) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: resource.input.dataset.href,
            data: resource.data
        }).done(function (response) {
            
            resolve({response: response, resource: resource});
            
        }).error(function (response) {
            
            if (response.status === 422) {
                reject([{message: response.responseJSON.errors.name[0]}])
            } else {
                $("#notifications").text('Oops! Something went wrong. Please try again.');
            }
        });

    });
}