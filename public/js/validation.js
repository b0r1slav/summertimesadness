/**
 * Validate resource according to the given rules
 *
 * @constructor
 */
function Validator() {
    const self = this;

    if (typeof new.target === "undefined") {
        throw new Error("Constructor must be called with new.");
    }

    /**
     * Check if the input is not empty
     *
     * @param name
     * @param value
     * @returns {object}
     */
    Validator.prototype.required = function (name, value) {

        if ( !value ) {

            return { error: 'required', input: name, message: "The " + name + " field is required." };
        }

    };

    /**
     * Check if the input is number
     *
     * @param name
     * @param value
     * @returns {object}
     */
    Validator.prototype.numeric = function (name, value) {

        if ( value && !isNumeric(value) ) {

            return { error: 'numeric', input: name, message: "The " + name + " must be a number." };
        }

    };

    /**
     * Check if the input is string
     *
     * @param name
     * @param value
     * @returns {object}
     */
    Validator.prototype.string = function (name, value) {

        if ( value && typeof value !== 'string') {

            return { error: 'string', input: name, message: "The " + name + " must be a string." };
        }

    };

    /**
     * Check if the input is a valid email
     *
     * @param name
     * @param value
     * @returns {object}
     */
    Validator.prototype.email = function (name, value) {

        let re = new RegExp('^(([^<>()\\[\\]\\\\.,;:\\s@"]+(\\.[^<>()\\[\\]\\\\.,;:\\s@"]+)*)|(".+"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$');

        if ( value && !re.test(value)) {

            return { error: 'email', input: name, message: "Please provide a valid email address." };
        }

    };

    /**
     * Check the input for minimum characters
     *
     * @param name
     * @param value
     * @param length
     * @returns {object}
     */
    Validator.prototype.min = function (name, value, length) {

        if ( value && value.length < length ) {

            return { error: 'min', input: name, message: "The " + name + " must be at least " + length + " characters." };
        }
    };

    /**
     * Check the input for maximum characters
     *
     * @param name
     * @param value
     * @param length
     * @returns {object}
     */
    Validator.prototype.max = function (name, value, length) {

        if ( value && value.length > length ) {

            return { error: 'max', input: name, message: "The " + name + " must be maximum " + length + " characters." };
        }
    };

    /**
     * Trigger the validation methods
     *
     * @param request
     * @param rules
     * @returns {Array.<*>}
     */
    Validator.prototype.make = function (request, rules) {

        if (typeof new.target !== "undefined") {
            throw new Error("Method cannot be called with new.");
        }

        let errors = [];
        let re = new RegExp(':');

        Object.keys(rules).forEach(function (key) {
            rules[key].split('|').forEach(function (func) {
                if ( re.test(func) ) {
                    let f = func.split(':');
                    errors.push( self[f[0]]( key, request[key].trim(), f[1] ) );
                } else {
                    errors.push( self[func]( key, request[key].trim() ) );
                }
            });
        });

        return errors.filter(function (i) {  return i !== undefined; } );
    };
}

/**
 * Validate the given resource
 *
 * @param resource
 * @returns {*}
 */
function validate(resource) {

    const validator = new Validator();

    let errors = validator.make(resource.data, resource.rules);

    $('div.error').remove();

    if (errors.length > 0) {
        throw errors;
    }

    return resource;
}

/**
 * Display the errors in the form
 *
 * @param errors
 * @param form
 */
function displayErrors(errors, form) {

    errors.forEach(function (error) {
        $(form).find("input[name=" + error.input + "]")
            .after('<div style="color: red" class="error"><strong>' + error.message + '</strong></div>');
    });
}

/**
 * Display the error after the given input
 *
 * @param errors
 * @param input
 */
function displayError(errors, input) {

    errors.forEach(function (error) {
        $(input).after('<div style="color: red" class="error"><strong>' + error.message + '</strong></div>');
    });
}

function isNumeric(obj) {
    return !isNaN( parseFloat(obj) ) && isFinite( obj );
}