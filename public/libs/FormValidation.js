class FormValidation {
    form = null;
    validators = [];
    checked = true;
    errors = {};

    /**
     * create one FormValidation
     * @param {string} formId id of tag form
     */
    constructor(formId) {
        this.formId = formId;
    }

    /**
     * @param {Validator} validator 
     */
    addValidator(validator) {
        this.validators.push(validator);
    }

    /**
     * @param {Array<Validator>} validator 
     */
    addValidators(validators) {
        this.validators = this.validators.concat(validators);
    }

    check() {
        this.errors = {};
        this.checked = true;
        for (let entry of this.validators) {
            if (!entry.isValidated()) {
                if (this.errors[entry.name] === undefined) this.errors[entry.name] = {};
                this.errors[entry.name][entry.validatorName] = entry["message"];
                this.checked = false;
            }
        }
    }
}

class Validator {
    validation = null;
    dom = null;

    /**
     * create a validator
     * @param {string} validatorName 
     * @param {string} name 
     * @param {string} [message = ""] message 
     * @param {Func} [validation = null] validation 
     */
    constructor(validatorName, name, message = "", validation = null) {
        this.validatorName = validatorName;
        this.name = name;
        this.message = message;
        this.validation = validation;
    }

    isValidated() {
        if (this.validation !== null) return this.validation;
        return true;
    }
}

class RequiredValidator extends Validator {
    /**
     * create a RequiredValidator
     * @param {string} name 
     * @param {string} [message = ""] message 
     */
    constructor(name, message) {
        super("required", name, message);
    }

    isValidated() {
        this.dom = document.querySelector("[name='" + this.name + "']");
        if (["", null].includes(this.dom.value)) return false;
        return true;
    }
}

class MaxLengthValidator extends Validator {
    /**
     * create a MaxLengthValidator
     * @param {string} name 
     * @param {number} number
     * @param {string} [message = ""] message 
     */
    constructor(name, number, message) {
        super("maxlength", name, message);
        this.number = number;
    }

    isValidated() {
        this.dom = document.querySelector("[name='" + this.name + "']");
        if (this.dom.value === null) return false;
        if (String(this.dom.value).length > this.number) return false;
        return true;
    }
}

class MinLengthValidator extends Validator {
    /**
     * create a MaxLengthValidator
     * @param {string} name 
     * @param {number} number
     * @param {string} [message = ""] message 
     */
    constructor(name, number, message) {
        super("minlength", name, message);
        this.number = number;
    }

    isValidated() {
        this.dom = document.querySelector("[name='" + this.name + "']");
        if (this.dom.value === null) return false;
        if (String(this.dom.value).length < this.number) return false;
        return true;
    }
}

class EmailValidator extends Validator {
    /**
     * create a EmailValidator
     * @param {string} name 
     * @param {string} [message = ""] message 
     */
    constructor(name, message) {
        super("email", name, message);
    }

    isValidated() {
        this.dom = document.querySelector("[name='" + this.name + "']");
        const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (!this.dom.value.match(validRegex)) return false;
        return true;
    }
}

class RegexValidator extends Validator {
    /**
     * create a EmailValidator
     * @param {string} name 
     * @param {string} regex
     * @param {string} [message = ""] message 
     */
    constructor(name, regex, message) {
        super("email", name, message);
        this.regex = regex;
    }

    isValidated() {
        this.dom = document.querySelector("[name='" + this.name + "']");
        if (!this.dom.value.match(this.regex)) return false;
        return true;
    }
}